<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsController extends JControllerLegacy{

	/**
	 * The default view.
	 *
	 * @var    string
	 *
	 * @since  Version 1.1.0.1
	 */
	protected $default_view = 'dashboard';

	/**
	 * Method to display a view.
	 *
	 * @param   boolean        $cachable   If true, the view output will be cached
	 * @param   array|boolean  $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  ContentController|boolean  This object to support chaining.
	 *
	 * @since   Version 1.1.0.1
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$view   = $this->input->get('view', 'location');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Prevent edit form from directly access
		if ($view == 'location' && $layout == 'edit' && !$this->checkEditId('com_dd_gmaps_locations.edit.location', $id))
		{
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_dd_gmaps_locations&view=dashboard', false));

			return false;
		}

		return parent::display();
	}
}
