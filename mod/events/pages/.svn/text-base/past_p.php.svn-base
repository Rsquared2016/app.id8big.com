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

elgg_register_title_button();

$object_subtype = 'event';


$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$events_handler = new EventsHandler();

$options = array(
	'offset' => $offset,
	'limit' => $limit,
);

$time = time();//strtotime(date('d F Y', time()));
$options['metadata_name_value_pairs'][] = array(
        'name' => 'end_event_date_time',
        'value' => $time,
        'operand' => '<',
        );

elgg_get_entities_from_metadata();


$entities_list = $events_handler->list_filter_entities($options);

$title = elgg_echo("events:plugin:listing:past:title");

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

$vars['filter'] = false;

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);