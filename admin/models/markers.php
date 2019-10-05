<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsModelMarkers
 *
 * @since  Version 1.1.0.6
 */
class DD_GMaps_LocationsModelMarkers extends JModelList
{

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since    Version 1.1.0.6
	 */
	protected function populateState($ordering = 'a.id', $direction = 'desc')
	{
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 *
	 * @since    Version 1.1.0.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();

		$query->select(
			$this->getState(
				'list.select',
				'a.title, a.params, a.id'
			)
		);

		$query->from($db->qn('#__categories', 'a'));

		// Filter by component
		$query->where('a.extension = ' . $db->q('com_dd_gmaps_locations'));

		// Filter by published
		$query->where('a.published = 1');

		// Filter by search in grid fields
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->q('%' . $db->escape($search, true) . '%', false);
				$query->where('(a.title LIKE ' . $search . ')');
			}
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.fullordering', 'a.id');
		$orderDirn = '';

		if (empty($orderCol))
		{
			$orderCol  = $this->state->get('list.ordering', 'a.id');
			$orderDirn = $this->state->get('list.direction', 'DESC');
		}

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}
