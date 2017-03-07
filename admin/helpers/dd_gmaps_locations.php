<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-07
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class  DD_GMaps_LocationsHelper extends JHelperContent
{

	/**
	 * @return string component version
	 */
	public static function getComponentVersion()
	{
		$xml = JFactory::getXML(JPATH_ADMINISTRATOR .'/components/com_dd_gmaps_locations/dd_gmaps_locations.xml');
		$version = (string)$xml->version;
		return $version;
	}

}