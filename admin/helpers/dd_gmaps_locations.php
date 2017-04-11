<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Class DD_GMaps_LocationsHelper
 *
 * @since  Version 1.1.0.0
 */
class  DD_GMaps_LocationsHelper extends JHelperContent
{

	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   Version 1.1.0.0
	 */
	public static function addSubmenu($vName)
	{
		// Dashboard
		JHtmlSidebar::addEntry(
			JText::_('COM_DD_GMAPS_LOCATIONS_SIDEBARTITLE_DASHBOARD'),
			'index.php?option=com_dd_gmaps_locations&view=dashboard',
			$vName == 'dashboard'
		);

		// Locations
		JHtmlSidebar::addEntry(
			JText::_('COM_DD_GMAPS_LOCATIONS_SIDEBARTITLE_LOCATIONS'),
			'index.php?option=com_dd_gmaps_locations&view=locations',
			$vName == 'locations'
		);

		// Categories
		JHtmlSidebar::addEntry(
			JText::_('JCATEGORIES'),
			'index.php?option=com_categories&extension=com_dd_gmaps_locations'
		);
	}

	/**
	 * Get latitude and longitude by address from Google GeoCode API
	 *
	 * @param   array  $data  The form data which must include 'street' 'zip' 'location' 'federalstate' and 'country'
	 *
	 * @return  array         latitude and longitude
	 *
	 * @since   Version 1.1.0.0
	 */
	public static function Geocode_Location_To_LatLng($data)
	{
		// Get Location Data
		$address = array(
			'street'        => $data['street'],
			'zip'           => $data['zip'],
			'location'      => $data['location'],
			'federalstate'  => $data['federalstate'],
			'country'       => JText::_($data['country']) // Convert language string to country name
		);

		// Get API Key if key is set
		$google_api_URL_pram = '';
		$google_api_key_geocode = JComponentHelper::getParams('com_dd_gmaps_locations')->get('google_api_key_geocode', false);

		if ($google_api_key_geocode)
		{
			$google_api_URL_pram    = '&key=' . trim($google_api_key_geocode);
		}
		// Prepare Address
		$prepAddr = implode('+', $address);

		// Get Contents and decode
		$geoCode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($prepAddr) . '&sensor=false' . $google_api_URL_pram);
		$output  = json_decode($geoCode);

		if ($output->error_message != "") // If Error on API Connection, display error not
		{
			JFactory::getApplication()->enqueueMessage($output->error_message, 'Note');
		}

		// Build array latitude and longitude
		$latlng = array("latitude"  => $output->results[0]->geometry->location->lat,
						"longitude" => $output->results[0]->geometry->location->lng);

		// Return Array
		return $latlng;
	}

	/**
	 * Checks plausibility of alias and prepare for URLSafe
	 * If alias ist not unique, a unique ID was prefixed (loaction ID)
	 *
	 * @param $data
	 *
	 * @return string alias
	 */
	public static function prepareAlias($data)
	{
		// Get alias
		if ($data['alias'] != '')
		{
			$alias = $data['alias'];
		}
		else
		{
			$alias = $data['title'];
		}

		// Prepare alias for URLSafe
		$alias = JFilterOutput::stringURLSafe($alias);

		// Plausibility check unique alias
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('alias')
			->from($db->quoteName('#__dd_gmaps_locations'))
			->where($db->quoteName('alias') . " ='$alias' AND " . $db->quoteName('id') . " <> " . $data['id']);
		$db->setQuery($query);

		if ($db->loadResult())
		{
			JFactory::getApplication()->enqueueMessage('COM_DD_GMAPS_LOCATIONS_CHECKALIAS_ALIAS_UNIQUE', 'notice');
			$alias = $data['id'] . '-' . $alias;
		}

		return $alias;

	}


	/**
	 * Get Component Version
	 *
	 * @return string component version
	 *
	 * @since  Version  1.1.0.0
	 */
	public static function getComponentVersion()
	{
		$xml = JFactory::getXML(JPATH_ADMINISTRATOR . '/components/com_dd_gmaps_locations/dd_gmaps_locations.xml');
		$version = (string) $xml->version;

		return $version;
	}

	/**
	 * Get Component Coyright
	 *
	 * @return string component copyright
	 *
	 * @since  Version  1.1.0.0
	 */
	public static function getComponentCoyright()
	{
		$xml = JFactory::getXML(JPATH_ADMINISTRATOR . '/components/com_dd_gmaps_locations/dd_gmaps_locations.xml');
		$copyright = (string) $xml->copyright;

		return $copyright;
	}
}