<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
use Joomla\Utilities\ArrayHelper;

JLoader::register('DD_GMaps_LocationsHelper', JPATH_ADMINISTRATOR . '/components/com_dd_gmaps_locations/helpers/dd_gmaps_locations.php');

/**
 * Class DD_GMaps_LocationsModelLocation
 *
 * @since  Version 1.1.0.0
 */
class DD_GMaps_LocationsModelLocation extends JModelAdmin
{

	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 *
	 * @since    Version 1.1.0.1
	 */
	protected $text_prefix = 'COM_DD_GMAPS_LOCATIONS';

	/**
	 * The type alias for this content type (for example, 'com_dd_gmaps_locations.location').
	 *
	 * @var    string
	 *
	 * @since    Version 1.1.0.1
	 */
	public $typeAlias = 'com_dd_gmaps_locations.location';

	/**
	 * The context used for the associations table
	 *
	 * @var    string
	 *
	 * @since    Version 1.1.0.1
	 */
	protected $associationsContext = 'com_dd_gmaps_locations.item';

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 *
	 * @since    Version 1.1.0.1
	 */
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->state != -2)
			{
				return false;
			}

			return JFactory::getUser()->authorise('core.delete', 'com_dd_gmaps_locations.location.' . (int) $record->id);
		}

		return false;
	}

	/**
	 * Method to test whether a record can have its state edited.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
	 *
	 * @since    Version 1.1.0.1
	 */
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		// Check for existing article.
		if (!empty($record->id))
		{
			return $user->authorise('core.edit.state', 'com_dd_gmaps_locations.location.' . (int) $record->id);
		}

		// New article, so check against the category.
		if (!empty($record->catid))
		{
			return $user->authorise('core.edit.state', 'com_dd_gmaps_locations.category.' . (int) $record->catid);
		}

		// Default to component settings if neither article nor category known.
		return parent::canEditState();
	}

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param   JTable  $table  A JTable object.
	 *
	 * @return  void
	 *
	 * @since    Version 1.1.0.1
	 */
	protected function prepareTable($table)
	{
		// Set the publish date to now
		if ($table->state == 1 && (int) $table->publish_up == 0)
		{
			$table->publish_up = JFactory::getDate()->toSql();
		}

		if ($table->state == 1 && intval($table->publish_down) == 0)
		{
			$table->publish_down = $this->getDbo()->getNullDate();
		}

		// Reorder the articles within the category so the new article is first
		if (empty($table->id))
		{
			$table->reorder('catid = ' . (int) $table->catid . ' AND state >= 0');
		}
	}

	/**
	 * Returns a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable    A database object
	 *
	 * @since    Version 1.1.0.1
	 */
	public function getTable($type = 'Location', $prefix = 'DD_GMaps_LocationsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}


	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 */
	public function getItem($pk = null)
	{
		return parent::getItem($pk);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  JForm|boolean  A JForm object on success, false on failure
	 *
	 * @since    Version 1.1.0.1
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_dd_gmaps_locations.location', 'location', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		$jinput = JFactory::getApplication()->input;

		/*
		 * The front end calls this model and uses a_id to avoid id clashes so we need to check for that first.
		 * The back end uses id so we use that the rest of the time and set it to 0 by default.
		 */
		$id = $jinput->get('a_id', $jinput->get('id', 0));

		// Determine correct permissions to check.
		if ($this->getState('location.id'))
		{
			$id = $this->getState('location.id');

			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');

			// Existing record. Can only edit own articles in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit.own');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
		}

		$user = JFactory::getUser();

		// Check for existing article.
		// Modify the form based on Edit State access controls.
		if ($id != 0 && (!$user->authorise('core.edit.state', 'com_dd_gmaps_locations.location.' . (int) $id))
			|| ($id == 0 && !$user->authorise('core.edit.state', 'com_dd_gmaps_locations')))
		{
			// Disable fields for display.
			$form->setFieldAttribute('featured', 'disabled', 'true');
			$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('publish_up', 'disabled', 'true');
			$form->setFieldAttribute('publish_down', 'disabled', 'true');
			$form->setFieldAttribute('state', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is an article you can edit.
			$form->setFieldAttribute('featured', 'filter', 'unset');
			$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('publish_up', 'filter', 'unset');
			$form->setFieldAttribute('publish_down', 'filter', 'unset');
			$form->setFieldAttribute('state', 'filter', 'unset');
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since    Version 1.1.0.1
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app = JFactory::getApplication();
		$data = $app->getUserState('com_dd_gmaps_locations.edit.location.data', array());

		if (empty($data))
		{
			$data = $this->getItem();

			// Pre-select some filters (Status, Category, Language, Access) in edit form if those have been selected in Article Manager: Articles
			if ($this->getState('location.id') == 0)
			{
				$filters = (array) $app->getUserState('com_dd_gmaps_locations.locations.filter');
				$data->set(
					'state',
					$app->input->getInt(
						'state',
						((isset($filters['published']) && $filters['published'] !== '') ? $filters['published'] : null)
					)
				);
				$data->set('catid', $app->input->getInt('catid', (!empty($filters['category_id']) ? $filters['category_id'] : null)));
				$data->set('access',
					$app->input->getInt('access', (!empty($filters['access']) ? $filters['access'] : JFactory::getConfig()->get('access')))
				);

				// Set default catid for none admins and for new entries (to catid where access to write)
				if (!JFactory::getUser()->authorise('core.admin'))
				{
					$categories = JFactory::getUser()->getAuthorisedCategories('com_dd_gmaps_locations', 'core.edit');
					$data->set('catid', $categories[0]);
				}
			}
		}

		// If there are params fieldsets in the form it will fail with a registry object
		if (isset($data->params) && $data->params instanceof Registry)
		{
			$data->params = $data->params->toArray();
		}

		// Fill ll cutsom if ll_c is active
		if ($data->ll_c === 0)
		{
			$data->set('latitude_c', $data->latitude);
			$data->set('longitude_c', $data->longitude);
		}

		$this->preprocessData('com_dd_gmaps_locations.location', $data);

		return $data;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since    Version 1.1.0.1
	 */
	public function save($data)
	{
		$input  = JFactory::getApplication()->input;
		$filter = JFilterInput::getInstance();

		if (isset($data['metadata']) && isset($data['metadata']['author']))
		{
			$data['metadata']['author'] = $filter->clean($data['metadata']['author'], 'TRIM');
		}

		if (isset($data['created_by_alias']))
		{
			$data['created_by_alias'] = $filter->clean($data['created_by_alias'], 'TRIM');
		}

		JLoader::register('CategoriesHelper', JPATH_ADMINISTRATOR . '/components/com_categories/helpers/categories.php');

		// Cast catid to integer for comparison
		$catid = (int) $data['catid'];

		// Check if New Category exists
		if ($catid > 0)
		{
			$catid = CategoriesHelper::validateCategoryId($data['catid'], 'com_dd_gmaps_locations');
		}

		// Check Category access level for save if not core.admin
		if (!JFactory::getUser()->authorise('core.admin')
			&& !in_array($catid, JFactory::getUser()->getAuthorisedCategories('com_dd_gmaps_locations', 'core.edit')))
		{
			JFactory::getApplication()->enqueueMessage(
				JText::_('COM_DD_GMAPS_LOCATIONS_WARNING_CATEGORY_ACCESSLEVEL'), 'warning'
			);

			return false;
		}

		// Alter the title for save as copy
		if ($input->get('task') == 'save2copy')
		{
			$origTable = clone $this->getTable();
			$origTable->load($input->getInt('id'));

			if ($data['title'] == $origTable->title)
			{
				list($title, $alias) = $this->generateNewTitle($data['catid'], $data['alias'], $data['title']);
				$data['title'] = $title;
				$data['alias'] = $alias;
			}
			else
			{
				if ($data['alias'] == $origTable->alias)
				{
					$data['alias'] = '';
				}
			}

			$data['state'] = 0;
		}

		// Set created date
		$date = & JFactory::getDate();
		$data['created'] = JHtml::date($date, 'Y-m-d H:M:S');

		// Check and prepare Alias for saving
		$data['alias'] = DD_GMaps_LocationsHelper::prepareAlias($data);

		if ($data['ll_c'] === 0)
		{
			if (DD_GMaps_LocationsHelper::validateLatLong($data['latitude_c'], $data['longitude_c']))
			{
				// GeoCoding hard coding _c (custom)
				$data['latitude']  = $data['latitude_c'];
				$data['longitude'] = $data['longitude_c'];
			}
			else
			{
				JFactory::getApplication()->enqueueMessage(JText::_('COM_DD_GMAPS_LOCATIONS_FIELD_LATITUDE_LONGITUDE_CUSTOM_ERROR'), 'warning');
				JFactory::getApplication()->enqueueMessage(JText::_('COM_DD_GMAPS_LOCATIONS_FIELD_LATITUDE_LONGITUDE_CUSTOM_ERROR_SUCCESS'), 'success');

				goto generateLatLng;
			}
		}
		else
		{
			generateLatLng:

			// Generate latitude and longitude
			$latlng = DD_GMaps_LocationsHelper::Geocode_Location_To_LatLng($data);

			$data['latitude']  = $latlng['latitude'];
			$data['longitude'] = $latlng['longitude'];
		}

		$data['created_by'] = JFactory::getUser()->id;

		if (parent::save($data))
		{
			return true;
		}

		return false;
	}

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param   object  $table  A record object.
	 *
	 * @return  array  An array of conditions to add to add to ordering queries.
	 *
	 * @since   1.6
	 */
	protected function getReorderConditions($table)
	{
		return array('catid = ' . (int) $table->catid);
	}

	/**
	 * Allows preprocessing of the JForm object.
	 *
	 * @param   JForm   $form   The form object
	 * @param   array   $data   The data to be merged into the form object
	 * @param   string  $group  The plugin group to be executed
	 *
	 * @return  void
	 *
	 * @since    Version 1.1.0.1
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'content')
	{
		if ($this->canCreateCategory())
		{
			$form->setFieldAttribute('catid', 'allowAdd', 'true');
		}

		// Association content items
		if (JLanguageAssociations::isEnabled())
		{
			$languages = JLanguageHelper::getContentLanguages(false, true, null, 'ordering', 'asc');

			if (count($languages) > 1)
			{
				$addform = new SimpleXMLElement('<form />');
				$fields = $addform->addChild('fields');
				$fields->addAttribute('name', 'associations');
				$fieldset = $fields->addChild('fieldset');
				$fieldset->addAttribute('name', 'item_associations');
				$fieldset->addAttribute('description', 'COM_CONTENT_ITEM_ASSOCIATIONS_FIELDSET_DESC');

				foreach ($languages as $language)
				{
					$field = $fieldset->addChild('field');
					$field->addAttribute('name', $language->lang_code);
					$field->addAttribute('type', 'modal_article');
					$field->addAttribute('language', $language->lang_code);
					$field->addAttribute('label', $language->title);
					$field->addAttribute('translate_label', 'false');
					$field->addAttribute('select', 'true');
					$field->addAttribute('new', 'true');
					$field->addAttribute('edit', 'true');
					$field->addAttribute('clear', 'true');
				}

				$form->load($addform, false);
			}
		}

		parent::preprocessForm($form, $data, $group);
	}

	/**
	 * Custom clean the cache of com_dd_gmaps_locations and com_dd_gmaps_locations modules
	 *
	 * @param   string   $group      The cache group
	 * @param   integer  $client_id  The ID of the client
	 *
	 * @return  void
	 *
	 * @since    Version 1.1.0.1
	 */
	protected function cleanCache($group = null, $client_id = 0)
	{
		parent::cleanCache('com_dd_gmaps_locations');
		parent::cleanCache('mod_dd_gmaps_module');
		parent::cleanCache('mod_dd_gmaps_locations_searchfilter');
	}

	/**
	 * Void hit function for pagebreak when editing content from frontend
	 *
	 * @return  void
	 *
	 * @since   3.6.0
	 */
	public function hit()
	{
		return;
	}

	/**
	 * Is the user allowed to create an on the fly category?
	 *
	 * @return  boolean
	 *
	 * @since    Version 1.1.0.1
	 */
	private function canCreateCategory()
	{
		return JFactory::getUser()->authorise('core.create', 'com_dd_gmaps_locations');
	}
}
