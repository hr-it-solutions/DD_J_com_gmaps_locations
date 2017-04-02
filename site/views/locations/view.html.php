<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsViewLocations extends JViewLegacy
{

	protected $items;

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
		$this->items       = $this->get('Items');

		$this->sef_rewrite = JFactory::getConfig()->get('sef_rewrite');
		$this->active_alias = JFactory::getApplication()->getMenu()->getActive()->alias;

		if (count($errors = $this->get('Errors')))
		{
			JError::raise(500, implode("\n", $errors));

			return false;
		}

		return parent::display($tpl);
	}
}