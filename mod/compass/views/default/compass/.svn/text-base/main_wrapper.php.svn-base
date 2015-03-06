<?php

/*
 * Repository Viewer: Page index
 */

//Load CSS AND JS
elgg_load_css('elgg.compass');
elgg_load_js('elgg.compass');

$page_owner = elgg_extract('page_owner', $vars, elgg_get_page_owner_entity());

if (!($page_owner instanceof ProjectGroup)) {
	return;
}

$has_compass = $page_owner->hasCompass();
$vars['edit_mode'] = $page_owner->canWriteToContainer();

if ($has_compass) {
	echo elgg_view('compass/group_board', $vars);
} else {
	echo elgg_view('page/elements/empty_section', $vars);
}