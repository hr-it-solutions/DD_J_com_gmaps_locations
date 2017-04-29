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

	$app = JFactory::getApplication();
	$input = $app->input;

	$menu = $app->getMenu();

	if (!empty($query['Itemid']))
	{
		$menuItem = $menu->getItem($query['Itemid']);
		$input->set('dd_gmaps_locations_component_alias', $menuItem->alias);
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
 * @param array $segments array of segments
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
