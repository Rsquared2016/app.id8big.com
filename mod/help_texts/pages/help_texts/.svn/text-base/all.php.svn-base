<?php
/**
 * Elgg help_texts plugin everyone page
 *
 * @package ElggHelp texts
 */

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('help_texts'));

//elgg_register_title_button();
elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'help_texts',
	'limit' => 10,
	'full_view' => false,
	'view_toggle_type' => false
));

if (!$content) {
	$content = elgg_echo('help_texts:none');
}

$title = elgg_echo('help_texts:everyone');

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
    'filter_override' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);