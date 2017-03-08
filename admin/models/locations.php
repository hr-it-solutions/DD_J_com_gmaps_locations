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

		// Filter by state
		$published = $this->getState('filter.state');
		if (is_numeric($published))
		{
			$query->where('a.state = '.(int) $published);
		} elseif ($published === '')
		{
			$query->where('(a.state IN (0, 1))');
		}

		// Join over categories
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories c ON c.id = a.catid');

		// Filter by search
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.title LIKE '.$search.' OR a.company LIKE '.$search.
					' OR a.street LIKE '.$search.' OR a.location LIKE '.$search.
					' OR a.zip LIKE '.$search.' OR a.country LIKE '.$search.
					' OR a.federalstate LIKE '.$search.')');
			}
		}

		// Ordering
		$orderCol = $this->state->get('list.ordering');
		$orderDir = $this->state->get('list.direction');
		if ($orderCol == 'a.ordering')
		{
			$orderCol = 'c.title '.$orderDir.', a.ordering';
		}
		$query->order($db->escape($orderCol.' '.$orderDir));


		return $query;
	}
}