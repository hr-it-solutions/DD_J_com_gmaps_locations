<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-18
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

jimport('joomla.filesystem.file');

class JFormFieldCountry extends JFormFieldList {

	protected $type = 'Country';
	protected $countries_json = '/models/countries/countries.json';

	public function getOptions() {

		$app = JFactory::getApplication();

		// $country = $app->input->get('country'); //country is the dynamic value which is being used in the view

		$countries = array();
		$options = array();

		if (JFile::exists(JPATH_COMPONENT . $this->countries_json))
		{
			$json = file_get_contents(JPATH_COMPONENT . $this->countries_json);
			$obj = json_decode($json);
			$countries = $obj->extension->countries->country;
		}

		$i = 0;

		foreach ($countries as $country)
		{
			$options[$i]->value = 'COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_' . $country->name;
			$options[$i]->text  = JText::_('COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_' . $country->name);
			++$i;
		}

		return $options;
	}
}