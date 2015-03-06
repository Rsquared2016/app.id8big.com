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
$object_subtype = 'kt_poll';


elgg_register_title_button();

$filter_context = get_input('entity_owner_filter', 'all');

elgg_pop_breadcrumb();

$title = elgg_echo("kt_polls:plugin:page_owner:list");

if ($filter_context == 'all') {
	elgg_push_breadcrumb(elgg_echo('kt_polls'));
} else {
	elgg_push_breadcrumb(elgg_echo('kt_polls'), 'kt_polls/all');
}
	//@KEETUP_MOD: This was modified by keetup to not allow access to group 
if ($page_owner instanceof ProjectGroup && is_callable('project_gatekeeper')) {
//	if (FALSE == $page_owner->canWriteToContainer()){
    $project_gatekeeper = project_gatekeeper(false);
    if (!$project_gatekeeper){
		forward($page_owner->getURL());
	} 
}	

switch($filter_context) {
	case 'mine':
		if ($page_owner instanceof ProjectGroup) {
			$title = elgg_echo('kt_polls:list');
		}
		else {
			$title = elgg_echo("kt_polls:plugin:listing:mine", array('title' => $page_owner->name));
		}
		elgg_push_breadcrumb($page_owner->name);
	break;
	case 'friends':
		$title = elgg_echo("kt_polls:plugin:listing:friends");
		elgg_push_breadcrumb($page_owner->name, "kt_polls/owner/$page_owner->username");
		elgg_push_breadcrumb(elgg_echo('friends'));
	break;
}

if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}


$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$kt_polls_handler = new PollsHandler();

$options = array(
	 'offset' => $offset,
	 'limit' => $limit,
);


$options['metadata_name_value_pairs'][] = array('name' => 'poll_context', 'value' => 'poll_profile');

//$entities_list = $ktblog_handler->list_entities($options);

//set_input('entity_owner_filter', 'selected_poll_profile');
$selected_for_profile = get_input('entity_owner_filter', FALSE) ;
if ($selected_for_profile == 'selected_poll_profile' && get_loggedin_userid()) {
		$clauses = elgg_get_entity_relationship_where_sql('e', KTPOLL_USER_PROFILE_SETTED,
			get_loggedin_userid(), TRUE);
		
		$options['wheres'] = $clauses['wheres'];
		$options['joins'] = $clauses['joins'];	
}

$entities_list = $kt_polls_handler->list_filter_entities($options); 

$body = '';



//Main Title section
/****** ADD SEARCH SUPPORT LINKS *****
$add_link = elgg_view('output/url', array('href' => $CONFIG->url . 'kt_polls/add/', 'text' => elgg_echo('kt_polls:listing:link:add')));
$search_link_text = elgg_echo('kt_polls:listing:link:search');
$search_support = PollsBaseMain::ktform_get_filter('kt_polls');
$body .= elgg_view('kt_polls/listing/main_title', array('title' => $title, 'add_link' => $add_link, 'search_link_text' => $search_link_text,'search_support' => $search_support));
 * 
 */

$search_support = PollsBaseMain::ktform_get_filter('kt_polls');
$sidebar = elgg_view('kt_polls/listing/sidebar_searchform', array('search_support' => $search_support));

//If no entities, do not show the listing titles.
if ($entities_list) {
	$body .= elgg_view('kt_polls/listing/sortable_filter', array('object_subtype' => $object_subtype));
	//Titles section
//	$body .= elgg_view('kt_polls/listing/titles', array('object_subtype' => $object_subtype));
}
//Entities
//Remember always it is needed.

$body .= elgg_view('kt_polls/listing/wrapper', array('entities' => $entities_list, 'entity_subtype' => $object_subtype));

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