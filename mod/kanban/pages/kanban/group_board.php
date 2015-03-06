<?php

$page_owner = elgg_get_page_owner_entity();
if ($page_owner instanceof ProjectGroup) {
    // Gatekeeper
    project_gatekeeper();

    // Is visitor?
//    $is_visitor = $page_owner->isVisitor();
//    if ($is_visitor) {
//        forward($page_owner->getURL());
//    }
	//@KEETUP_MOD: This was modified by keetup to not allow access to group 
//	if ($page_owner instanceof ProjectGroup) {
//		if (FALSE == $page_owner->canWriteToContainer()){
//			forward($page_owner->getURL());
//		} 
//	}    
//	register_error(elgg_echo('kanban:page:group_board:not_access'));
//	forward(REFERER);
    
    // Get title
    $title = elgg_echo('kanban:page:group_board:title');
}
else{
    $error = TRUE;
    if ($page_owner instanceof ElggUser) {
        if ($page_owner->getGUID() == elgg_get_logged_in_user_guid()) {
            $error = FALSE;
        }
    }
    
    if ($error) {
        register_error(elgg_echo('kanban:page:group_board:not_access'));
        forward();
    }
    
    // Get title
    $title = elgg_echo('kanban:page:group_board:title:user');
}

//Load CSS AND JS
elgg_load_css('elgg.kanban');
elgg_load_js('elgg.kanban');
elgg_load_js('elgg.highlight');


elgg_register_title_button("gtask");

// Get header
$content = elgg_view('page/layouts/content/header', array('title' => $title));

$vars = array(
	'page_owner' => $page_owner,
);
// Get content
$content .= elgg_view('kanban/main_wrapper', $vars);

$body = elgg_view_layout('one_column', array(
	'title' => '',
	'content' => $content,
	'filter_override' => '',
));

echo elgg_view_page($title, $body);