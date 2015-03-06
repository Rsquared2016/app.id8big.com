<?php

/**
 * GDrive Import From Google
 */

$guid = get_input('guid');
$page_owner = get_entity($guid);
if (!elgg_instanceof($page_owner, 'group', 'project')) {
    forward();
}
if (!$page_owner->canWriteToContainer()) {
    forward($page_owner->getURL());
}
elgg_set_page_owner_guid($guid);

// Title
$title = elgg_echo('gdrive:import:google');

// Content
$content = elgg_view_form('gdrive/importgoogle');

$body = elgg_view_layout('content', array(
    'title' => $title,
    'filter_override' => '',
	'content' => $content,
));

echo elgg_view_page($title, $body);