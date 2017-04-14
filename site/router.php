<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

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

function DD_GMaps_LocationsParseRoute($segments)
{
	$vars = array();
	$vars['alias']  = array_shift($segments);
	$vars['view']   = 'profile';

	return $vars;
}