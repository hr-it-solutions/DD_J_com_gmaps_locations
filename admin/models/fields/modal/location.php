<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die();

/**
 * Supports a modal location picker.
 *
 * @since  Version 1.1.0.8
 */
class JFormFieldModal_Location extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  Version 1.1.0.8
	 */
	protected $type = 'Modal_Location';

	protected $id;

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @throws Exception
	 * @since   Version 1.1.0.8
	 */
	protected function getInput()
	{
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal');

		// @TODO move to setup() method
		$allowClear  = ((string) $this->element['clear'] != 'false');
		$allowSelect = ((string) $this->element['select'] != 'false');

		$value = (int) $this->value > 0 ? (int) $this->value : '';

		// Create the modal id.
		$modalId = 'Location_' . $this->id;

		// Add the modal field script to the document head.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/modal-fields.js', array('version' => 'auto', 'relative' => true));

		// Script to proxy the select modal function to the modal-fields.js file.
		if ($allowSelect)
		{
			static $scriptSelect = null;

			if (is_null($scriptSelect))
			{
				$scriptSelect = array();
			}

			if (!isset($scriptSelect[$this->id]))
			{
				JFactory::getDocument()->addScriptDeclaration("
				function jSelectLocation_" . $this->id . "(id, title, url) {
					window.processModalSelect('Location', '" . $this->id . "', id, title, null, null, url, null);
				}
				");

				$scriptSelect[$this->id] = true;
			}
		}

		$link	= 'index.php?option=com_dd_gmaps_locations&view=locations&layout=modal&tmpl=component';

		$modalTitle    = JText::_('COM_DD_GMAPS_LOCATIONS_CHANGE_LOCATION');
		$urlSelect = JRoute::_($link . '&function=jSelectLocation_' . $this->id);

		// Select menu item params
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);

		$query->select($query->qn('title'))->from($query->qn('#__dd_gmaps_locations'))->where($query->qn('id') . ' = ' . (int) $this->value);

		try
		{
			$title = $db->setQuery($query)->loadResult();
		}
		catch (RuntimeException $e)
		{
			throw new Exception($e->getMessage(), 500);
		}

		$title = empty($title) ? JText::_('COM_DD_GMAPS_LOCATIONS_CHANGE_LOCATION') : htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

		// The current location display field.
		$html  = '<span class="input-append">';
		$html .= '<input class="input-medium" id="' . $this->id . '_name" type="text" value="' . $title . '" disabled="disabled" size="35" />';

		// Select location button
		if ($allowSelect)
		{
			$html .= '<a'
				. ' class="btn hasTooltip' . ($value ? ' hidden' : '') . '"'
				. ' id="' . $this->id . '_select"'
				. ' data-toggle="modal"'
				. ' role="button"'
				. ' href="#ModalSelect' . $modalId . '"'
				. ' title="' . JHtml::tooltipText('COM_DD_GMAPS_LOCATIONS_CHANGE_LOCATION') . '">'
				. '<span class="icon-file" aria-hidden="true"></span> ' . JText::_('JSELECT')
				. '</a>';
		}

		// Clear location button
		if ($allowClear)
		{
			$html .= '<a'
				. ' class="btn' . ($value ? '' : ' hidden') . '"'
				. ' id="' . $this->id . '_clear"'
				. ' href="#"'
				. ' onclick="window.processModalParent(\'' . $this->id . '\'); return false;">'
				. '<span class="icon-remove" aria-hidden="true"></span>' . JText::_('JCLEAR')
				. '</a>';
		}

		$html .= '</span>';

		// Select article modal
		if ($allowSelect)
		{
			$html .= JHtml::_(
				'bootstrap.renderModal',
				'ModalSelect' . $modalId,
				array(
					'title'       => $modalTitle,
					'url'         => $urlSelect,
					'height'      => '400px',
					'width'       => '800px',
					'bodyHeight'  => '70',
					'modalWidth'  => '80',
					'footer'      => '<a role="button" class="btn" data-dismiss="modal" aria-hidden="true">' . JText::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</a>',
				)
			);
		}

		// Note: class='required' for client side validation.
		$class = $this->required ? ' class="required modal-value"' : '';

		$html .= '<input type="hidden" id="' . $this->id . '_id" ' . $class . ' data-required="' . (int) $this->required . '" name="' . $this->name
			. '" data-text="' . htmlspecialchars(JText::_('COM_CONTENT_SELECT_AN_ARTICLE', true), ENT_COMPAT, 'UTF-8') . '" value="' . $value . '" />';

		return $html;
	}
}
