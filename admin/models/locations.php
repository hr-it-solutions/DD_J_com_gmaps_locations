<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-08
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsModelLocations
 *
 * @since  Version 1.1.0.0
 */
class DD_GMaps_LocationsModelLocations extends JModelList
{

	public function __construct($config = array())
	{
		if(empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'company', 'a.company',
				'contact_person', 'a.contact_person',
				'phone', 'a.phone',
				'email', 'a.email',
				'street', 'a.street',
				'location', 'a.location',
				'zip', 'a.zip',
				'country', 'a.country',
				'category_title', 'a.catid',
				'publish_up', 'a.publish_up',
			    'publish_down', 'a.publish_down'
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState('a.title', 'asc');
	}

	/**
	 * getListQuery
	 *
	 * @return mixed
	 *
	 * @since Version 1.1.0.0
	 */
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		$query->select(
			$this->getState('list.select', 'a.id, a.title, a.catid, a.state,' .
			'a.company, a.contact_person, a.phone, a.email, a.street, a.location, a.zip,' .
			'a.country, a.federalstate, a.publish_up, a.publish_down')
		);

		$query->from($db->quoteName('#__dd_gmaps_locations') . 'a');

		// Filter by state
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif ($published === '')
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
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('(a.title LIKE ' . $search . ' OR a.company LIKE ' . $search .
					' OR a.contact_person LIKE ' . $search . ' OR a.phone LIKE ' . $search .
					' OR a.street LIKE ' . $search . ' OR a.location LIKE ' . $search .
					' OR a.zip LIKE ' . $search . ' OR a.country LIKE ' . $search .
					' OR a.short_description LIKE ' . $search . ' OR a.federalstate LIKE ' . $search . ')');
			}
		}

		// Ordering
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');

		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}
}