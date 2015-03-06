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

// Get the Elgg engine
//require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
//Force context.
elgg_set_context('events');
elgg_push_breadcrumb(elgg_echo('events'), 'events/all');

global $CONFIG;
$guid = get_input('guid');

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}
//@KEETUP_MOD: This was modified by keetup to not allow access to group 
if ($page_owner instanceof ProjectGroup && is_callable('project_gatekeeper')) {
//	if (FALSE == $page_owner->canWriteToContainer()){
    $project_gatekeeper = project_gatekeeper(FALSE);
	if (!$project_gatekeeper){
		forward($page_owner->getURL());
	} 
}
$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "events/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "events/owner/$page_owner->username");
}

$entity = get_entity($guid);
if (!($entity instanceof Events)) {
	forward();
}


$title = $entity->title;

if (!$title) {
	$title = get_class($entity);
}

$has_title_method = is_callable(array($entity, 'getTitle'));
if ($has_title_method) {
	$title = $entity->getTitle();
}

elgg_push_breadcrumb($title);

$body = '';

//Main Title section
//$add_link = elgg_view('output/url', array('href' => $CONFIG->url . 'events/add/', 'text' => elgg_echo('events:listing:link:add')));

//$body .= elgg_view('ktnews/listing/main_title', array('title' => $title, 'add_link' => $add_link, 'disble_search' => TRUE));

$body .= elgg_view_entity($entity, array(
	 'full_view' => TRUE,
));

//$vars = array(
//	 'area2' => $body,
//);

//$body = elgg_view_layout("two_column_left_sidebar", $vars);

$body = elgg_view_layout('content', array(
	 'content' => $body,
	 'title' => $title,
	 'filter' => '',
));

echo elgg_view_page($title, $body);