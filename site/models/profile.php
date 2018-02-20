<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsModelProfile extends JModelItem
{
	protected function populateState()
	{
		parent::populateState();

		$app = JFactory::getApplication();

		$input = $app->input;

		$this->setState($this->getName() . '.id', $input->getInt('id'));

		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * Get Profile Item Details based on sef alias or profile_id
	 *
	 * @return  string
	 *
	 * @since   Version 1.1.0.1
	 */
	public function getItem($id = null)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$select = $db->qn(
			array(
				'a.id',
				'a.title',
				'a.alias',
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
				'a.created_by',
				'a.publish_up',
				'a.publish_down',
				'a.hits',
				'a.metadesc',
				'a.metakey',
				'a.featured'
			)
		);

		$query->select($select)
			->from($db->qn('#__dd_gmaps_locations', 'a'));

		// Filter state
		$query->where('a.state = 1');

		// Join over categories
		$query->select(
			$db->qn('c.title') . 'AS' . $db->qn('category_title') . ',' .
			$db->qn('c.params') . 'AS' . $db->qn('category_params')
		)
			->leftJoin($db->qn('#__categories', 'c') . ' ON (' . $db->qn('c.id') . ' = ' . $db->qn('a.catid') . ')');

		// Get Profile
		$query->where($db->qn('a.id') . ' = ' . (int) $this->getState($this->getName() . '.id'));

		$result = $db->setQuery($query)->loadObject();

		$this->setHit($result->id);

		return $result;
	}

	/**
	 * DD Hit Counter
	 * Set Hit - One hit per IP-address per day
	 *
	 * @param   int  $profile_id  profile id
	 *
	 * @return  boolean
	 *
	 * @since   Version  1.1.0.1
	 */
	protected function setHit($profile_id)
	{
		$profile_id = (int) $profile_id;

		$db        = JFactory::getDbo();
		$VisitorIP = md5(substr(JFactory::getApplication()->input->server->get('REMOTE_ADDR', ''), 0, 15));

		// Delete rows who older than a day!
		$date = JFactory::getDate();
		$date->modify('-1 day');

		$query = $db->getQuery(true);
		$query->delete($db->qn('#__dd_gmaps_locations_iptables'))
			->where($db->qn('timestamp') . ' < ' . $db->q($date->toSql()));

		$db->setQuery($query)->execute();

		// Select IP from Table on profile_id
		$query = $db->getQuery(true);
		$query->select($db->qn('visitor_ip'))
			->from($db->qn('#__dd_gmaps_locations_iptables'))
			->where($db->qn('visitor_ip') . ' = ' . $db->q($VisitorIP))
			->where($db->qn('profile_id') . ' = ' . $db->q($profile_id));
		$db->setQuery($query);

		// Check if IP is not in ip table!
		if (!$db->loadResult())
		{
			// Insert IP to ip table
			$query = $db->getQuery(true);
			$query->insert($db->qn('#__dd_gmaps_locations_iptables'))
				->columns($db->qn(array('visitor_ip', 'profile_id')))
				->values(implode(',', array($db->q($VisitorIP), $db->q($profile_id))));
			$db->setQuery($query)->execute();

			// Count View +1
			$query = $db->getQuery(true);
			$query->update($db->qn('#__dd_gmaps_locations'))
				->set($db->qn('hits') . '=' . $db->qn('hits') . ' + 1')
				->where($db->qn('id') . '=' . $db->q($profile_id));
			$db->setQuery($query)->execute();
		}

		return true;

	}
}
