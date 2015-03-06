<?php

/**
 * ktnews
 *
 * @author Bortoli German and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */


global $CONFIG;

$page_owner = elgg_get_page_owner_entity();

$search_from = get_input('search_from', '');

elgg_register_title_button();

$object_subtype = 'event';

$filter_context = get_input('entity_owner_filter', 'all');

elgg_pop_breadcrumb();

$from_date = get_input('from_date');
$to_date = get_input('to_date');

if ($filter_context == 'all') {
	elgg_push_breadcrumb(elgg_echo('events'));
} else {
	elgg_push_breadcrumb(elgg_echo('events'), 'events/all');
}


//@KEETUP_MOD: This was modified by keetup to not allow access to group 
if ($page_owner instanceof ProjectGroup && is_callable('project_gatekeeper')) {
//	if (FALSE == $page_owner->canWriteToContainer()){
    $project_gatekeeper = project_gatekeeper(FALSE);
	if (!$project_gatekeeper){
		forward($page_owner->getURL());
	} 
}

switch($filter_context) {
	case 'mine':
		if ($page_owner instanceof ElggGroup) {
			$title = elgg_echo("events");
		}
		else {
			$title = elgg_echo("events:plugin:listing:mine", array('title' => $page_owner->name));
		}
		elgg_push_breadcrumb($page_owner->name);
	break;
	case 'friends':
		$title = elgg_echo("events:plugin:listing:friends");
		elgg_push_breadcrumb($page_owner->name, "events/owner/$page_owner->username");
		elgg_push_breadcrumb(elgg_echo('friends'));
	break;
}

//if ($page_owner instanceof ElggGroup) {
//    elgg_push_breadcrumb($page_owner->name, $page_owner->getURL());
//}

if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}


$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$events_handler = new EventsHandler();

$options = array(
	'offset' => $offset,
	'limit' => $limit,
);

$when_operand = ">=";
//$order = "msv1.string ASC";
$current_timezone = date_default_timezone_get();

$from_time = strtotime(date('d F Y', time()));


$options = array(
//	'order_by' => $order,
	'metadata_case_sensitive' => true,
);

$options['order_by_metadata'] = array(
	'name' => 'star_event_date_time',
	'direction' => 'ASC',
	'as' => 'integer',
);

$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	

$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');

if (!$user_timezone) {
	$user_timezone = $server_timezone;
}

$offset_time = elgg_timezone_get_timezone_offset($user_timezone, $server_timezone);

if ($from_date) {
	date_default_timezone_set($server_timezone);
	
	if ($search_from == 'calendar') {
		$operand = '<=';
		$from_date .= ' 23:59:59';
	}
	else {
		$operand = '>=';
		$from_date .= ' 00:00:00';
	}
	
	$from_time = strtotime($from_date);
	
	$from_time += $offset_time;
	
	date_default_timezone_set($current_timezone);

	
	$options['metadata_name_value_pairs'][] = array(
				'name' => 'star_event_date_time',
				'value' => $from_time,
				'operand' => $operand,
	);
}
if ($to_date) {
	date_default_timezone_set($server_timezone);
	
	if ($search_from == 'calendar') {
		$operand = '>=';
		$to_date .= ' 00:00:00';
	}
	else {
		$operand = '<=';
		$to_date .= ' 23:59:59';
	}
	
	$to_time = strtotime($to_date);
	
//	$to_date = date("Y-m-d",$to_date);
	
//	$to_time = strtotime($to_date .' 23:59:59');

	$to_time += $offset_time;

	date_default_timezone_set($current_timezone);

	
	$options['metadata_name_value_pairs'][] = array(
				'name' => 'end_event_date_time',
				'value' => $to_time,
				'operand' => $operand,
	);
	
	// Si la busuqeda ($search_from) NO viene del link que esta en el calendar
	// entonces el 'metadata_name_value_paris_operator' que tome el por defecto, 
	// o sea el AND, si viene del calendar, que tome OR
    if ($from_date && $search_from == 'calendar') {
        $options['metadata_name_value_pairs_operator'] = 'OR';
		// La fecha de inicio del evento (msv1.string) NO debe ser mayor a la fecha de fin
		$options['wheres'][] = "(msv1.string <= {$to_time})";
    }
}

if (!$from_date && !$to_date) {
     $time = time();//strtotime(date('d F Y', time()));
    $options['metadata_name_value_pairs'][] = array(
				'name' => 'end_event_date_time',
				'value' => $time,
				'operand' => '>=',
				);
}
$entities_list = $events_handler->list_filter_entities($options);
//$title = elgg_echo("events:plugin:listing:title");

$body = '';

//Main Title section
$search_support = EventsBaseMain::ktform_get_filter('events');
$sidebar = elgg_view('events/listing/sidebar_searchform', array('search_support' => $search_support));

//If no entities, do not show the listing titles.
if ($entities_list) {
	$body .= elgg_view('events/listing/sortable_filter', array('object_subtype' => $object_subtype));
}
//Entities
//Remember always it is needed.

$body .= elgg_view('events/listing/wrapper', array('entities' => $entities_list, 'entity_subtype' => $object_subtype));

$vars = array(
	 'filter_context' => $filter_context,
	 'content' => $body,
	 'title' => $title,
	 'sidebar' => $sidebar,
);

// don't show filter if out of filter context
if ($page_owner instanceof ElggGroup) {
	$vars['filter'] = false;
}

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);