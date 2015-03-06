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
$guid = get_input('guid');

// disables owner block
set_input('replace_sidebar', 1);

//Set the group as current page's owner
$entity = get_entity($guid);
if(!$entity || ($entity && !($entity instanceof ElggGroup))) {
	register_error(elgg_echo('ktnews:group:invalid:entity'));
	forward();
}
elgg_set_page_owner_guid($guid);

//Force context.
elgg_set_context('news');


$title = $entity->name;

$view_all = true;

//$area1 = elgg_view('groups/left_col', array('entity' => $entity));
$area1 = elgg_view('ktnews_group/profile/left_col', array('entity' => $entity));

//Main Title section
$area2 = '';
$area2 .= elgg_view('ktnews_group/profile/main_title', array('title' => $title, 'entity' => $entity));

$area2 .= elgg_view_entity($entity, array(
	 'full_view' => TRUE,
));

// Hide some items from closed groups when the user is not logged in.
$groupaccess = group_gatekeeper(false);
if (!$groupaccess) {
	$view_all = false;
}

if ($view_all) {
	//group profile 'items' - these are not real widgets, just contents to display
	$area2 .= elgg_view('groups/profileitems',array('entity' => $entity));

	//group members
	$area3 = elgg_view('ktnews_group/members', array('entity' => $entity));
}
else {
	$area2 .= elgg_view('groups/closedmembership', array('entity' => $group, 'user' => $_SESSION['user'], 'full' => true));
}

$vars = array(
	 'area2' => $area2,
);

$body = elgg_view_layout("two_column_left_sidebar", $vars);

echo elgg_view_page($title, $body);