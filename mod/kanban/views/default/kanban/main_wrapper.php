<?php

/*
 * Repository Viewer: Page index
 */

//Load CSS AND JS
elgg_load_css('elgg.kanban');
elgg_load_js('elgg.kanban');

$page_owner = elgg_extract('page_owner', $vars, elgg_get_page_owner_entity());

if (!($page_owner instanceof ProjectGroup) && !($page_owner instanceof ElggUser)) {
	return;
}

$has_kanban = FALSE;
if ($page_owner instanceof ProjectGroup) {
    $has_kanban = $page_owner->hasKanban();
    $vars['edit_mode'] = $page_owner->canWriteToContainer();
}
elseif ($page_owner instanceof ElggUser) {
    $has_kanban = TRUE;
}

if ($has_kanban) {
	echo elgg_view('kanban/group_board', $vars);
} else {
	echo elgg_view('page/elements/empty_section', $vars);
}