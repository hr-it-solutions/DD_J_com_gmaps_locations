<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die();

class com_dd_gmaps_locationsInstallerScript
{

	private $extensionName;

	public function __construct()
	{
		$this->extensionName = JText::_('COM_DD_GMAPS_LOCATIONS');
	}

	function install($parent)
	{
		$parent->getParent()->setRedirectURL('index.php?option=com_dd_gmaps_locations');
	}

	function uninstall($parent)
	{
		echo '<p>' . JText::sprintf('COM_DD_GMAPS_LOCATIONS_UNINSTALL_TEXT', $this->extensionName) . '</p>';
	}

	function update($parent)
	{
		echo '<p>' . JText::sprintf('COM_DD_GMAPS_LOCATIONS_UPDATE_TEXT', $this->extensionName) . '</p>';
	}

	function preflight($type, $parent)
	{
		echo '<p>' . JText::sprintf('COM_DD_GMAPS_LOCATIONS_PREFLIGHT_' . strtoupper($type) . '_TEXT', $this->extensionName) . '</p>';
	}

	function postflight($type, $parent)
	{
		echo '<p>' . JText::sprintf('COM_DD_GMAPS_LOCATIONS_POSTFLIGHT_' . strtoupper($type) . '_TEXT', $this->extensionName) . '</p>';
	}
}
