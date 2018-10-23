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
 * Class DD_GMaps_LocationsViewExtensions
 *
 * @since  Version  1.1.1.6
 */
class DD_GMaps_LocationsViewExtensions extends JViewLegacy
{
	protected $items;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since  Version  1.1.1.6
	 * @throws  Exception
	 */
	public function display($tpl = null)
	{
		$this->items = $this->get('items');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
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
	 * @since   Version  1.1.1.6
	 */
	protected function addToolbar()
	{
		$canDo = JHelperContent::getActions('com_dd_gmaps_locations');

		JToolBarHelper::title(JText::_('COM_DD_GMAPS_LOCATIONS_TOOLBARTITLE_EXTENSIONS'), 'tree-2');

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_dd_gmaps_locations');
		}

	}

	/**
	 * Add the sidebar
	 *
	 * @return  void
	 *
	 * @since   Version  1.1.1.6
	 */
	protected function addSidebar()
	{
		DD_GMaps_LocationsHelper::addSubmenu('extensions');
		$this->sidebar = JHtml::_('sidebar.render');
	}
}
