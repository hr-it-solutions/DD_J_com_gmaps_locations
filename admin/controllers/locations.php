<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-08
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsControllerLocations extends JControllerAdmin
{

	/**
	 * Call Location Model
	 * @param string $name Name of the model
	 * @param string $prefix Prefix of the model
	 * @param array  $config
	 *
	 * @return mixed
	 * @since Version 3.6.5
	 */
	public function getModel($name = 'Location', $prefix = 'LocationModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}