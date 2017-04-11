<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsController extends JControllerLegacy {

	/**
	 * getAjax
	 *
	 * @since Version 1.1.0.0
	 *
	 * @return mixed
	 */
	public function getAjax()
	{
		$format = strtolower(JRequest::getWord('format', 'raw'));
		$app    = JFactory::getApplication();
		$input  = $app->input;
		$data   = $input->get("data", '', 'array');
		$callback = $input->get('callback', 'not set');

		if ($data != '')
		{
			$model = $this->getModel('Locations');
			$items = $model->getAjaxList($data);

			$results = array(
				'success' => true,
				'items' => $items
				);
		}
		else
		{
			$results = array('success' => false);
		}


		switch ($format)
		{
			case 'json': JResponse::setHeader('Content-Type', 'application/json', true);

				if ($callback == "not set")
				{
					echo json_encode($results);
				}
				else
				{
					JResponse::setHeader('Access-Control-Allow-Origin:', '*');
					echo $callback . '(' . json_encode($results) . ')';
				}

				$app->close();
				break;

			case 'debug': echo '<pre>' . print_r($results, true) . '</pre>';
				$app->close();
				break;

			case 'raw':
			default: echo is_array($results) ? implode($results) : $results;

				$app->close();
				break;
		}

		return false;

	}
}
