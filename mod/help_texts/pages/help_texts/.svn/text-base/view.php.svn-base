<?php
/**
 * View a help_text
 *
 * @package Help Text
 */

$help_text = get_entity(get_input('guid'));
if (!$help_text) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "help_texts/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "help_texts/owner/$page_owner->username");
}

$title = $help_text->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($help_text, array('full_view' => true));
//$content .= elgg_view_comments($help_text);
$page_title = "<h2><div class='fs1 iconb' data-icon='&#xe{$help_text->descriptive_icon};'>&nbsp;</div>$help_text->title</h2>";
$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $page_title,
	'filter' => '',
));

echo elgg_view_page($title, $body);
