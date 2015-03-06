<?php

/*
 * Repository Viewer: Page index
 */

// Gatekeeper
gatekeeper();

// Get title
$title = elgg_echo('repositoryviewer:page:index:title');

// Get content
$content = elgg_view('repositoryviewer/view', $vars);

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'filter_override' => '',
));

echo elgg_view_page($title, $body);