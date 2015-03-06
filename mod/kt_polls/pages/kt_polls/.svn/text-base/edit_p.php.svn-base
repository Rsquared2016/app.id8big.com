<?php

/**
 * Add kt_polls page
 *
 * @package Polls
 */
$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new PollsForm();

//@KEETUP_MOD: This was modified by keetup to not allow access to group 
$page_owner = elgg_get_page_owner_entity();
if ($page_owner instanceof ProjectGroup) {
	if (FALSE == $page_owner->canWriteToContainer()){
		forward($page_owner->getURL());
	} 
}

if (elgg_instanceof($entity, 'object', 'kt_poll')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('kt_polls:unknow_kt_poll'));
		forward(REFERRER);
	}

	$title = elgg_echo('kt_polls:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('kt_polls:add:title');
}

elgg_push_breadcrumb(elgg_echo('kt_polls'), 'kt_polls/all');
elgg_push_breadcrumb($title);


$content = elgg_view("kt_polls/forms/edit", array('entity' => $entity, 'form' => $form));

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);