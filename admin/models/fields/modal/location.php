<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
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

	protected $id;

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   Version 1.1.0.8
	 */
	protected function getInput()
	{
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal');

		// Setup variables for display.
		$html	= array();

		/* Get javascript variable from iframe to this parent frame */
		$html[] = '<script type=\'text/javascript\'>';
		$html[] = ' function onDDGMapsLocationSelect_Callback(id,title) {';
		$html[] = '     jQuery(\'#jform_request_modal_location_required\').val(\'1\');';
		$html[] = '     jQuery(\'#jform_params_profile_id\').val(id);';
		$html[] = '     jQuery(\'#jform_request_modal_location\').val(title);';
		$html[] = '     SqueezeBox.close();';
		$html[] = ' }';
		$html[] = '</script>';

		$html[] = '<style>#jform_request_modal_location_required-lbl, #jform_request_modal_location_required {display: none;}</style>';

		$this->id = JFactory::getApplication()->input->get('id', 'INT');

		$link	= 'index.php?option=com_dd_gmaps_locations&amp;view=locations&amp;layout=modal&tmpl=component';

		// Select menu item params
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);

		$query->select('params')
			->from($db->qn('#__menu'))
			->where($db->qn('id') . '=' . (int) $this->id);
		$db->setQuery($query);

		$params = $db->loadResult();

		if (is_object(json_decode($params)) && isset(json_decode($params)->profile_id))
		{
			$profile_id = json_decode($params)->profile_id;

			// Select loaction title by profile_id
			$db = JFactory::getDbo();

			$query = $db->getQuery(true);

			$query->select('title')
				->from($db->quoteName('#__dd_gmaps_locations'))
				->where($db->quoteName('id') . '=' . (int) $profile_id);
			$db->setQuery($query);

			$title = $db->loadResult();
		}
		else
		{
			$title = '';
		}

		// The current selected field.
		$html[] = '<div class="fltlft">';
		$html[] = '  <input type="text" name="modal_location" required="required" class="required" id="jform_request_modal_location" value="' . $title . '" disabled="disabled" size="35" placeholder="' . JText::_('COM_DD_GMAPS_LOCATIONS_SELECT_LOCATION_LABEL') . '" />';
		$html[] = '</div>';

		// The select button.
		$html[] = '<div class="button2-left">';
		$html[] = '  <div class="blank">';
		$html[] = '	<a class="modal" title="' . JText::_('COM_DD_GMAPS_LOCATIONS_CHANGE_LOCATION') . '"  href="' . $link . '&amp;' . JSession::getFormToken() . '=1" rel="{handler: \'iframe\', size: {x: 800, y: 450}}">' . JText::_('COM_DD_GMAPS_LOCATIONS_CHANGE_LOCATION_BUTTON') . '</a>';
		$html[] = '  </div>';
		$html[] = '</div>';

		return implode("\n", $html);
	}
}
