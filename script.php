<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-07
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2016 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die();

class com_dd_gmaps_locationsInstallerScript
{
	function install($parent)
	{
		$parent->getParent()->setRedirectURL('index.php?option=com_dd_gmaps_locations');
	}

	function uninstall($parent)
	{
		echo '<p>' . JText::_('COM_DD_GMAPS_LOCATIONS_UNINSTALL_TEXT') . '</p>';
	}

	function update($parent)
	{
		echo '<p>' . JText::_('COM_DD_GMAPS_LOCATIONS_UPDATE_TEXT') . '</p>';
	}

	function preflight($type, $parent)
	{
		echo '<p>' . JText::_('COM_DD_GMAPS_LOCATIONS_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}

	function postflight($type, $parent)
	{
		echo '<p>' . JText::_('COM_DD_GMAPS_LOCATIONS_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}
