<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-19
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

$input = JFactory::getApplication()->input;
$alias = str_replace(":","-",$input->get('alias', '', 'STRING'));
if( $alias != "") {
	DD_GMaps_LocationsModelProfile::GetProfile($alias);
}
else
{
	JFactory::getApplication()->redirect(JURI::base());
}

?>

PROFILE PAGE