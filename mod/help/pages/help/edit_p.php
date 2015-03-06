<?php

/**
 * Add help page
 *
 * @package Help
 */
$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new HelpForm();

if (elgg_instanceof($entity, 'object', 'help')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('help:unknow_help'));
		forward(REFERRER);
	}

	$title = elgg_echo('help:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('help:add:title');
}

elgg_push_breadcrumb(elgg_echo('help'), 'help/all');
elgg_push_breadcrumb($title);


$content = elgg_view("help/forms/edit", array('entity' => $entity, 'form' => $form));

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);