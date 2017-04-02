<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsViewProfile extends JViewLegacy {

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

		$this->input      = JFactory::getApplication()->input;
		$this->alias      = $this->input->get('alias',      false, 'STRING');
		$this->profile_id = $this->input->get('profile_id', false, 'STRING');

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

		if (count($errors = $this->get('Errors')))
		{
			JError::raise(500, implode("\n", $errors));

			return false;
		}

		return parent::display($tpl);
	}
}