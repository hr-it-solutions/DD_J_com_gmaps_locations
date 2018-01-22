<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die();

JFormHelper::loadFieldClass('list');

jimport('joomla.filesystem.file');

class JFormFieldCountry extends JFormFieldList {

	protected $type = 'Country';

	protected $countries_json = '/models/countries/countries.json';

	protected $component_name = 'com_dd_gmaps_locations';

	/**
	 * Get Options
	 *
	 * @return array
	 *
	 * @since Version 1.0.0.1
	 */
	public function getOptions()
	{
		$countries = array();
		$options = array();

		$reduced_selection = JComponentHelper::getParams($this->component_name)->get('countries_reduced_selection', 0);

		if (JFile::exists(JPATH_COMPONENT . $this->countries_json)
			|| JFile::exists(JPATH_ADMINISTRATOR . '/components/' . $this->component_name . $this->countries_json))
		{
			if (JFile::exists(JPATH_COMPONENT . $this->countries_json))
			{
				// From this component
				$json = file_get_contents(JPATH_COMPONENT . $this->countries_json);
			}
			else
			{
				// From outside component (like com_menu etc..)
				$json = file_get_contents(JPATH_ADMINISTRATOR . '/components/' . $this->component_name . $this->countries_json);
			}

			$obj = json_decode($json);
			$countries = $obj->extension->countries->country;
		}

		// Default field
		$options[0] = new StdClass;
		$options[0]->value = 0;
		$options[0]->text  = JText::_('COM_DD_GMAPS_LOCATIONS_FIELD_COUNTRY_SELECT');

		$i = 1;

		foreach ($countries as $country)
		{
			if ($reduced_selection && $country->selection == 'extended')
			{
				continue;
			}

			$options[$i] = new StdClass;
			$options[$i]->value = 'COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_' . $country->name;
			$options[$i]->text  = JText::_('COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_' . $country->name);
			++$i;
		}

		return $options;
	}
}
