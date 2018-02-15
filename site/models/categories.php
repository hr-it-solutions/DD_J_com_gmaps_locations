<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsModelCategories extends JModelList
{

	/**
	 * populateState
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since Version 1.1.1.8
	 */
	protected function populateState($ordering = null, $direction = null, $listlimit = true)
	{
		parent::populateState($ordering, $direction);

		$app = JFactory::getApplication();
		$params = $app->getParams();

		$catid = (int) JFactory::getApplication()->input->get('catid');

		// Category
		if ($catid)
		{
			$this->setState('dd_filter.catid', $catid);
		}

		// Count locations
		if ($params->get('count_items', false))
		{
			$this->setState('dd_filter.count_items', $params->get('count_items'));
		}
	}

	/**
	 * getListQuery
	 *
	 * @since Version 1.1.1.8
	 *
	 * @return JDatabaseQuery
	 */
	public function getListQuery()
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$catid  = (int) $this->getState('dd_filter.catid');

		$select = $db->qn(array('c.id', 'c.title', 'c.description', 'c.params'));

		$query->select($select);

		$query->from($db->qn('#__categories', 'c'))
			->join('INNER', $db->qn('#__categories', 'cc') . ' ON ' . $db->qn('c.parent_id') . ' = ' . $db->qn('cc.id'))
			->where($db->qn('c.parent_id') . ' != 1')
			->where($db->qn('cc.id') . ' = ' . $db->q($catid))
			->where($db->qn('c.published') . '= 1 OR' . ($db->qn('c.id') . ' = ' . $db->q($catid)));

		// Count items
		if ($this->getState('dd_filter.count_items'))
		{
			$query->select('COUNT(*) AS ' . $db->qn('count'))
				->join('LEFT', $db->qn('#__dd_gmaps_locations', 'a') . ' ON ' . $db->qn('a.catid') . ' = ' . $db->qn('c.id'))
				->where($db->qn('a.state') . '= 1')
				->group($db->qn('c.id'));
		}

		$db->setQuery($query);

		return $query;
	}
}
