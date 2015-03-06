<?php

/**
 * Events: Invite
 */

gatekeeper();

// Get the current page's owner
// Get the post, if it exists
$entity_guid = (int) get_input('guid', 0);

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}

if ($page_owner instanceof ElggGroup) {
	$container = $page_owner->guid;
}
//Chequear si puedo escribir en el container.
if($page_owner instanceof ElggGroup && !$page_owner->canWriteToContainer()) {
    register_error(elgg_echo('events:profile:cant:write:page_owner'));
    forward();
}

// Get entity
$entity = get_entity($entity_guid);
if (!elgg_instanceof($entity, '', '', 'Events')) {
	forward();
}
if (!$entity->canEdit()) {
	forward();
}

// Get title
$title = elgg_echo('events:form:invite:title', array($entity->title));

$area1 = elgg_view_title($title);

$area1 .= elgg_view("events/forms/invite", array('entity' => $entity));

$vars = array(
	 'area2' => $area1,
);

$body = elgg_view_layout("two_column_left_sidebar", $vars);
// Display page
echo elgg_view_page($title, $body);