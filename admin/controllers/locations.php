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
	 *
	 * @param   string  $name    Name of the model
	 * @param   string  $prefix  Prefix of the model
	 * @param   array   $config  Array
	 *
	 * @return  mixed
	 *
	 * @since Version 1.1.0.0
	 */
	public function getModel($name = 'Location', $prefix = 'LocationModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	/**
	 * SaveOrderAjax from Sidebar Filter
	 *
	 * @since Version 1.1.0.0
	 */
	public function saveOrderAjax()
	{
		$input = JFactory::getApplication()->input;
		$pks = (int) $input->post->get('cid', array(), 'array');
		$order = (int) $input->post->get('order', array(), 'array');

		$model = $this->getModel();

		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		JFactory::getApplication()->close();
	}
}