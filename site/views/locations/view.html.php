<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsViewLocations extends JViewLegacy
{
	protected $app;

	protected $items;

	protected $params;

	protected $sef_rewrite;

	protected $active_alias;

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

		$this->items = $this->get('Items');

		$this->params = $this->app->getParams();

		$this->sef_rewrite  = JFactory::getConfig()->get('sef_rewrite');
		$this->active_alias = $this->app->getMenu()->getActive()->alias;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		return parent::display($tpl);
	}
}
