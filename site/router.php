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
 * BuildRoute
 *
 * @param array $query of URL parameters
 *
 * @return array of segments that will form the SEF URL
 */
function DD_GMaps_LocationsBuildRoute(&$query)
{
	$segments = array();

	if (isset($query['view']) && $query['view'] == 'searchfilter')
	{
		$db = JFactory::getDbo();
		$db_query = $db->getQuery(true);
		$db_query->select('alias')
			->from($db->qn('#__menu'))
			->where(
				$db->qn('menutype') . '= ' . $db->q('com-gmaps-locations') . ' AND ' .
				$db->qn('link') . '= ' . $db->q('index.php?option=com_dd_gmaps_locations&view=locations') . ' AND ' .
				$db->qn('published') . '= ' . $db->q('1')
			);
		$db->setQuery($db_query);
		$menuItemAlias = $db->loadResult();

		if (!$menuItemAlias)
		{
			$lang = JFactory::getLanguage();
			$lang->load('com_dd_gmaps_locations', JPATH_ROOT);

			JFactory::getApplication()->enqueueMessage(
				JText::_('COM_DD_GMAPS_LOCATIONS_LOCATIONS_MENU_ITEM_REQUIRED'), 'error'
			);
		}

		unset($query['Itemid']);
		$query['option'] = '';
		unset($query['view']);

		$segments[] = $menuItemAlias;

		return $segments;
	}

	if (isset($query['view']))
	{
		$segments[] = $query['view'];
		unset($query['view']);
	}

	if (isset($query['alias']))
	{
		$segments[] = $query['alias'];
		unset($query['alias']);
	}

	return $segments;
}

/**
 * ParseRoute
 *
 * @param   array  $segments  array of segments
 *
 * @return array of URL parameters
 */
function DD_GMaps_LocationsParseRoute($segments)
{
	$vars = array();
	$vars['alias']  = array_shift($segments);
	$vars['view']   = 'profile';

	return $vars;
}
