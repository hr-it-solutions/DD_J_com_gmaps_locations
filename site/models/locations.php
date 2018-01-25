<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_GMaps_LocationsModelLocations extends JModelList {

	/**
	 * DD_GMaps_LocationsModelLocations constructor.
	 *
	 * @param   array  $config  config
	 *
	 * @since Version 1.1.0.0
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
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
	 * populateState
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since Version 1.1.0.0
	 */
	protected function populateState($ordering = null, $direction = null, $listlimit = true)
	{
		parent::populateState($ordering, $direction);

		$app = JFactory::getApplication();
		$params = $app->getParams();

		if ($listlimit)
		{
			$this->setState('list.limit', (int) $params->get('items_to_list', 6));
		}

		$orderby_sec = $params->get('orderby_sec', 'default');

		if ($orderby_sec != 'default')
		{
			$this->setState('list.orderby_sec',  $orderby_sec);
		}


		// Special Filter
		if ($params->get('filter_catid', false))
		{
			$this->setState('dd_filter.catid', $params->get('filter_catid'));
		}

		if ($params->get('filter_location', false))
		{
			$this->setState('dd_filter.location', $params->get('filter_location'));
		}

		if ($params->get('filter_country', false))
		{
			$this->setState('dd_filter.country', $params->get('filter_country'));
		}

		if ($params->get('filter_federalstate', false))
		{
			$this->setState('dd_filter.federalstate', $params->get('filter_federalstate'));
		}
	}

	/**
	 * getSearchFilterInput locations_searchfilter submit
	 * via self form post data or ajax request $dataAjax
	 *
	 * @since Version 1.1.0.0
	 *
	 * @return Object with validated filtered filter input data
	 */
	protected function getSearchFilterInput()
	{
		$filterInput = new StdClass;

		$app = JFactory::getApplication();
		$input = $app->input;

		$dataAjax   = $input->get("data", '', 'array');

		if ($dataAjax != '')
		{
			$input->set('locationLatLng',  $dataAjax['locationLatLng']);
			$input->set('fulltext_search', $dataAjax['fulltext_search']);
			$input->set('category_filter', $dataAjax['category_filter']);
			$input->set('federalstate_filter', $dataAjax['federalstate_filter']);
		}

		$locationLatLng = $input->get('locationLatLng', 0, 'STRING');
		$fulltext_search = $input->get('fulltext_search', '', 'STRING');
		$category_filter = $input->get('category_filter', 0, 'INT');
		$federalstate_filter = $input->get('federalstate_filter', '', 'STRING');


		if ($locationLatLng)
		{
			$latLng = explode(",", $locationLatLng);
			$filterInput->lat = (float) substr($latLng[0], 0, 10);
			$filterInput->lng = (float) substr($latLng[1], 0, 10);
		}

		if ($fulltext_search != '')
		{
			$filterInput->fulltext_search = $fulltext_search;
		}

		if ($category_filter)
		{
			$filterInput->category_filter = (int) $category_filter;
		}

		if ($federalstate_filter)
		{
			$filterInput->federalstate_filter = $federalstate_filter;
		}

		return $filterInput;
	}

	/**
	 * getListQuery
	 *
	 * @since Version 1.1.0.0
	 *
	 * @return JDatabaseQuery
	 */
	public function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		$filterInput = $this->getSearchFilterInput();

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
				'a.mobile',
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
				'a.ext_c_id',
				'a.created',
				'a.created_by',
				'a.publish_up',
				'a.publish_down',
				'a.hits',
				'a.featured'
			)
		);

		$query->select($select)
			->from($db->qn('#__dd_gmaps_locations', 'a'));

		// Filter state for cmty_edit load model
		if ($this->getState('filter.state') !== 'all')
		{
			$query->where('a.state = 1');
		}

		if (isset($filterInput->fulltext_search))
		{
			$query->where(
				$db->qn('a.title') . ' LIKE "%' . $filterInput->fulltext_search . '%" OR ' .
				$db->qn('a.company') . ' LIKE "%' . $filterInput->fulltext_search . '%" OR ' .
				$db->qn('a.contact_person') . ' LIKE "%' . $filterInput->fulltext_search . '%" OR ' .
				$db->qn('a.short_description') . ' LIKE "%' . $filterInput->fulltext_search . '%" OR ' .
				$db->qn('a.description') . ' LIKE "%' . $filterInput->fulltext_search . '%" OR ' .
				$db->qn('c.title') . ' LIKE "%' . $filterInput->fulltext_search . '%"');
		}

		// Filter by author
		$authorId = $this->getState('filter.author_id');

		if (is_numeric($authorId))
		{
			$type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
			$query->where('a.created_by ' . $type . (int) $authorId);
		}

		if (isset($filterInput->federalstate_filter))
		{
			$query->where($db->qn('a.federalstate') . ' = ' . $db->q($filterInput->federalstate_filter));
		}

		// Special Menu Filter

		if (isset($filterInput->category_filter))
		{
			$query->where($db->qn('a.catid') . ' = ' . $filterInput->category_filter);
		}
		elseif ($this->getState('dd_filter.catid'))
		{
			$query->where($db->qn('a.catid') . ' = ' . $db->q($this->getState('dd_filter.catid')));
		}

		if ($this->getState('dd_filter.location'))
		{
			$query->where($db->qn('a.location') . ' = ' . $db->q($this->getState('dd_filter.location')));
		}

		if ($this->getState('dd_filter.country'))
		{
			$query->where($db->qn('a.country') . ' = ' . $db->q($this->getState('dd_filter.country')));
		}

		if ($this->getState('dd_filter.federalstate') && !isset($filterInput->federalstate_filter))
		{
			$query->where($db->qn('a.federalstate') . ' = ' . $db->q($this->getState('dd_filter.federalstate')));
		}

		// Join over categories
		$query->select(
			$db->qn('c.title') . 'AS' . $db->qn('category_title') . ',' .
			$db->qn('c.description') . 'AS' . $db->qn('category_description') . ',' .
			$db->qn('c.params') . 'AS' . $db->qn('category_params')
		)
			->leftJoin($db->qn('#__categories', 'c') . ' ON (' . $db->qn('c.id') . ' = ' . $db->qn('a.catid') . ')');

		if (isset($filterInput->lat) && isset($filterInput->lng))
		{
			/**
			 *	find nearest latitude longitude
			 */
			$query->select('( 6371 * acos( cos( radians( ' . $filterInput->lat .
				' ) ) * cos( radians( ' . $db->qn('latitude') .
				' ) ) * cos( radians( ' . $db->qn('longitude') .
				' ) - radians( ' . $filterInput->lng . ' ) ) + sin(radians( ' . $filterInput->lat .
				' )) * sin(radians( ' .
				$db->qn('latitude') .
				' )) ) )' .
				$db->qn('distance')
			)
			->order('distance ASC');
		}
		else
		{
			if ($this->getState('list.orderby_sec') == 'alpha')
			{
				$query->order('a.title ASC');
			}
			elseif ($this->getState('list.orderby_sec') == 'ralpha')
			{
				$query->order('a.title DESC');
			}
			else
			{
				$query->order('a.id DESC');
			}
		}

		return $query;
	}

	/**
	 * getAjaxList
	 *
	 * @param   array  $data  POST params
	 *
	 * @since Version 1.1.0.0
	 *
	 * @return mixed
	 */
	public function getAjaxList($data)
	{
		$db    = $this->getDbo();
		$query = $this->_getListQuery();

		$query->order('a.id DESC LIMIT ' . (int) $data['start'] . ', ' . (int) $data['limit']);

		return $db->setQuery($query)->loadObjectList();
	}

	/**
	 * bufferAjaxOutputView by rendering each data item through default_items template
	 *
	 * @param   array  $items  items to render
	 * @param   array  $data   POST params
	 *
	 * @since Version 1.1.0.0
	 *
	 * @return string html output string
	 */
	public function bufferAjaxOutputView($items, $data)
	{
		$i = $data['start'];

		// Output buffer
		ob_start();

		foreach ($items as $item)
		{

			// Get custom fields
			JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
			$fields = FieldsHelper::getFields('com_dd_gmaps_locations.location', $item, true);

			// Assigne custom fields to $item->jcfields
			if($fields)
			{
				foreach ($fields as $key => $field)
				{
					if($field->value != '')
					{
						$item->jcfields[$field->id] = $field;
					}
				}
			}

			if ($i % 2 == 0)
			{
				echo '</div><div class="row-fluid">';
			}

			$override = JPATH_ROOT . '/templates/' .
				JFactory::getApplication()->getTemplate() .
				'/html/com_dd_gmaps_locations/locations/default_items.php';

			if (JFile::exists($override))
			{
				include $override;
			}
			else
			{
				include JPATH_COMPONENT . '/views/locations/tmpl/default_items.php';

			}

			++$i;
		}

		// Output return and filter
		$output = preg_replace('/\s*$^\s*/m', '', ob_get_contents());
		$output = preg_replace('/\s*$^\s*/m', '', $output);

		ob_end_clean();

		return $output;

	}
}
