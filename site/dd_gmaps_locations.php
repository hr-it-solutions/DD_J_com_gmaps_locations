<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::_('jQuery.Framework');

$doc = JFactory::getDocument();
$doc->addStyleSheet(JUri::base() . 'media/com_dd_gmaps_locations/css/dd_gmaps_locations.min.css');
$doc->addScript(JUri::base() . 'media/com_dd_gmaps_locations/js/dd_gmaps_locations.min.js');

$controller = JControllerLegacy::getInstance('DD_GMaps_Locations');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
