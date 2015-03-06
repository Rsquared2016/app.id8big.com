<?php

/**
 * Kt Ajax Init lib
 * 
 * @author Bortoli German <gbortoli@keetup.com>
 * @package    MeetingBaseForm
 * @subpackage meeting_ajax
 */
define('KT_SEARCH_MAX_TITLE_LENGTH', 100);
define('KT_SEARCH_DESC_LENGTH', 100);
define('KT_SEARCH_DESC_ONLY_LENGTH', 100);

/**
 * Init the ajax 
 */
function meeting_ajax_init() {
	elgg_register_page_handler('search_endpoint', 'meeting_ajax_endpoint_handler');
	elgg_extend_view('page/elements/head', 'metatags/jquery_autocomplete', 1000);

	elgg_register_plugin_hook_handler('search', 'countries_short', 'meeting_search_countries_short');

	elgg_register_plugin_hook_handler('search_types', 'get_types', 'meeting_search_register_country_types');
}

function meeting_ajax_endpoint_handler($page = array()) {
	!@include_once(dirname(dirname(__FILE__)) . "/pages/ajax/search_p.php");
	return true;
}

/**
 * Return the registered types in certain order, because we want to search in that order.
 * 
 * Order:
 * - user
 * - group
 * - object
 *  
 */
function meeting_search_get_registered_entity_types() {
	$types = get_registered_entity_types();

	//We want to search in the order: user, groups, objets. :S
	$ordered_types = array();
	if (array_key_exists('user', $types)) {
		$ordered_types['user'] = $types['user'];
	}
	if (array_key_exists('group', $types)) {
		$ordered_types['group'] = $types['group'];
	}

	if (array_key_exists('object', $types)) {
		$ordered_types['object'] = $types['object'];
	}

	$types = $ordered_types;

	return $types;
}

/**
 * Return an array of different fileters and the fields it add to make that filter.
 * 
 *  return array
 */
function meeting_search_get_filters_list() {
	$filter_list = array();

	$types = meeting_search_get_registered_entity_types();
	$custom_types = elgg_trigger_plugin_hook('search_types', 'get_types', array(), array());

	//Add all first
	$data = array(
		 'label' => elgg_echo('all'),
	);
	$filter_list[] = $data;

	foreach ($types as $type => $subtypes) {
		// @todo when using index table, can include result counts on each of these.
		if (is_array($subtypes) && count($subtypes)) {
			foreach ($subtypes as $subtype) {
				$label = "item:$type:$subtype";

				$data = array(
					 'label' => elgg_echo($label),
					 //'q' => $query,
					 'entity_subtype' => $subtype,
					 'entity_type' => $type,
					 //'owner_guid' => $owner_guid,
					 'search_type' => 'entities',
					 //'friends' => $friends,
					 'filter_type' => $subtype,
				);

				//Add it.
				$filter_list[] = $data;
			}
		} else {
			$label = "item:$type";

			$data = array(
				 'label' => elgg_echo($label),
				 //'q' => $query,
				 'entity_type' => $type,
				 //'owner_guid' => $owner_guid,
				 'search_type' => 'entities',
				 //'friends' => $friends,
				 'filter_type' => $type,
			);
			//Add it.
			$filter_list[] = $data;
		}
	}

	// add submenu for custom searches
	foreach ($custom_types as $type) {
		$label = "search_types:$type";

		$data = array(
			 'label' => elgg_echo($label),
			 //'q' => $query,
			 //'entity_subtype' => $entity_subtype,
			 //'entity_type' => $entity_type,
			 //'owner_guid' => $owner_guid,
			 'search_type' => $type,
			 //'friends' => $friends,
			 'filter_type' => $type,
		);

		//Add it.
		$filter_list[] = $data;
	}

	return $filter_list;
}

function meeting_search_extract_src_from_img_tag($img_tag) {
	$values = array();
	$src = '';
	//preg_match_all('/(alt|title|src)=("[^"]*")/i',$img_tag, $values);
	preg_match_all('/(src)=("[^"]*")/i', $img_tag, $values);

	if ($values && is_array($values)) {
		end($values);
		$src = current($values);
		if (is_array($src)) {
			$src = trim(current($src), '"');
		}
		if ($src) {
			$src = trim($src, '"');
		}
	}

	return $src;
}

function meeting_search_countries_short($hook, $object_type, $returnvalue, $params) {
	$search_type = FALSE;
	if (!empty($params['search_type']) && $params['search_type'] == 'countries_short') {
		$search_type = $params['search_type'];
	}

	$country_short = get_input('country_short', FALSE);
	$all_countries = MeetingBaseMain::ktform_get_country_values();

	$valid_countries = FALSE;
	if ($country_short) {
		$country_short_valid = strtoupper($country_short);
		if (array_key_exists($country_short_valid, $all_countries)) {
			$valid_countries = TRUE;
		}
	}
	//KTODO: Remove this later. Force valid countries.
	$valid_countries = TRUE;

	if ($search_type && $country_short && $valid_countries) {
		global $CONFIG;
		
		$query = $params['query'];
		
		if (empty($query)) {
			return FALSE;
		}
		
		$query = sanitize_string(trim($query));
		
		$options = array(
			 'limit' => $params['limit'],
			 'offset' => $params['offset'],
			 'type' => $params['type'],
		);
		
		$subtype = get_input('entity_subtype');
		if ($subtype) {
			$options['subtype'] = $subtype;
		}
		
//		$options['wheres'][] = "( oe.title LIKE '%{$value}%' OR oe.description LIKE '%{$value}%' )";		
		
		switch($options['type']) {
			case 'user':
				$options['joins'][] = "JOIN {$CONFIG->dbprefix}users_entity oe on oe.guid = e.guid";
				$options['wheres'][] = "( oe.name LIKE '%{$query}%' )";				
			break;
			case 'group':
				$options['joins'][] = "JOIN {$CONFIG->dbprefix}groups_entity oe on oe.guid = e.guid";
				$options['wheres'][] = "( oe.name LIKE '%{$query}%' )";
			break;
			default:
				$options['joins'][] = "JOIN {$CONFIG->dbprefix}objects_entity oe on oe.guid = e.guid";
				$options['wheres'][] = "( oe.title LIKE '%{$query}%' )";
			break;
			
		}
		
		$options['metadata_name_value_pairs'][] = array('name' => 'country_short', 'value' => $country_short, 'metadata_case_sensitive' => FALSE); 
		$entities = elgg_get_entities_from_metadata($options);
		$count = elgg_get_entities_from_metadata(array_merge($options, array('count' => TRUE)));
		

		
			foreach ($entities as $entity) {
				$entity_title = '';
				if ($entity->getType() == 'object') {
					$entity_title = $entity->title;
				} else {
					$entity_title = $entity->name;
				}
				
				$title = search_get_highlighted_relevant_substrings($entity_title, $params['query']);
				$entity->setVolatileData('search_matched_title', $title);

				$desc = search_get_highlighted_relevant_substrings($entity->description, $params['query']);
				$entity->setVolatileData('search_matched_description', $desc);
			}
		
			return array(
				'entities' => $entities,
				'count' => $count,
			);

	}
}

function meeting_search_register_country_types($hook, $object_type, $returnvalue, $params) {
	$returnvalue['countries_short'] = 'countries_short';
	return $returnvalue;
}

elgg_register_event_handler('init', 'system', 'meeting_ajax_init');