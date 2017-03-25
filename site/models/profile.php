<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-19
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsModelProfile extends JModelLegacy {

	/**
	 * @param   $alias  string
	 * @return  string
	 * @since   Version 3.6
	 */
	public static function GetProfile($alias)
	{

		$db = JFactory::getDbo();
		$alias = $db->escape($alias);
		$query = $db->getQuery(true);
		$query->select(array('id', 'alias'))
			->from($db->quoteName('#__dd_gmaps_locations'))
			->where($db->quoteName('alias')." = '$alias'");
		$db->setQuery($query);
		$result = $db->loadObject();

		if ($result)
		{
			return true;

		}
		else
		{
			JFactory::getApplication()->redirect(JUri::base() . "404");

			return false;
		}
	}
}