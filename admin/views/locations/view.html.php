<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
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
	 * @since  Version  1.1.0.0
	 * @throws  Exception
	 */
	public function display($tpl = null)
	{
		if ($this->getLayout() !== 'modal')
		{
			DD_GMaps_LocationsHelper::addSubmenu('locations');
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
	 * @since   Version  1.1.0.0
	 */
	protected function addToolbar()
	{
		$canDo = JHelperContent::getActions('com_dd_gmaps_locations', 'category', $this->state->get('filter.category_id'));
		$user  = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolbar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_DD_GMAPS_LOCATIONS_TOOLBARTITLE_LOCATIONS'), '');

		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_dd_gmaps_locations', 'core.create'))) > 0)
		{
			JToolbarHelper::addNew('location.add');
		}

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
		{
			JToolbarHelper::editList('location.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('locations.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('locations.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}

		// Add a batch button
		if ($user->authorise('core.create', 'com_dd_gmaps_locations')
			&& $user->authorise('core.edit', 'com_dd_gmaps_locations')
			&& $user->authorise('core.edit.state', 'com_dd_gmaps_locations'))
		{
			$title = JText::_('JTOOLBAR_BATCH');

			// Instantiate a new JLayoutFile instance and render the batch button
			$layout = new JLayoutFile('joomla.toolbar.batch');

			$dhtml = $layout->render(array('title' => $title));
			$bar->appendButton('Custom', $dhtml, 'batch');
		}

		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'locations.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('locations.trash');
		}

		if ($user->authorise('core.admin', 'com_dd_gmaps_locations') || $user->authorise('core.options', 'com_dd_gmaps_locations'))
		{
			JToolbarHelper::preferences('com_dd_gmaps_locations');
		}

		JToolbarHelper::help('JHELP_CONTENT_ARTICLE_MANAGER');
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
