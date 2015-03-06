<?php

/**
 * Comments
 */

$is_xhr = elgg_is_xhr();
if (!$is_xhr) {
	forward(REFERER);
}

elgg_set_context('leancanvas');

$group = elgg_get_page_owner_entity();
if (!($group instanceof ProjectGroup)) {
	echo '';
	exit;
}

// Gatekeeper
$project_gatekeeper = project_gatekeeper(false);
if (!$project_gatekeeper) {
	echo '';
	exit;
}

// Lean canvas
$lean_canvas = new leanCanvas($group);

// Get section
$section_id = get_input('section_id');
$section = $lean_canvas->getSection($section_id);
if (empty($section)) {
	echo '';
	exit;
}

// Get comments
$comments = $lean_canvas->renderCommentsForSection($section_id);

// Get content
$vars = array(
	'page_owner' => $group,
	'section_id' => $section_id,
	'comments' => $comments,
);
$content = elgg_view('leancanvas/comments', $vars);

echo $content;

exit;