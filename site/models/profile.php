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
				'title', 'a.title',
				'catid', 'a.catid',
				'state', 'a.state',
				'profileimage', 'a.profileimage',
				'image', 'a.image',
				'company', 'a.company',
				'contact_person', 'a.contact_person',
				'phone', 'a.phone',
				'mobile', 'a.mobile',
				'fax', 'a.fax',
				'email', 'a.email',
				'url', 'a.url',
				'street', 'a.street',
				'location', 'a.location',
				'zip', 'a.zip',
				'country', 'a.country',
				'federalstate', 'a.federalstate',
				'latitude', 'a.latitude',
				'longitude', 'a.longitude',
				'short_description', 'a.short_description',
				'description', 'a.description',
				'publish_up', 'a.publish_up',
				'publish_down', 'a.publish_down',
				'metadesc', 'a.metadesc',
				'metakey', 'a.metakey',
			    'featured', 'a.featured'
			)
		);

		$query  ->select($select)
				->from($db->qn('#__dd_gmaps_locations', 'a'));

		if ($alias)
		{
			$query->where($db->qn('alias') . " = '$alias'");
		}
		elseif($profile_id)
		{
			$query->where($db->qn('id') . " = '$profile_id'");
		}

		// Join over categories
		$query  ->select($db->quoteName('c.title', 'category_title'))
			->leftJoin($db->quoteName('#__categories', 'c') . ' ON (' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid') . ')');


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