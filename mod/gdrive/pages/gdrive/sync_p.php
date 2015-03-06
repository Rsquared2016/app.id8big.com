<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$guid = get_input('guid');
$entity = get_entity($guid);

if (!($entity instanceof ProjectGroup)) {
	forward();
}
if (!$entity->canWriteToContainer()) {
	forward();
}

elgg_set_page_owner_guid($entity->getGUID());

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

elgg_push_breadcrumb(elgg_echo('gdrive'), 'gdrive/all');

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "gdrive/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "gdrive/owner/$page_owner->username");
}

$title = elgg_echo('gdrive:group:sync');

elgg_push_breadcrumb($title);

$body = elgg_view('gdrive/sync', array(
	'entity' => $entity,
));

$vars = array(
	 'filter_override' => '',
	 'content' => $body,
	 'title' => $title,
);

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);