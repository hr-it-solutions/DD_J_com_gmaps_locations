<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-04-16
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die();

/**
 * Supports a modal article picker.
 *
 * @since  1.6
 */
class JFormFieldModal_Location extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $type = 'Modal_Location';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   1.6
	 */
	protected function getInput()
	{
		$allowSelect = ((string) $this->element['select'] != 'false');

		// Script to proxy the select modal function to the modal-fields.js file.
		if ($allowSelect)
		{
			$html = '<input required="required" readonly="readonly" id="jform_type" value="Last ID" size="40" class="input-medium" type="text">';
			$html .= '<p><b>Note: Select is in this Version currently not possible</b></p>';
		}

		return $html;
	}

	/**
	 * Method to get the field label markup.
	 *
	 * @return  string  The field label markup.
	 *
	 * @since   3.4
	 */
	protected function getLabel()
	{
		return str_replace($this->id, $this->id . '_id', parent::getLabel());
	}
}
