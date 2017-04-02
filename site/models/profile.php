<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsModelProfile extends JModelLegacy {

	/**
	 * Get Profile Item Details based on sef alias or profile_id
	 *
	 * @return  string
	 *
	 * @since   Version 1.1.0.1
	 */
	public function GetItem()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Prepare input
		$input      = JFactory::getApplication()->input;
		$alias      = $db->escape($input->get('alias', false, 'STRING'));
		$profile_id = $db->escape($input->get('profile_id', false, 'INT'));

		$alias      = str_replace(":", "-", $alias);

		$select = $db->qn(
			array(
				'a.id',
				'a.title',
				'a.catid',
				'a.state',
				'a.profileimage',
				'a.image',
				'a.company',
				'a.contact_person',
				'a.phone',
				'a.mobile',
				'a.fax',
				'a.email',
				'a.url',
				'a.street',
				'a.location',
				'a.zip',
				'a.country',
				'a.federalstate',
				'a.latitude',
				'a.longitude',
				'a.description',
				'a.short_description',
				'a.created',
				'a.publish_up',
				'a.publish_down',
				'a.metadesc',
				'a.metakey',
				'a.featured'
			)
		);

		$query  ->select($select)
			->from($db->quoteName('#__dd_gmaps_locations', 'a'));

		// Filter state
		$query->where('a.state = 1');

		// Join over categories
		$query  ->select($db->quoteName('c.title', 'category_title'))
			->leftJoin($db->quoteName('#__categories', 'c') . ' ON (' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid') . ')');

		// Get Profile
		if ($alias)
		{
			$query->where($db->qn('a.alias') . " = '$alias'");
		}
		elseif($profile_id)
		{
			$query->where($db->qn('a.id') . " = '$profile_id'");
		}

		$result = $db->setQuery($query)->loadObject();

		if ($result)
		{
			// Set Hit
			$this->setHit($result->id);

			return $result;

		}
		else
		{
			JFactory::getApplication()->redirect(JUri::base() . "404");

			return false;
		}
	}

	/**
	 * DD Hit Counter
	 * Set Hit - One hit per IP-address per day
	 *
	 * @param   $profile_id  int  profile id
	 *
	 * @return  boolean
	 *
	 * @since   Version  1.1.0.1
	 */
	protected function setHit($profile_id){

		$profile_id = (int) $profile_id;

		$db        = JFactory::getDbo();
		$VisitorIP = substr(JFactory::getApplication()->input->server->get('REMOTE_ADDR', ''), 0, 15);

		// Select Ip from Table on profile_id
		$query = $db->getQuery(true);
		$query->select($db->qn('visitor_ip'))
			->from($db->qn('#__dd_gmaps_locations_iptables'))
			->where($db->qn('visitor_ip') . '=' . $db->q($VisitorIP) . " AND " . $db->qn('profile_id') . "= " . $db->q($profile_id));
		$db->setQuery($query);

		// Check if IP is not in ip table!
		if (!$db->loadResult())
		{
			// Inset Ip to ip table
			$query = $db->getQuery(true);
			$query->insert($db->qn('#__dd_gmaps_locations_iptables'))
				->columns($db->qn(array('visitor_ip', 'profile_id')))
				->values(implode(',', array($db->q($VisitorIP), $db->q($profile_id))));
			$db->setQuery($query);
			$db->execute();

			// Count View +1
			$query = $db->getQuery(true);
			$query->update($db->qn('#__dd_gmaps_locations'))
				->set($db->qn('hits') . '=' . $db->qn('hits') . ' + 1')
				->where($db->qn('id') . '=' . $db->q($profile_id));
			$db->setQuery($query);
			$db->execute();

			// Delete rows who older than a day!
			$sub_timestamp = date('Y-m-d H:i:s', strtotime("-1 day"));
			$query = $db->getQuery(true);
			$query->delete($db->qn('#__dd_gmaps_locations_iptables'))
				->where($db->qn('timestamp') . " < " . $db->q($sub_timestamp));
			$db->setQuery($query);
			$db->execute();
		}

		return true;

	}
}