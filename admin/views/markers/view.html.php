<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsViewMarkers
 *
 * @since  Version  1.1.0.6
 */
class DD_GMaps_LocationsViewMarkers extends JViewLegacy
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

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since  Version  1.1.0.6
	 * @throws  Exception
	 */
	public function display($tpl = null)
	{
		if ($this->getLayout() !== 'modal')
		{
			DD_GMaps_LocationsHelper::addSubmenu('markers');
		}

		$this->items        = $this->get('Items');
		$this->state        = $this->get('State');
		$this->pagination   = $this->get('Pagination');

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
	 * @since   Version  1.1.0.6
	 */
	protected function addToolbar()
	{
		$canDo = JHelperContent::getActions('com_dd_gmaps_locations', 'category', $this->state->get('filter.category_id'));
		$user  = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolbar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_DD_GMAPS_LOCATIONS_TOOLBARTITLE_MARKERS'), '');

		if ($user->authorise('core.admin', 'com_dd_gmaps_locations') || $user->authorise('core.options', 'com_dd_gmaps_locations'))
		{
			JToolbarHelper::preferences('com_dd_gmaps_locations');
		}

		$bar->appendButton('Link', 'new-tab-2', 'COM_DD_GMAPS_LOCATIONS_EDIT_VIA_CATEGORY', 'index.php?option=com_categories&extension=com_dd_gmaps_locations');
	}

	/**
	 * Add the sidebar
	 *
	 * @return  void
	 *
	 * @since   Version  1.1.0.6
	 */
	protected function addSidebar()
	{
		DD_GMaps_LocationsHelper::addSubmenu('markers');
		$this->sidebar = JHtml::_('sidebar.render');
	}

	/**
	 * Drop Down Filter
	 *
	 * @return array
	 *
	 * @since Version 1.1.0.6
	 */
	protected function getSortFields()
	{
		return array(
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}
