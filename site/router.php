<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JLoader::register('DD_GMaps_LocationsTableLocation', JPATH_ADMINISTRATOR . '/components/com_dd_gmaps_locations/tables/location.php');

/**
 * Class DD_GMaps_LocationsRouter component routing class
 *
 * @since  Version  1.1.1.2
 */
class DD_GMaps_LocationsRouter extends JComponentRouterBase
{
	protected $locationsid = 0;

	protected $profileids = array();

	/**
	 * Class constructor.
	 *
	 * @param   JApplicationCms  $app   Application-object that the router should use
	 * @param   JMenu            $menu  Menu-object that the router should use
	 */
	public function __construct($app = null, $menu = null)
	{
		parent::__construct($app, $menu);

		$component = JComponentHelper::getComponent('com_dd_gmaps_locations');

		$attributes = array('component_id');
		$values     = array($component->id);

		// Load all menu items of this component
		$items = $this->menu->getItems($attributes, $values);

		foreach ($items as $item)
		{
			if ($this->menu->authorise($item->id) && isset($item->query) && isset($item->query['view']))
			{
				switch ($item->query['view'])
				{
					case 'locations':
						$this->locationsid = (int) $item->id;
						break;

					case 'profile':
						$this->profileids[$item->query['id']] = (int) $item->id;
						break;
				}
			}
		}
	}

	/**
	 * Prepare-method for URLs
	 * This method is meant to validate and complete the URL parameters.
	 * For example it can add the Itemid or set a language parameter.
	 * This method is executed on each URL, regardless of SEF mode switched
	 * on or not.
	 *
	 * @param   array  $query  An associative array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 */
	public function preprocess($query)
	{
		$query = parent::preprocess($query);

		$active = $this->menu->getActive();

		if (!empty($query['Itemid']))
		{
			$active = $this->menu->getItem($query['Itemid']);

			if (empty($query['view']) && !empty($active->query['view']))
			{
				$query['view'] = $active->query['view'];

				if ($active->query['view'] == 'profile')
				{
					$query['id'] = (int) $active->query['id'];
				}
			}
		}

		$allowed_views = array(
			'locations',
			'profile',
			'categories'
		);

		if (!isset($query['view']) || !in_array($query['view'], $allowed_views))
		{
			$query['view'] = 'locations';
		}

		if ($query['view'] == 'locations' && !empty($query['id']))
		{
			unset($query['id']);
		}
		elseif ($query['view'] == 'profile' && empty($query['id']))
		{
			$query['view'] = 'locations';
		}

		if (!empty($query['Itemid']))
		{
			if ($query['view'] == 'profile')
			{
				if ($active->query['view'] == 'profile')
				{
					if ($active->query['id'] != (int) $query['id'])
					{
						unset($query['Itemid']);
					}
				}
				elseif ($active->query['view'] != 'locations')
				{
					unset($query['Itemid']);
				}
			}
			elseif ($query['view'] == 'locations')
			{
				if ($query['view'] != $active->query['view'])
				{
					unset($query['Itemid']);
				}
			}
		}

		if (empty($query['Itemid']))
		{
			switch ($query['view'])
			{
				case 'profile':
					if (isset($this->profileids[(int) $query['id']]))
					{
						$query['Itemid'] = $this->profileids[(int) $query['id']];
						break;
					}

				case 'locations':
					if (!empty($this->locationsid))
					{
						$query['Itemid'] = $this->locationsid;
					}
					break;
			}
		}

		return $query;
	}

	/**
	 * Build method for URLs
	 * This method is meant to transform the query parameters into a more human
	 * readable form. It is only executed when SEF mode is switched on.
	 *
	 * @param   array  &$query  An array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 */
	public function build(&$query)
	{
		$segments = array();

		$active = $this->menu->getActive();

		if (!empty($query['Itemid']))
		{
			$active = $this->menu->getItem($query['Itemid']);
		}

		switch ($query['view'])
		{
			case 'profile':
				// Link to a profile
				if (empty($active) || $active->query['view'] == 'profile')
				{
					// Link to the correct profile
					if (!empty($active) && $active->query['id'] == (int) $query['id'])
					{
						unset($query['id']);
					}
					else
					{
						$segments[] = $this->getAlias($query['id']);
					}
				}
				else
				{
					$segments[] = $this->getAlias($query['id']);
				}

				unset($query['id']);
				break;

			case 'locations':
				break;
		}

		unset($query['view']);

		return $segments;
	}

	/**
	 * Parse method for URLs
	 * This method is meant to transform the human readable URL back into
	 * query parameters. It is only executed when SEF mode is switched on.
	 *
	 * @param   array  &$segments  The segments of the URL to parse.
	 *
	 * @return  array  The URL attributes to be used by the application.
	 */
	public function parse(&$segments)
	{
		$active = $this->menu->getActive();

		$query = array();

		if (empty($active) || ($active->component == 'com_dd_gmaps_locations' && $active->query['view'] == 'locations'))
		{
			foreach ($segments as $segment)
			{
				$id = $this->getId($segment);

				if ((int) $id > 0)
				{
					$query['id'] = (int) $id;
					$query['view'] = 'profile';
					break;
				}
			}
		}

		return $query;
	}

	/**
	 * getId
	 *
	 * @param   string  $alias  alias
	 *
	 * @return int
	 */
	protected function getId($alias)
	{
		$table = JTable::getInstance('Location', 'DD_GMaps_LocationsTable');

		if ($table->load(array('alias' => $alias)))
		{
			return $table->id;
		}

		return 0;
	}

	/**
	 * getAlias
	 *
	 * @param   string  $slug  id:alias
	 *
	 * @return int|mixed|string
	 */
	protected function getAlias($slug)
	{
		$parts = explode(':', $slug);
		$num = count($parts);

		$alias = '';

		if ($num > 1)
		{
			array_shift($parts);
			$alias = implode('-', $parts);
		}
		elseif ($num)
		{
			$part = array_shift($parts);

			if (is_numeric($part) && $part == (int) $part)
			{
				$table = JTable::getInstance('Location', 'DD_GMaps_LocationsTable');

				if ($table->load((int) $part))
				{
					$alias = $table->alias;
				}
			}
			else
			{
				$alias = $part;
			}
		}

		return $alias;
	}
}
