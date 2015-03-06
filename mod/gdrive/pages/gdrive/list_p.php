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
$object_subtype = 'gdrive';
$user_logged_in_guid = elgg_get_logged_in_user_guid();

//@KEETUP_MOD: This was modified by keetup to not allow access to group 
if ($page_owner instanceof ProjectGroup && is_callable('project_gatekeeper')) {
//        if (FALSE == $page_owner->canWriteToContainer()){
    $project_gatekeeper = project_gatekeeper(false);
	if (!$project_gatekeeper){
        forward($page_owner->getURL());
    } 
}  

elgg_register_title_button();

$filter_context = get_input('entity_owner_filter', 'all');

elgg_pop_breadcrumb();

$title = elgg_echo("gdrive:plugin:page_owner:list");

if ($filter_context == 'all') {
	elgg_push_breadcrumb(elgg_echo('gdrive'));
} else {
	elgg_push_breadcrumb(elgg_echo('gdrive'), 'gdrive/all');
}

switch($filter_context) {
	case 'mine':
		if ($page_owner instanceof ElggGroup) {
			$title = elgg_echo("gdrive");
		}
		else {
			$title = elgg_echo("gdrive:plugin:listing:mine", array('title' => $page_owner->name));
		}
		elgg_push_breadcrumb($page_owner->name);
	break;
	case 'friends':
		$title = elgg_echo("gdrive:plugin:listing:friends");
		elgg_push_breadcrumb($page_owner->name, "gdrive/owner/$page_owner->username");
		elgg_push_breadcrumb(elgg_echo('friends'));
	break;
}

if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}


$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$gdrive_handler = new GDriveHandler();
$dbprefix = elgg_get_config('dbprefix');

$options = array(
	 'offset' => $offset,
	 'limit' => $limit,
    'joins' => array(),
    'wheres' => array(),
);

$gdrive_permission_id_id = (int)get_metastring_id(GDRIVE_PERMISSION_ID);
$gdrive_uploaded_by_user_id = (int)get_metastring_id(GDRIVE_UPLOADED_BY_USER);

$wheres = "((e.owner_guid = ".$user_logged_in_guid.")";
if (!empty($gdrive_permission_id_id) || !empty($gdrive_uploaded_by_user_id)) {
    $options['joins'][] = "LEFT JOIN {$dbprefix}annotations ea ON ea.entity_guid = e.guid";
}

if (!empty($gdrive_permission_id_id)) {
    $wheres .= "OR (ea.owner_guid = ".$user_logged_in_guid." AND ea.name_id = '".$gdrive_permission_id_id."')";
}
if (!empty($gdrive_uploaded_by_user_id)) {
    $wheres .= "OR (ea.name_id = '".$gdrive_uploaded_by_user_id."')";
}
    
$wheres .= ")";
$options['wheres'][] = $wheres;

$entities_list = $gdrive_handler->list_filter_entities($options);

$body = '';



//Main Title section
/****** ADD SEARCH SUPPORT LINKS *****
$add_link = elgg_view('output/url', array('href' => $CONFIG->url . 'gdrive/add/', 'text' => elgg_echo('gdrive:listing:link:add')));
$search_link_text = elgg_echo('gdrive:listing:link:search');
$search_support = GDriveBaseMain::ktform_get_filter('gdrive');
$body .= elgg_view('gdrive/listing/main_title', array('title' => $title, 'add_link' => $add_link, 'search_link_text' => $search_link_text,'search_support' => $search_support));
 * 
 */

$search_support = GDriveBaseMain::ktform_get_filter('gdrive');
$sidebar = elgg_view('gdrive/listing/sidebar_searchform', array('search_support' => $search_support));

//If no entities, do not show the listing titles.
if ($entities_list) {
	$body .= elgg_view('gdrive/listing/sortable_filter', array('object_subtype' => $object_subtype));
	//Titles section
//	$body .= elgg_view('gdrive/listing/titles', array('object_subtype' => $object_subtype));
}
//Entities
//Remember always it is needed.

$body .= elgg_view('gdrive/listing/wrapper', array('entities' => $entities_list, 'entity_subtype' => $object_subtype));

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