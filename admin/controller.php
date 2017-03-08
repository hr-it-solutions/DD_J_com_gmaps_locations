<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsController extends JControllerLegacy{

	protected $default_view = 'dashboard';

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

		parent::display();

		return $this;
	}

}