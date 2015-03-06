<?php

/**
 * Add events page
 *
 * @package Events
 */
$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new EventsForm();

//@KEETUP_MOD: This was modified by keetup to not allow access to group 
$page_owner = elgg_get_page_owner_entity();
if ($page_owner instanceof ProjectGroup) {
	if (FALSE == $page_owner->canWriteToContainer()){
		forward($page_owner->getURL());
	} 
}


if (elgg_instanceof($entity, 'object', 'event')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('events:unknow_event'));
		forward(REFERRER);
	}

	$title = elgg_echo('events:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('events:add:title');
}

elgg_push_breadcrumb(elgg_echo('events'), 'events/all');
elgg_push_breadcrumb($title);

$content = elgg_view("events/forms/edit", array('entity' => $entity, 'form' => $form));

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);