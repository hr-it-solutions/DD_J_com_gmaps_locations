<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-08
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsModelLocation
 *
 * @since  Version 1.1.0.0
 */
class DD_GMaps_LocationsModelLocation extends JModelAdmin
{
	protected $text_prefix = 'COM_DD_GMAPS_LOCATIONS';

	public function getTable($type = 'Location', $prefix = 'DD_GMaps_LocationsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$app = JFactory::getApplication();

		$form = $this->loadForm('com_dd_gmaps_locations.location', 'location', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		return $form;
	}


	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_dd_gmaps_locations.edit.location.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	protected function prepareTable($table)
	{
		$table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);
	}
}