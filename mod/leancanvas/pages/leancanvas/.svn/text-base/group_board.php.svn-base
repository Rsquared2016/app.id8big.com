<?php

/**
 * Lean Canvas
 */

// Load js
elgg_load_js('block_ui');
elgg_load_js('socket.io');
elgg_load_js('leancanvas.client');

$group = elgg_get_page_owner_entity();
if (!($group instanceof ProjectGroup)) {
	register_error(elgg_echo('leancanvas:page:group_board:not_access'));
	forward(REFERER);
}

// Gatekeeper
//@KEETUP_MOD: This was modified by keetup to not allow access to group 
if ($group instanceof ProjectGroup) {
    $project_gatekeeper = false;
    if (is_callable('project_gatekeeper')) {
        $project_gatekeeper = project_gatekeeper(FALSE);
    }
//	if (FALSE == $group->canWriteToContainer()){
	if (empty($project_gatekeeper)){
		forward($group->getURL());
	} 
}
//Load CSS AND JS
elgg_load_css('elgg.leancanvas');
elgg_load_js('elgg.leancanvas');


// Get title
$title = elgg_echo('leancanvas:page:group_board:title');

$vars = array(
	'page_owner' => $group,
);
// Get content
$content = elgg_view('leancanvas/main_wrapper', $vars);

$body = elgg_view_layout('one_column', array(
	'title' => $title,
	'content' => $content,
	'filter_override' => '',
));

echo elgg_view_page($title, $body);