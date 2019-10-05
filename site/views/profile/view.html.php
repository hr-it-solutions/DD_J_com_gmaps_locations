<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsViewProfile extends JViewLegacy {

	protected $app;

	protected $params;

	protected $item;

	protected $input;

	protected $alias;

	protected $emtpyFlag;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse
	 *
	 * @return boolean | mixed
	 *
	 * @since Version 1.1.0.0
	 * @throws  Exception
	 */
	public function display($tpl = null)
	{
		// Component configuration
		$this->params     = JComponentHelper::getParams('com_dd_gmaps_locations');

		$this->item = $this->get('Item');

		$this->state = $this->get('State');

		$this->emtpyFlag = array('','⚑');

		// Get custom fields
		JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
		$fields = FieldsHelper::getFields('com_dd_gmaps_locations.location', $this->item, true);

		// Assigne custom fields to $this->item->jcfields
		if($fields)
		{
			foreach ($fields as $key => $field)
			{
				if($field->value != '')
				{
					$this->item->jcfields[$field->id] = $field;
				}
			}
		}

		if (empty($this->item))
		{
			// 404
			exit;
		}

		$params = $this->state->get('params');

		// Set meta data header from menu : default from item @TODO #29
		$doc = JFactory::getDocument();
		$doc->setTitle($this->item->title);
		$doc->setMetaData('description', $this->item->metadesc);
		$doc->setMetaData('keywords', $this->item->metakey);
		$doc->setMetaData('robots', $params->get('robots'));

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		$this->prepareDocument();

		// Input Set Profile ID for GMapsLocations launchInfoWindow
		JFactory::getApplication()->input->set('profile_id', $this->item->id);

		return parent::display($tpl);
	}

	protected function prepareDocument()
	{
		// @ TODO #29 add breadcrumb + meta data here ++ site title
	}
}
