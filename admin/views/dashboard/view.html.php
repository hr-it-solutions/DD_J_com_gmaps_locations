<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsViewDashboard
 *
 * @since  Version  1.1.0.0
 */
class DD_GMaps_LocationsViewDashboard extends JViewLegacy
{
	protected $items;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since  Version  1.1.0.0
	 */
	public function display($tpl = null)
	{
		$this->items = $this->get('items');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
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
		$this->addToolbar();
	}
}
