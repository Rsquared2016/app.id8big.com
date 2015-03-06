<?php

$group = elgg_get_page_owner_entity();
if (!($group instanceof ProjectGroup)) {
	register_error(elgg_echo('compass:page:group_board:not_access'));
	forward(REFERER);
}

// Gatekeeper
//project_gatekeeper();
//@KEETUP_MOD: This was modified by keetup to not allow access to group 
//if ($group instanceof ProjectGroup) {
//	if (FALSE == $group->canWriteToContainer()){
//		forward($group->getURL());
//	} 
//}

// Is visitor?
//$is_visitor = $group->isVisitor();
//if ($is_visitor) {
//	forward($group->getURL());
//}

$project_gatekeeper = false;
if (is_callable('project_gatekeeper')) {
    $project_gatekeeper = project_gatekeeper(FALSE);
}
if (empty($project_gatekeeper)) {
    forward($group->getURL());
}

//Load CSS AND JS
elgg_load_css('elgg.compass');
elgg_load_js('elgg.compass');
elgg_load_js('elgg.highlight');

//This is correct ?
elgg_load_js('tinymce');
elgg_load_js('elgg.tinymce');

//elgg_register_title_button("gtask");

// Get title
$title = elgg_echo('compass:page:group_board:title');

// Get header
$content = elgg_view('page/layouts/content/header', array('title' => $title));

$vars = array(
	'page_owner' => $group,
);
// Get content
$content .= elgg_view('compass/main_wrapper', $vars);

$body = elgg_view_layout('one_column', array(
	'title' => '',
	'content' => $content,
	'filter_override' => '',
));

echo elgg_view_page($title, $body);