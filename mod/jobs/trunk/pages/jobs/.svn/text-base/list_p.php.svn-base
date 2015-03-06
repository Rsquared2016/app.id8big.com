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
$object_subtype = 'job';

$can_post = JobsSettings::userCanPostJob(elgg_get_logged_in_user_entity());
if ($can_post) {
    elgg_register_title_button();
}

$filter_month = get_input('added', 'last_30_days');
set_input('added', $filter_month);

$filter_context = get_input('entity_owner_filter', 'all');

elgg_pop_breadcrumb();

$title = elgg_echo("jobs:plugin:page_owner:list");

elgg_push_breadcrumb(elgg_echo('jobs'), 'jobs/last');
//if ($filter_context == 'all') {
//	elgg_push_breadcrumb(elgg_echo('jobs:plugin:page_owner:list:mini'), 'jobs/last');
//}

switch ($filter_context) {
    case 'mine':

	$title = elgg_echo("jobs:plugin:listing:mine", array('title' => $page_owner->name));
	//Esta bien esto ?
	elgg_push_breadcrumb($page_owner->name);
	break;
    case 'applies':
	if ($page_owner->canEdit() == FALSE) {
	    forward(REFERER);
	}
	$title = elgg_echo("jobs:plugin:listing:applied", array('title' => $page_owner->name));
	//Esta bien esto ?
	elgg_push_breadcrumb(elgg_echo('jobs:plugin:breadcrumb:applies', array('title' => $page_owner->name)));
	break;
    case 'friends':
	$title = elgg_echo("jobs:plugin:listing:friends");
	elgg_push_breadcrumb($page_owner->name, "jobs/owner/$page_owner->username");
	elgg_push_breadcrumb(elgg_echo('friends'));
	break;
    case 'all':
	$title = elgg_echo("jobs:plugin:page_owner:list");
	elgg_push_breadcrumb(elgg_echo('jobs:plugin:page_owner:list:mini'), 'jobs/last');
	break;
    default:
	$title = elgg_echo("jobs:plugin:listing:last");
//        elgg_push_breadcrumb($title, "jobs/last/");
	break;
}

if ($page_owner === false || is_null($page_owner)) {
    elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}


$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$jobs_handler = new KtJobHandler();

$options = array(
    'offset' => $offset,
    'limit' => $limit,
    'filters' => array(),
);

$job_category = get_input('job_category', '');
if ($job_category) {
    $options['filters']['job_category'] = $job_category;
}

$job_region = get_input('job_region', '');
if ($job_region) {
    $options['filters']['job_region'] = $job_region;
}

$added = sanitise_string(get_input('added', ''));
if ($added) {
    $options['added'] = $added;
}

if ($filter_context == 'applies') {
    $options['relationship'] = SUBMIT_JOB_RELATIONSHIP;
    $options['inverse_relationship'] = TRUE;
    $options['relationship_guid'] = $page_owner->getGUID();
}

$entities_list = $jobs_handler->list_filter_entities($options);

$body = '';



//Main Title section
/* * **** ADD SEARCH SUPPORT LINKS *****
  $add_link = elgg_view('output/url', array('href' => $CONFIG->url . 'jobs/add/', 'text' => elgg_echo('jobs:listing:link:add')));
  $search_link_text = elgg_echo('jobs:listing:link:search');
  $search_support = KtJobBaseMain::ktform_get_filter('jobs');
  $body .= elgg_view('jobs/listing/main_title', array('title' => $title, 'add_link' => $add_link, 'search_link_text' => $search_link_text,'search_support' => $search_support));
 * 
 */

$search_support = KtJobBaseMain::ktform_get_filter('jobs');
$sidebar = elgg_view('jobs/listing/sidebar_searchform', array('search_support' => $search_support));

//If no entities, do not show the listing titles.
if ($entities_list) {
    $body .= elgg_view('jobs/listing/sortable_filter', array('object_subtype' => $object_subtype));
    //Titles section
//	$body .= elgg_view('jobs/listing/titles', array('object_subtype' => $object_subtype));
}
//Entities
//Remember always it is needed.

$body .= elgg_view('jobs/listing/wrapper', array('entities' => $entities_list, 'entity_subtype' => $object_subtype));

$vars = array(
    'filter_context' => $filter_context,
    'content' => $body,
    'title' => $title,
    'sidebar' => $sidebar,
    'filter_override' => elgg_view('jobs/listing/nav', array('selected' => $filter_context)),
);

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);
