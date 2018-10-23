<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 HR-IT-Solutions GmbH
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
	 * The Pagination
	 *
	 */
	protected $pagination;

	public $filterForm;

	public $activeFilters;

	protected $canDo;

	protected $sidebar;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since  Version  1.1.0.0
	 * @throws  Exception
	 */
	public function display($tpl = null)
	{
		$this->canDo = DD_GMaps_LocationsHelper::getActions('com_dd_gmaps_locations', 'location');

		if ($this->getLayout() !== 'modal')
		{
			DD_GMaps_LocationsHelper::addSubmenu('locations');
		}

		// Load the datas from the model
		$this->items			= $this->get('Items');
		$this->state			= $this->get('State');
		$this->pagination		= $this->get('Pagination');
		$this->filterForm		= $this->get('FilterForm');
		$this->activeFilters	= $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
		}

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
		JToolBarHelper::title(JText::_('COM_DD_GMAPS_LOCATIONS_TOOLBARTITLE_LOCATIONS'), 'location');

		if ($this->canDo->get('core.create'))
		{
			JToolBarHelper::addNew('location.add');
		}

		if (!empty($this->items))
		{
			if ($this->canDo->get('core.edit'))
			{
				JToolBarHelper::editList('location.edit');
			}

			if ($this->canDo->get('core.edit.state'))
			{
				JToolbarHelper::publish('locations.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('locations.unpublish', 'JTOOLBAR_UNPUBLISH', true);
				JToolbarHelper::checkin('locations.checkin');
			}

			if ($this->state->get('filter.published') == -2 && $this->canDo->get('core.delete'))
			{
				JToolbarHelper::deleteList('', 'locations.delete', 'JTOOLBAR_EMPTY_TRASH');
			}
			elseif ($this->canDo->get('core.edit.state'))
			{
				JToolbarHelper::trash('locations.trash');
			}
		}

		if ($this->canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_dd_gmaps_locations');
		}
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
