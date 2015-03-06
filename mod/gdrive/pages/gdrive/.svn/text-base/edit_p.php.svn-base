<?php

/**
 * Add gdrive page
 *
 * @package GDrive
 */
$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new GDriveForm();

if (elgg_instanceof($entity, 'object', 'gdrive')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('gdrive:unknow_gdrive'));
		forward(REFERRER);
	}

	$title = elgg_echo('gdrive:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('gdrive:add:title');
    
    // Get page owner
    $page_owner = elgg_get_page_owner_entity();
    if (elgg_instanceof($page_owner, 'group', 'project') && !$page_owner->canWriteToContainer()) {
        forward();
    }
}

elgg_push_breadcrumb(elgg_echo('gdrive'), 'gdrive/all');
elgg_push_breadcrumb($title);


$content = elgg_view("gdrive/forms/edit", array('entity' => $entity, 'form' => $form));

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);