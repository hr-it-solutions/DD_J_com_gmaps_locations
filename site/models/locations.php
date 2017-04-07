<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsModelLocations extends JModelList {

	/**
	 * DD_GMaps_LocationsModelLocations constructor.
	 *
	 * @param array $config
	 */
	public function __construct($config = array())
	{
		if(empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'company', 'a.company',
				'contact_person', 'a.contact_person',
				'phone', 'a.phone',
				'email', 'a.email',
				'street', 'a.street',
				'location', 'a.location',
				'zip', 'a.zip',
				'country', 'a.country',
				'category_title', 'a.catid',
				'publish_up', 'a.publish_up',
				'publish_down', 'a.publish_down'
			);
		}

		parent::__construct($config);
	}

	/**
	 * @return JDatabaseQuery
	 */
	protected function getListQuery()
	{

		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		$select = $db->qn(
			array(
				'a.id',
				'a.title',
				'a.alias',
				'a.catid',
				'a.state',
				'a.profileimage',
				'a.image',
				'a.company',
				'a.contact_person',
				'a.phone',
				'a.email',
				'a.street',
				'a.location',
				'a.zip',
				'a.country',
				'a.federalstate',
				'a.latitude',
				'a.longitude',
				'a.short_description',
				'a.description',
				'a.created',
				'a.publish_up',
				'a.publish_down',
				'a.hits',
				'a.featured'
			)
		);

		$query->select($select)
			->from($db->qn('#__dd_gmaps_locations', 'a'));

		// Filter state
		$query->where('a.state = 1');

		// Join over categories
		$query->select($db->qn('c.title', 'category_title'))
			->leftJoin($db->qn('#__categories', 'c') . ' ON (' . $db->qn('c.id') . ' = ' . $db->qn('a.catid') . ')');

		$query->order('a.id DESC');

		return $query;
	}
}