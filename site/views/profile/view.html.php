<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsViewProfile extends JViewLegacy {

	protected $app;

	protected $params;

	protected $item;

	protected $input;

	protected $alias;

	protected $profile_id;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse
	 *
	 * @return boolean | mixed
	 *
	 * @since Version 1.1.0.0
	 */
	function display($tpl = null)
	{
		$this->app = JFactory::getApplication();

		$this->input      = $this->app->input;
		$this->alias      = $this->input->get('alias',      false, 'STRING');
		$this->profile_id = $this->input->get('profile_id', false, 'STRING');

		// Load Profile SetUp from Menu parameters
		$activeMenu = $this->app->getMenu()->getItem($this->app->getMenu()->getActive()->id);

		if (method_exists($activeMenu, 'getParams')) // Joomla 3.7.xx
		{
			$activeMenuParams   = $activeMenu->getParams();
			$this->input->set('profile_id', ($activeMenuParams->get('profile_id')));
			$this->profile_id = $activeMenuParams->get('profile_id');
		}
		else // Joomla 3.5.xx
		{
			$this->input->set('profile_id', ($activeMenu->parent_id));
			$this->profile_id = $activeMenu->parent_id;
		}

		// Get the component configuration
		$this->params     = JComponentHelper::getParams('com_dd_gmaps_locations');

		if ($this->alias && $this->alias !== 'profile' OR $this->profile_id)
		{
			$this->item = $this->get('Item');
		}
		else
		{
			JError::raise(404);

			return false;
		}

		// Set Input ID for 3rd party connection
		if ($this->profile_id == false)
		{
			$this->input->set('profile_id', $this->item->id);
		}

		if (count($errors = $this->get('Errors')))
		{
			JError::raise(500, implode("\n", $errors));

			return false;
		}

		return parent::display($tpl);
	}
}
