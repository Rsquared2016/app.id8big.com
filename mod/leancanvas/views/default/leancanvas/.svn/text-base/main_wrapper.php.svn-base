<?php

/*
 * Repository Viewer: Page index
 */

//Load CSS AND JS
elgg_load_css('elgg.leancanvas');
elgg_load_js('elgg.leancanvas');

$page_owner = elgg_extract('page_owner', $vars, elgg_get_page_owner_entity());

if (!($page_owner instanceof ProjectGroup)) {
	return;
}

$has_lean_canvas = $page_owner->hasLeanCanvas();
$vars['edit_mode'] = $page_owner->canWriteToContainer();

if ($has_lean_canvas) {
	echo elgg_view('leancanvas/group_board', $vars);
} else {
	echo elgg_view('page/elements/empty_section', $vars);
}