<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addStyleSheetVersion(JUri::base() . 'media/com_dd_gmaps_locations/css/dd_gmaps_locations.css');
$doc->addScriptVersion(JUri::base() . 'media/com_dd_gmaps_locations/js/dd_gmaps_locations.js');

$controller = JControllerLegacy::getInstance('DD_GMaps_Locations');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();