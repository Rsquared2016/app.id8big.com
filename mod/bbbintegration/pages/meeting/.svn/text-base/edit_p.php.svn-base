<?php

/**
 * Add meeting page
 *
 * @package Meeting
 */

gatekeeper();

$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new MeetingForm();
$owner = elgg_get_page_owner_entity();
//@KEETUP_MOD: This was modified by keetup to not allow access to group 
if ($owner instanceof ProjectGroup) {
        if (FALSE == $owner->canWriteToContainer()){
                forward($owner->getURL());
        } 
} 
if (elgg_instanceof($entity, 'object', 'meeting')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('meeting:unknow_meeting'));
		forward(REFERRER);
	}

	$title = elgg_echo('meeting:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('meeting:add:title');
}

elgg_push_breadcrumb(elgg_echo('meeting'), 'meeting/all');
elgg_push_breadcrumb($title);


$content = elgg_view("meeting/forms/edit", array('entity' => $entity, 'form' => $form));

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);