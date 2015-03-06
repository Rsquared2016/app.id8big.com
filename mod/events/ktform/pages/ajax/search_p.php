<?php
//Clear for XSS hack.

$query = sanitise_string(stripslashes(get_input('term')));

/*
 * NOTE:
 * This pg is based into the elgg search pg, but without all the submenu and url handles.
 * It only use the search section.
 * If it is upgraded in future the search file, this file must be upgraded too.
 * */ 

//use search default hooks
//elgg_trigger_plugin_hook('search', 'user', 'search_users_hook');
//elgg_trigger_plugin_hook('search', 'group', 'search_groups_hook');
//elgg_trigger_plugin_hook('search', 'object', 'search_objects_hook');

//Customize the view type.
elgg_set_viewtype('ajax_search');

// $search_type == all || entities || tags || trigger plugin hook
$search_type = get_input('search_type', 'entities');

// get limit and offset.  override if on search dashboard, where only 2
// of each most recent entity types will be shown.
$offset = get_input('offset', 0);
$limit = get_input('limit', 8);
$entity_type = get_input('entity_type', ELGG_ENTITIES_ANY_VALUE);
$entity_subtype = get_input('entity_subtype', ELGG_ENTITIES_ANY_VALUE);

$sort = 'relevance'; //'relevance', 'created', 'updated', 'action_on', 'alpha'.
$order = 'desc'; //desc, asc

//$types = array('user', 'group', 'object');
/*
Array (
    [user] => Array ()
    [group] => Array ()
    [object] => Array (
            [0] => blog
            [1] => file
            [3] => image
            [4] => album
            [5] => meetup
        )
)
*/
//$types = get_registered_entity_types();
//We want the types in ceratain order.
$types = kt_search_get_registered_entity_types();

/*
 Array (
    [0] => tags
    [1] => comments
)
*/
//For the moment we remove the serach of tag and comments. 
$custom_types = elgg_trigger_plugin_hook('search_types', 'get_types', $params, array());


$search_results = array();
$results_html = '';

// set up search params
$params = array(
	'query' => $query,
	'offset' => $offset,
	'limit' => $limit,
	'sort' => $sort,
	'order' => $order,
	'search_type' => $search_type,
	'type' => $entity_type,
	'subtype' => $entity_subtype,
	//'pagination' => ($search_type == 'all') ? FALSE : TRUE
);

if ($search_type == 'all' || $search_type == 'entities') {
	// to pass the correct current search type to the views
	$current_params = $params;
	$current_params['search_type'] = 'entities';
	
	// foreach through types.
	// if a plugin returns FALSE for subtype ignore it.
	// if a plugin returns NULL or '' for subtype, pass to generic type search function.
	// if still NULL or '' or empty(array()) no results found. (== don't show??)
	foreach ($types as $type => $subtypes) {
		if($current_params['limit'] <= 0) {
			break;
		}
		
		if ($search_type != 'all' && $entity_type != $type) {
			continue;
		}
	
		if (is_array($subtypes) && count($subtypes)) {
			foreach ($subtypes as $subtype) {
				if($current_params['limit'] <= 0) {
					break;
				}
				
				// no need to search if we're not interested in these results
				// @todo when using index table, allow search to get full count.
				if ($search_type != 'all' && $entity_subtype != $subtype) {
					continue;
				}
				$current_params['subtype'] = $subtype;
				$current_params['type'] = $type;
	
				$results = elgg_trigger_plugin_hook('search', "$type:$subtype", $current_params, NULL);
				if ($results === FALSE) {
					// someone is saying not to display these types in searches.
					continue;
				} elseif (is_array($results) && !count($results)) {
					// no results, but results searched in hook.
				} elseif (!$results) {
					// no results and not hooked.  use default type search.
					// don't change the params here, since it's really a different subtype.
					// Will be passed to elgg_get_entities().
					$results = elgg_trigger_plugin_hook('search', $type, $current_params, array());
				}
	
				if (is_array($results['entities']) && $results['count']) {
					//Reduce the search depending on the previous result of the search.
					$current_params['limit'] = $current_params['limit'] - count($results['entities']);
					
					if ($view = search_get_search_view($current_params, 'listing')) {
						$serialized_results = elgg_view($view, array('results' => $results, 'params' => $current_params));
					}
				}
			}
		} else {
	
			// pull in default type entities with no subtypes
			$current_params['type'] = $type;
			$current_params['subtype'] = ELGG_ENTITIES_NO_VALUE;
		
			$results = elgg_trigger_plugin_hook('search', $type, $current_params, array());
			if ($results === FALSE) {
				// someone is saying not to display these types in searches.
				continue;
			}
		
			if (is_array($results['entities']) && $results['count']) {
				//Reduce the search depending on the previous result of the search.
				$current_params['limit'] = $current_params['limit'] - count($results['entities']);
				
				if ($view = search_get_search_view($current_params, 'listing')) {
					$serialized_results = elgg_view($view, array('results' => $results, 'params' => $current_params));
				}
			}
		}
	}
}

// call custom searches
if ($search_type != 'entities' || $search_type == 'all') {
	if (is_array($custom_types)) {
		foreach ($custom_types as $type) {
			
			if ($search_type != 'all' && $search_type != $type) {
				continue;
			}

			//Check if we have previus params loaded.
			if(!$current_params) {
				$current_params = $params;
			}
			$current_params['search_type'] = $type;
			//Check if we reach the limit.
			if($current_params['limit'] <= 0) {
				break;
			}
			// custom search types have no subtype.
			unset($current_params['subtype']);

			$results = elgg_trigger_plugin_hook('search', $type, $current_params, array());

			if ($results === FALSE) {
				// someone is saying not to display these types in searches.
				continue;
			}

			if (is_array($results['entities']) && $results['count']) {
				//Reduce the search depending on the previous result of the search.
				$current_params['limit'] = $current_params['limit'] - count($results['entities']);
				
				if ($view = search_get_search_view($current_params, 'listing')) {
					$serialized_results = elgg_view($view, array('results' => $results, 'params' => $current_params));
				}
			}
		}
	}
}

global $jsonexport;

////Footer of the search.
//if(count($jsonexport['asearch']['entities'])) {
//	$footer = elgg_view('search/footer', array(
//		'params' => $params,
//	));
//	
//} else {
//	$no_results = elgg_view('search/no_results', array(
//		'params' => $params,
//	));
//	
//}
	
$search_results = $jsonexport['asearch']['entities'];

echo json_encode($search_results);