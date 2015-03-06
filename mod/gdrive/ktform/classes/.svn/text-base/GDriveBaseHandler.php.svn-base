<?php

/**
 * GDriveBaseHandler
 *
 * This class handle the way to retrieve and list the entities of the object.
 *
 * @author Diego Gallardo and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

/**
 * Below an extended class as example
 * @example ../docs/examples/classes/KtBlogHandler.php
 */
class GDriveBaseHandler {

	protected $type = 'object';
	protected $subtype;
	protected $plugin_name;

	public function __construct($type, $subtype, $plugin_name = NULL) {
		$this->type = $type;
		$this->subtype = $subtype;

		if (empty($plugin_name)) {
			$plugin_name = elgg_get_context();
		}

		$this->plugin_name = $plugin_name;
	}

	/**
	 * Counts default entities using the options passed on elgg get entities
	 * 
	 * @param array $options
	 * @return array 
	 */
	public function count_entities($options = array()) {
		return $this->get_entities(array_merge($options, array('count' => TRUE)));
	}

	/**
	 * Counts the filtered entities.
	 * @param array $options
	 * @return array 
	 */
	public function count_filter_entities($options = array()) {
		$options = array_merge($options, array('count' => TRUE));
		return $this->get_filter_entities($options);
	}

	/**
	 * Get an array of entities using elgg get entities passing the options
	 * @param array $options
	 * @return array 
	 */
	public function get_entities($options = array()) {
		$default = array(
			'type' => $this->type,
			'subtype' => $this->subtype,
		);

		//Add filter by owner options.
		$owner = get_input('entity_owner_filter', 'all');
		$default = gdrive_handler_add_owner_filter_options($owner, $default);

		$options = array_merge_recursive($default, $options);
		return elgg_get_entities_from_metadata($options);
	}

	/**
	 * Get the entities filtered using default gdrive_ktform filters.
	 * 
	 * @global type $CONFIG
	 * @param array $options
	 * @return entiites 
	 */
	public function get_filter_entities($options = array(), $filter_values_options = array()) {
		global $CONFIG;

		$default = array(
			'metadata_name_value_pairs' => array(),
			'joins' => array(),
			'wheres' => array(),
		);
		
		if (empty($options)) {
			$options = array();
		}
		
		$options = array_merge($default, $options);

		//Check if we want to override the current form filter.
		if(isset($options['form_filter']) && $options['form_filter'] instanceof GDriveBaseForm) {
			$form_object = $options['form_filter'];
		} else {
			//Get the filter form model, so we know what search and how.
			$form_object = GDriveBaseMain::ktform_get_filter_object($this->plugin_name);
		}
		
		
		//If we have no filter object setted, then make a normal elgg get entities.
		if (empty($form_object) || !($form_object instanceof GDriveBaseForm)) {
			return $this->get_entities($options);
		}

		//Retrieve an array of k/v to make filters	
		//If we send the filter values, use it, otherwise, get from form.
		if(count($filter_values_options)) {
			$filter_values = $filter_values_options;
		} else {
			$filter_values = $form_object->getFilterValues();
		}
		
		//start to build queries depending on filter types, for now we have owner and keywords, this will be extended
		$ikey = 0; 
		foreach ($filter_values as $filter) {
			if(is_array($filter['value'])) {
				$value = array_map('sanitise_string', $filter['value']); // trim blank spaces
			} else {
				$value = trim(sanitise_string($filter['value']));
			}

			switch ($filter['filter_type']) {
				case 'owner':
					$options['joins'][] = "JOIN {$CONFIG->dbprefix}users_entity ue on ue.guid = e.owner_guid";
					$options['wheres'][] = "( ue.name LIKE '%{$value}%' OR ue.username LIKE '%{$value}%' )";
				break;

				case 'keyword':
					//KTODO: Agregar soporte de objetos y subtipos ( por ejemplo que pueda buscar por grupo, usuario o entidad )
					//KTODO: Agregar soporte de busqueda fulltext. Ver busqueda de elgg:
					switch ($this->type) {
					//set user filtering
						case 'user':
							$options['joins'][] = "JOIN {$CONFIG->dbprefix}users_entity oe on oe.guid = e.guid";
							$options['wheres'][] = "( oe.name LIKE '%{$value}%' OR oe.username LIKE '%{$value}%' )";								
						break;

						//Set groups filtering
						case 'group':
							$options['joins'][] = "JOIN {$CONFIG->dbprefix}groups_entity oe on oe.guid = e.guid";
							$options['wheres'][] = "( oe.name LIKE '%{$value}%' OR oe.description LIKE '%{$value}%' )";								
						break;					
					
					//Set object filtering
						default:
							$options['joins'][] = "JOIN {$CONFIG->dbprefix}objects_entity oe on oe.guid = e.guid";
							$options['wheres'][] = "( oe.title LIKE '%{$value}%' OR oe.description LIKE '%{$value}%' )";		
						break;
					}
					
				break;
			
				case 'keetup_categories':
					if (is_numeric($value) && $value > 0) {
						$sub_category = get_input('subcategory_id');
						if (empty($sub_category)) {
							$options['metadata_name_value_pairs'][] = array('name' => 'kt_category', 'value' => "{$value}");
						} else {
							$options['metadata_name_value_pairs'][] = array('name' => 'kt_subcategory', 'value' => "{$sub_category}");
							
						}
					}
				break;
				
				case 'calendar_start':
					$calendar_start = $filter['value'];
					$calendar_start_internalname = $filter['internalname'];
					if(isset($filter['filter_options']['internalname'])) {
						$calendar_start_internalname = $filter['filter_options']['internalname'];
					}
					
					$calendar_end = FALSE;
					$calendar_end_internalname = '';
					
					//We search for calendar end values
					foreach($filter_values as $tmp_filter) {
						if ($tmp_filter['filter_type'] == 'calendar_end') {
							if (is_numeric($tmp_filter['value']) && empty($calendar_end)) {
								$calendar_end = $tmp_filter['value'];
								$calendar_end_internalname = $tmp_filter['internalname'];
								
								if(isset($tmp_filter['filter_options']['internalname'])) {
									$calendar_end_internalname = $tmp_filter['filter_options']['internalname'];
								}
								
							} //endif
						} //endif
					} //endforeach
					
					
					if (is_numeric($calendar_start) && $calendar_start > 0) {
						$options['metadata_name_value_pairs'][] = array('name' => $calendar_start_internalname, 'value' => "{$calendar_start}", 'operand' => '>=');
					}
					
					if (is_numeric($calendar_end) && $calendar_end > 0 && !empty($calendar_end_internalname)) {
						$options['metadata_name_value_pairs'][] = array('name' => $calendar_end_internalname, 'value' => "{$calendar_end}", 'operand' => '<=');
					}					
				break;
				case 'location':
					//Steps:
					//1. We suppose we got the lat,long values
					//2. If 1. fails, try to call geocode location.
					//3. We not got the lat and long params. Makes the search.
					if($value!='' && is_callable('geolokation_get_geolokation_options')) {
						$options['nearest'] = array(
							'location' => $value,
						);
						
						//Check if we got radius
						$radio_distance = get_input('radio_distance');
						if($radio_distance) {
							$radio_distance = sanitise_string($radio_distance);
							$options['nearest']['radius'] = $radio_distance;
						}
						
						
						$options = geolokation_get_geolokation_options($options);
					}

					break;
					
				case 'metadata':
					//The internalname, should be the same as the metadata.
					$internalname = trim(sanitise_string($filter['internalname']));
					if ($value != '' && $internalname != '') {
						//Default name 
						$metadata_name = $internalname;
						$metadata_value = $value;
						$operand = ' = ';
						
						if(isset($filter['filter_options']['metadata_name'])) {
							$metadata_name = $filter['filter_options']['metadata_name'];
						}
						if (isset($filter['filter_options']['operand'])) {
							$operand = ' '.$filter['filter_options']['operand'].' ';
						}
						if ($operand == ' LIKE ') {
							$metadata_value = '%'.$metadata_value.'%';
						}
		
						//KTODO: Improve the search.
						/*$options['metadata_name_value_pairs'][] = array(
							'name' => $metadata_name,
							'value' => $metadata_value,
							//'operator' => '' //Add the options to send as a param.
						);*/

						//KTODO: Convert all metadata name value pairs into normal joins. 
						
						//Convert all metadata name value pairs. :S
						//Make the join an filter by metadata, here, becuase elgg, 
						//have a bug with many metadata filters.
						
						//$value = $meta_value;
						$i = "_{$metadata_name}{$ikey}";
						$access = " AND " . get_access_sql_suffix("n_table{$i}");

						//KEETUP: Improved search, make 2 joins instead of 3, to filter by metadata.
						$meta_string_id = get_metastring_id($metadata_name, FALSE);
						$n_table_where = '';
						if ($meta_string_id) {
							if(is_array($meta_string_id)) {
								$meta_string_id = implode(', ', $meta_string_id);				
							}
							$n_table_where = "AND n_table{$i}.name_id in ($meta_string_id) $access";

							$options['joins'][] = "JOIN {$CONFIG->dbprefix}metadata n_table{$i} on e.guid = n_table{$i}.entity_guid $n_table_where";
							//$options['joins'][] = "JOIN {$CONFIG->dbprefix}metastrings msn{$i} on n_table{$i}.name_id = msn{$i}.id";
							$options['joins'][] = "JOIN {$CONFIG->dbprefix}metastrings msv{$i} on n_table{$i}.value_id = msv{$i}.id";

							$options['wheres'][] = "(msv{$i}.string $operand '$metadata_value')";
						}
						$ikey++;
					}

					break;
					
				
			}
		}
		
//		echo '<pre>';
//		var_dump($options);
//		echo '</pre>';
//		exit;
		
		/**
		 * We get the input to hide the form search and could be used for other stuffs, egg, to know when you submited a search
		 */
		$blank_submit = get_input("searching_{$this->plugin_name}");

		//if (count($filter_options) > 0 || $blank_submit) {
		if ($blank_submit) {
			set_input("{$this->plugin_name}_search", TRUE);
		}
		
		$inputted = get_input("{$this->plugin_name}_search");
		
		/**
		 * Sortable features
		 */
		$order_by = get_input('order_by', FALSE);
		$sort_type = get_input('sort_type', 'asc');
		$order_type = get_input('order_type', 'text');
		
		switch($sort_type) {
			case 'desc':
				$sort_type = 'DESC';
			break;			
			default:
				$sort_type = 'ASC';
			break;
		}
		
		if ($order_by) {
			//We order by metadata
			$order_by = sanitize_string($order_by);	
			$options['order_by_metadata'] = array('name' => $order_by, 'direction' => $sort_type, 'as' => $order_type);
		}
		
		return $this->get_entities($options);
	}

	/**
	 *
	 * List entities using the options that we send
	 * 
	 * @param array $options
	 * @return string 
	 */
	public function list_entities($options = array()) {
		$defaults = array(
			'offset' => (int) max(get_input('offset', 0), 0),
			'limit' => (int) max(get_input('limit', 10), 0),
			'full_view' => FALSE,
			'view_type_toggle' => FALSE,
			'pagination' => TRUE,
		);

		$options = array_merge($defaults, $options);

		$count = $this->count_entities($options);
		$entities = $this->get_entities($options);


		return elgg_view_entity_list($entities, $count, $options['offset'], $options['limit'], $options['full_view'], $options['view_type_toggle'], $options['pagination']);
	}

	/**
	 * List filtered entities
	 * 
	 * @param array $options
	 * @return string 
	 */
	public function list_filter_entities($options = array()) {
		$defaults = array(
			'offset' => (int) max(get_input('offset', 0), 0),
			'limit' => (int) max(get_input('limit', 10), 0),
			'full_view' => FALSE,
			'view_type_toggle' => FALSE,
			'pagination' => TRUE,
		);

		$options = array_merge($defaults, $options);

		$count = $this->count_filter_entities($options);
		$entities = $this->get_filter_entities($options);

		return elgg_view_entity_list($entities, $count, $options['offset'], $options['limit'], $options['full_view'], $options['view_type_toggle'], $options['pagination']);
	}

}

/*
 * Additional function.
 * 
 * This should not be placed here, but it is only one function.
 * */

function gdrive_handler_add_owner_filter_options($owner, $options) {
	if (!$options) {
		$options = array();
	}

	switch ($owner) {
		case 'mine':
			// Get the current page's owner
			$page_owner = elgg_get_page_owner_entity();
			$container = '';
			$owner_guid = ELGG_ENTITIES_ANY_VALUE;
			
			if ($page_owner === false || is_null($page_owner)) {
				$page_owner = elgg_get_logged_in_user_entity();
				$page_owner_id = $page_owner->guid;
				if ($page_owner_id) {
					elgg_set_page_owner_guid($page_owner_id);
					$container = $page_owner_id;
				}
			}

			if ($page_owner instanceof ElggGroup) {
				$container = $page_owner->guid;
			}
			
			if ($page_owner instanceof ElggUser) {
				$container = $page_owner->guid;
				$owner_guid = $page_owner->guid;
			}

			if (empty($owner_guid)) {
				$options['container_guid'] = $container;
			}
			$options['owner_guid'] = $owner_guid;
			break;

		case 'friends':
			$friends = get_user_friends(elgg_get_logged_in_user_guid(), '', 99999);
			$friendguids = array();
			if ($friends) {
				foreach ($friends as $friend) {
					$friendguids[] = $friend->getGUID();
				}
			} else {
				$friendguids = -1;
			}
			$options['owner_guids'] = $friendguids;
			break;

		case 'member':
		 $page_owner = elgg_get_page_owner_entity();


		 if ($page_owner === false || is_null($page_owner)) {
			$page_owner = elgg_get_logged_in_user_entity();
			$page_owner_id = $page_owner->guid;
			if ($page_owner_id) {
			   elgg_set_page_owner_guid($page_owner_id);
			}
		 }

		 $relationship_option = elgg_get_entity_relationship_where_sql('e', 'member', $page_owner->getGUID(), FALSE);

		 $options = array_merge($options, $relationship_option);
		 
		case 'all':
		default:
			//Add no filter.
			break;
	}

	return $options;
}