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
	 * @since   Version 3.6
	 */
	public static function GetItem()
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
			return $result;

		}
		else
		{
			JFactory::getApplication()->redirect(JUri::base() . "404");

			return false;
		}
	}
}