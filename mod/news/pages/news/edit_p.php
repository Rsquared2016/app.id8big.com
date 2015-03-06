<?php

/**
 * Add news page
 *
 * @package News
 */

admin_gatekeeper();

$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new NewsForm();

if (elgg_instanceof($entity, 'object', 'new')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('news:unknow_new'));
		forward(REFERRER);
	}

	$title = elgg_echo('news:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('news:add:title');
}

elgg_push_breadcrumb(elgg_echo('news'), 'news/all');
elgg_push_breadcrumb($title);


$content = elgg_view("news/forms/edit", array('entity' => $entity, 'form' => $form));

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);