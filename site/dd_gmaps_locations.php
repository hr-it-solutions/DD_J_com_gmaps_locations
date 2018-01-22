<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::_('jQuery.Framework');

JHTML::_('script', 'com_dd_gmaps_locations/dd_gmaps_locations.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'com_dd_gmaps_locations/dd_gmaps_locations.min.css', array('version' => 'auto', 'relative' => true));

// Check for a custom CSS file
JHtml::_('stylesheet', 'com_dd_gmaps_locations/user.css', array('version' => 'auto', 'relative' => true));

$controller = JControllerLegacy::getInstance('DD_GMaps_Locations');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
