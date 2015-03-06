<?php

/**
 * Gdrive Import
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
$title = elgg_echo('gdrive:google:import');

// Content
$content = elgg_view('gdrive/import/wrapper');

$body = elgg_view_layout('content', array(
    'title' => $title,
    'filter_override' => '',
	'content' => $content,
));

echo elgg_view_page($title, $body);