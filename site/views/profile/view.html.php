<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
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

		// Component configuration
		$this->params     = JComponentHelper::getParams('com_dd_gmaps_locations');

		// Active menu
		$activeMenu = $this->app->getMenu()->getItem($this->app->getMenu()->getActive()->id);

		if (method_exists($activeMenu, 'getParams')) // Joomla 3.7.xx
		{
			// Active menu params
			$activeMenuParams   = $activeMenu->getParams();

			// SetUp profile_id from menu parameters
			$this->input->set('profile_id', ($activeMenuParams->get('profile_id')));
			$this->profile_id = $activeMenuParams->get('profile_id');

			// Get meta data from menu
			$metadesc = $activeMenuParams->get('menu-meta_description');
			$metakey  = $activeMenuParams->get('menu-meta_keywords');
			$robots = $activeMenuParams->get('robots');
		}
		else // Joomla 3.5.xx
		{
			// Set profile_id from menu parameters
			$this->input->set('profile_id', ($activeMenu->parent_id));
			$this->profile_id = $activeMenu->parent_id;

			// Get meta data from menu
			$metadesc = $activeMenu->{'menu-meta_description'};
			$metakey  = $activeMenu->{'menu-meta_keywords'};
			$robots = $activeMenu->robots;
		}

		if ($this->alias && $this->alias !== 'profile' OR $this->profile_id)
		{
			$this->item = $this->get('Item');
		}
		else
		{
			throw new Exception(404, 404);
		}

		// Set Input ID for 3rd party connection
		if ($this->profile_id == false)
		{
			$this->input->set('profile_id', $this->item->id);
		}

		// Set meta data hedaer from menu : default from item
		$doc = JFactory::getDocument();
		$doc->setMetaData('description', $metadesc ? $metadesc : $this->item->metadesc);
		$doc->setMetaData('keywords', $metakey ? $metakey : $this->item->metakey);
		$doc->setMetaData('robots', $robots);

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		return parent::display($tpl);
	}
}
