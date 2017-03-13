<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-08
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsViewLocations
 *
 * @since  Version  1.1.0.0
 */
class DD_GMaps_LocationsViewLocations extends JViewLegacy
{

	/**
	 * An array of items
	 *
	 * @var  array
	 */
	protected $items;

	/**
	 * The model state
	 *
	 * @var  object
	 */
	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since  Version  1.1.0.0
	 */
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
		}

		$this->addToolbar();
		$this->addSidebar();

		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   Version  1.1.0.0
	 */
	protected function addToolbar()
	{
		$canDo = JHelperContent::getActions('com_dd_gmaps_locations', 'category', $this->state->get('filter.category_id'));
		$user  = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolbar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_DD_GMAPS_LOCATIONS_TOOLBARTITLE_LOCATIONS'), '');

		JToolbarHelper::addNew('location.edit');

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('location.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('locations.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('locations.unpublish', 'JTOOLBAR_UNPUBLISH', true);

			JToolbarHelper::checkin('locations.checkin');
		}

		$state	= $this->get('State');

		if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'locations.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('locations.trash');
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_dd_gmaps_locations');
		}

		JHtmlSidebar::setAction('index.php?option=com_dd_gmaps_locations&view=locations');

		// Get GridFilter Published Options for sidebar filter and unset "Archived" option
		$jgridPublishedOptions = JHtml::_('jgrid.publishedOptions');
		unset($jgridPublishedOptions[2]);

		// Sidebar Filter
		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_language_client',
			JHtml::_('select.options', $jgridPublishedOptions, 'value', 'text', $this->state->get('filter.state'), true)
		);

	}

	/**
	 * Add the sidebar
	 *
	 * @return  void
	 *
	 * @since   Version  1.1.0.0
	 */
	protected function addSidebar()
	{
		DD_GMaps_LocationsHelper::addSubmenu('locations');
		$this->sidebar = JHtml::_('sidebar.render');
	}

	/**
	 * Drop Down Filter
	 *
	 * @return array
	 *
	 * @since Version 1.1.0.0
	 */
	protected function getSortFields()
	{
		return array(
			'a.state' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.company' => JText::_('COM_DD_GMAPS_LOCATIONS_HEADING_COMPANY'),
			'a.location' => JText::_('COM_DD_GMAPS_LOCATIONS_HEADING_LOCATION'),
			'a.country' => JText::_('COM_DD_GMAPS_LOCATIONS_HEADING_COUNTRY'),
			'a.zip' => JText::_('COM_DD_GMAPS_LOCATIONS_HEADING_ZIP'),
			'a.catid' => JText::_('JCATEGORY'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}
