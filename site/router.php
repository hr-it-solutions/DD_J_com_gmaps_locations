<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-19
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

function DD_GMaps_LocationsBuildRoute(&$query)
{
    $segments = array();
    unset($query['view']);
    if(isset($query['alias'])) {
        $segments[] = $query['alias'];
        unset($query['alias']);
    };

    return $segments;
}

function DD_GMaps_LocationsParseRoute($segments)
{
    $vars = array();
    $vars['alias']  = array_shift($segments);
	$vars['view']   = 'profile';
    return $vars;
}