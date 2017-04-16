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

			// Get Latest Id todo! #16
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('id')
				->from($db->qn('#__dd_gmaps_locations'))
				->where($db->quoteName('state').' = 1')
				->order('id DESC');
			$db->setQuery($query);
			$id = $db->loadResult();

			$html = '<script>
// Setup Id field jform_params_profile_id
jQuery(document).ready(function() {
	jQuery(\'#jform_params_profile_id\').val(' . $id . ');
	jQuery(\'#jform_last_profile_id\').val(' . $id . ');
	
	jQuery("#jform_last_profile_id").on("change paste keyup", function() {
   		jQuery(\'#jform_params_profile_id\').val(jQuery(this).val()); 
    });
});

</script>';

			$html .= '<input required="required" id="jform_last_profile_id" value="Last ID" size="40" class="input-medium" type="text">';
			$html .= '<p><b>Note: Select is in this Version currently not implemented. (Comming soon!)<br>AutoSetup ID is last published location ID or type manually.</b></p>';
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
