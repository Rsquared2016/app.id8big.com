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
$object_subtype = 'help';

if(elgg_is_admin_logged_in()) {
	elgg_register_title_button();
}

$filter_context = get_input('entity_owner_filter', 'all');

elgg_pop_breadcrumb();

$title = elgg_echo("help:plugin:page_owner:list");

if ($filter_context == 'all') {
	elgg_push_breadcrumb(elgg_echo('help'));
} else {
	elgg_push_breadcrumb(elgg_echo('help'), 'help/all');
}

switch($filter_context) {
	case 'mine':
		$title = elgg_echo("help:plugin:listing:mine", array('title' => $page_owner->name));
		elgg_push_breadcrumb($page_owner->name);
	break;
	case 'friends':
		$title = elgg_echo("help:plugin:listing:friends");
		elgg_push_breadcrumb($page_owner->name, "help/owner/$page_owner->username");
		elgg_push_breadcrumb(elgg_echo('friends'));
	break;
}

if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}


$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$help_handler = new HelpHandler();

$options = array(
	 'offset' => $offset,
	 'limit' => $limit,
);

$entities_list = $help_handler->list_filter_entities($options);

$body = '';



//Main Title section
/****** ADD SEARCH SUPPORT LINKS *****
$add_link = elgg_view('output/url', array('href' => $CONFIG->url . 'help/add/', 'text' => elgg_echo('help:listing:link:add')));
$search_link_text = elgg_echo('help:listing:link:search');
$search_support = HelpBaseMain::ktform_get_filter('help');
$body .= elgg_view('help/listing/main_title', array('title' => $title, 'add_link' => $add_link, 'search_link_text' => $search_link_text,'search_support' => $search_support));
 * 
 */

$search_support = HelpBaseMain::ktform_get_filter('help');
$sidebar = elgg_view('help/listing/sidebar_searchform', array('search_support' => $search_support));

//If no entities, do not show the listing titles.
if ($entities_list) {
	$body .= elgg_view('help/listing/sortable_filter', array('object_subtype' => $object_subtype));
	//Titles section
//	$body .= elgg_view('help/listing/titles', array('object_subtype' => $object_subtype));
}
//Entities
//Remember always it is needed.

$body .= elgg_view('help/listing/wrapper', array('entities' => $entities_list, 'entity_subtype' => $object_subtype));

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