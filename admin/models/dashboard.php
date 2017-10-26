<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsModelDashboard
 *
 * @since  Version 1.1.0.0
 */
class DD_GMaps_LocationsModelDashboard extends JModelList
{
	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 *
	 * @since    Version 1.1.0.1
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Locations and Hits
		$query->select('COUNT(*) AS \'COM_DD_GMAPS_LOCATIONS_SIDEBARTITLE_LOCATIONS\', 
						SUM(hits) AS \'COM_DD_GMAPS_LOCATIONS_FIELD_HITS\'')
			->from($db->quoteName('#__dd_gmaps_locations'))
			->where($db->quoteName('state') . ' = 1');
		$db->setQuery($query);

		return $query;
	}
}
