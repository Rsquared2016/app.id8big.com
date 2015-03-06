<?php

$group = elgg_get_page_owner_entity();
if (!($group instanceof ProjectGroup)) {
//	register_error(elgg_echo('repositoryviewer:page:view:not_access'));
	forward(REFERER);
}

// Gatekeeper
if (is_callable('project_gatekeepeer')) {
	project_gatekeeper();
}

// Get title
$title = elgg_echo('repositoryviewer:tabs:repositoryviewer');

// Get content
$vars = array(
	'entity' => $group,
);
$content = elgg_view('repositoryviewer/group_module', $vars);

$body = elgg_view_layout('one_column', array(
	'title' => $title,
	'content' => $content,
	'filter_override' => '',
));

echo elgg_view_page($title, $body);