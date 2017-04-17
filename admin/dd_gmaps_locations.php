<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

if (!JFactory::getUser()->authorise('core.manage', 'com_dd_gmaps_locations'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::import('helpers.dd_gmaps_locations', JPATH_COMPONENT_ADMINISTRATOR);

// Check if plugin geocode is enabled
if (!JPluginHelper::getPlugin('system', 'dd_gmaps_locations_geocode'))
{
	JFactory::getApplication()->enqueueMessage(JText::_('COM_DD_GMAPS_LOCATIONS_WARNING_GEOCODE_PLUGIN_MUST_BE_ENABLED'), 'warning');
}

JHtml::_('jQuery.Framework');

JHTML::_('stylesheet', 'com_dd_gmaps_locations/dd_gmaps_locations.admin.min.css', array(), true);

$controller	= JControllerLegacy::getInstance('DD_GMaps_Locations');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
