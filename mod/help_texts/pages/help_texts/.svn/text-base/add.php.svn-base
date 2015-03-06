<?php
/**
 * Add help_text page
 *
 * @package Help texts
 */

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('help_texts:add');
elgg_push_breadcrumb($title);

$vars = help_texts_prepare_form_vars();
$content = elgg_view_form('help_texts/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter_context' => NULL,
	'content' => $content,
	'title' => $title,
    'filter_override' => ''
));

elgg_load_css('select2');
elgg_load_js('select2');

echo elgg_view_page($title, $body);