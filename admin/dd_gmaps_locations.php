<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

if (!JFactory::getUser()->authorise('core.manage', 'com_dd_gmaps_locations'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$controller	= JControllerLegacy::getInstance('DD_GMaps_Locations');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();