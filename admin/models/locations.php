<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-08
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsModelLocations extends JModelList
{

	/**
	 * @return mixed
	 * @since Version 3.6.5
	 */
	protected function getListQuery()
	{

		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		$query->select($this->getState(
			'list.select', 'a.id, a.title, a.catid, a.state,' .
			'a.company, a.street, a.location, a.zip, a.country, a.federalstate,' .
			'a.publish_up, a.publish_down, a.ordering')
		);

		$query->from($db->quoteName('#__dd_gmaps_locations'),'a');

		return $query;
	}
}