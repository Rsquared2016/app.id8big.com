<?php

/**
 * ktnews
 *
 * @author BOrtoli German and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
global $CONFIG;

$page_owner = elgg_get_page_owner_entity();
$object_subtype = 'meeting';

//@KEETUP_MOD: This was modified by keetup to not allow access to group 
if ($page_owner instanceof ProjectGroup && is_callable('project_gatekeeper')) {
//	if (FALSE == $page_owner->canWriteToContainer()){
	$project_gatekeeper = project_gatekeeper(false);
	if (!$project_gatekeeper){
		forward($page_owner->getURL());
	} 
}	

elgg_register_title_button();

$filter_context = get_input('entity_owner_filter', 'all');

elgg_pop_breadcrumb();

$title = elgg_echo("meeting:plugin:page_owner:list");

if ($filter_context == 'all') {
	elgg_push_breadcrumb(elgg_echo('meeting'));
} else {
	elgg_push_breadcrumb(elgg_echo('meeting'), 'meeting/all');
}

switch($filter_context) {
	case 'mine':
		if ($page_owner instanceof ElggGroup) {
			$title = elgg_echo("meeting");
		}
		else {
			$title = elgg_echo("meeting:plugin:listing:mine", array('title' => $page_owner->name));
		}
		elgg_push_breadcrumb($page_owner->name);
	break;
	case 'friends':
		$title = elgg_echo("meeting:plugin:listing:friends");
		elgg_push_breadcrumb($page_owner->name, "meeting/owner/$page_owner->username");
		elgg_push_breadcrumb(elgg_echo('friends'));
	break;
}

if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}


$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$meeting_handler = new MeetingHandler();

// Get site timezone
if (is_callable('elgg_timezone_get_timezone_site')) {
    // Function added into this module
    $site_timezone = elgg_timezone_get_timezone_site();
}
else {
    $site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
}
// Get current timezone
$current_timezone = date_default_timezone_get();
// Set site timezone
date_default_timezone_set($site_timezone);
// Get site_end_datetime to compare
$site_end_datetime = time();
// Set current timezone
date_default_timezone_set($current_timezone);

$options = array(
	 'offset' => $offset,
	 'limit' => $limit,
     'metadata_name_value_pairs' => array(
        array(
            'name' => 'site_end_datetime',
            'value' => $site_end_datetime,
            'operand' => '>=',
        ),
     ),
     'order_by_metadata' => array(
        'name' => 'site_start_datetime',
        'direction' => 'ASC',
        'as' => 'integer',
     ),
);

$entities_list = $meeting_handler->list_filter_entities($options);

$body = '';



//Main Title section
/****** ADD SEARCH SUPPORT LINKS *****
$add_link = elgg_view('output/url', array('href' => $CONFIG->url . 'meeting/add/', 'text' => elgg_echo('meeting:listing:link:add')));
$search_link_text = elgg_echo('meeting:listing:link:search');
$search_support = MeetingBaseMain::ktform_get_filter('meeting');
$body .= elgg_view('meeting/listing/main_title', array('title' => $title, 'add_link' => $add_link, 'search_link_text' => $search_link_text,'search_support' => $search_support));
 * 
 */

$search_support = MeetingBaseMain::ktform_get_filter('meeting');
$sidebar = elgg_view('meeting/listing/sidebar_searchform', array('search_support' => $search_support));

//If no entities, do not show the listing titles.
if ($entities_list) {
	$body .= elgg_view('meeting/listing/sortable_filter', array('object_subtype' => $object_subtype));
	//Titles section
//	$body .= elgg_view('meeting/listing/titles', array('object_subtype' => $object_subtype));
}
//Entities
//Remember always it is needed.

$body .= elgg_view('meeting/listing/wrapper', array('entities' => $entities_list, 'entity_subtype' => $object_subtype));

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