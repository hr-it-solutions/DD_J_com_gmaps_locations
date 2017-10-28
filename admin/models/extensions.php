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
 * Class DD_GMaps_LocationsModelExtensions
 *
 * @since  Version 1.1.0.0
 */
class DD_GMaps_LocationsModelExtensions extends JModelList
{

	/**
	 * getDD_Extensions
	 *
	 * @return array including DD_Extensions
	 *
	 * @since  Version  1.1.1.6
	 */
	private function getDD_Extensions()
	{
		return array(
		'com_dd_gmaps_locations'                => ['pkg' => 'base', 'label' => 'DD GMaps Locations'],
		'plg_system_dd_gmaps_locations_geocode' => ['pkg' => 'base', 'label' => 'DD GMaps Locations GeoCode', 'required' => '1'],
		'mod_dd_gmaps_module'                   => ['pkg' => 'base', 'label' => 'DD GMaps Module'],
		'mod_dd_gmaps_locations_searchfilter'   => ['label' => 'DD GMaps Locations Searchfilter'],
		'plg_dd_gmaps_locations_ext_c_k2'       => ['label' => 'DD GMaps Locations Ext C K2'],
		'plg_dd_gmaps_locations_ext_c_content'  => ['label' => 'DD GMaps Locations Ext C Content'],
		'plg_dd_gmaps_locations_ext_c_seblod'   => ['label' => 'DD GMaps Locations Ext C Seblod'],
		'plg_editors-xtd_gmaps_locations'       => ['label' => 'DD GMaps Locations Editor Button'],
		);
	}

	/**
	 * getDD_Extensions_Defaults
	 *
	 * @return array including DD_Extensions_Defaults
	 *
	 * @since  Version  1.1.1.6
	 */
	private function getDD_Extensions_Defaults()
	{
		return array(
			'name' => '',
			'enabled' => '0',
			'installed' => '0',
			'pkg' => 'addon',
			'required' => '0'
		);
	}

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

		// Load extensions
		$query->select($db->qn(array('enabled', 'name', 'type')))
			->from($db->quoteName('#__extensions'))
			->where($db->quoteName('name') . ' IN (\'' . implode('\', \'', array_keys($this->getDD_Extensions())) . '\')');

		$db->setQuery($query);

		return $query;
	}

	/**
	 * mergeExtensionsToItems Items, including uninstalled extensions and values
	 * Method to get an array of data items including offline extensions.
	 *
	 * @params  object $items items
	 * @return  mixed  An array of data items.
	 *
	 * @since   1.6
	 */
	public function mergeExtensionsToItems($items)
	{
		$extensions = $this->getDD_Extensions();

		// Assigne DD_Extensions_Defaults to $extension
		foreach ($extensions as $key => $extension)
		{
			$defaults = $this->getDD_Extensions_Defaults();
			$defaults['name']  = $key;
			if(isset($extension['required']))
			{
				$defaults['required'] = $extension['required'];
			}
			$defaults['label'] = $extension['label'];

			$extensions[$key] = (object) $defaults;

			switch (substr($key, 0, 3))
			{
				case 'mod':
					$extensions[$key]->type = 'module';
					break;
				case 'plg':
					$extensions[$key]->type = 'plugin';
					break;
				case 'com':
					$extensions[$key]->type = 'component';
					break;
			}
		}

		// Assigne Items to $extension
		foreach ($items as $item)
		{
			$itemsValues = (object) array_merge($this->getDD_Extensions_Defaults(), (array) $item);
			$extensions[$item->name]->enabled   = $itemsValues->enabled;
			$extensions[$item->name]->type      = $itemsValues->type;
			$extensions[$item->name]->installed = 1;
		}

		// Return $extensions, the new items
		return $extensions;
	}

	/**
	 * Get Extension Items, including uninstalled extensions and values
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 *
	 * @since   1.6
	 */
	public function getItems()
	{
		// Get a storage key.
		$store = $this->getStoreId();

		// Try to load the data from internal storage.
		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		try
		{
			// Load the list items
			$items = $this->_getList($this->_getListQuery(), $this->getStart(), $this->getState('list.limit'));

			// Merge the list items
			$items = $this->mergeExtensionsToItems($items);

			// Load the list items and add the items to the internal cache.
			$this->cache[$store] = $items;
		}
		catch (RuntimeException $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		return $this->cache[$store];
	}
}
