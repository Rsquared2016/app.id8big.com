<?php
/**
 * Add help_text page
 *
 * @package ElggHelp texts
 */

$help_text_guid = get_input('guid');
$help_text = get_entity($help_text_guid);

if (!elgg_instanceof($help_text, 'object', 'help_texts') || !$help_text->canEdit()) {
	register_error(elgg_echo('help_texts:unknown_help_text'));
	forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('help_texts:edit');
elgg_push_breadcrumb($title);

$vars = help_texts_prepare_form_vars($help_text);
$content = elgg_view_form('help_texts/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

elgg_load_css('select2');
elgg_load_js('select2');

echo elgg_view_page($title, $body);