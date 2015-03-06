<?php

/**
 * Add gtask page
 *
 * @package Gtask
 */

//Check ajax request
$is_xhr = elgg_is_xhr();

$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new GtaskForm();

$page_owner = page_owner_entity();

if ($page_owner instanceof ElggGroup) {
    if (!($page_owner->canWriteToContainer())) {
        register_error(elgg_echo('gtasks:error:access'));
        forward(REFERER);
    }
}

if (elgg_instanceof($entity, 'object', 'gtask')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('gtask:unknow_gtask'));
		forward(REFERRER);
	}

	$title = elgg_echo('gtask:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('gtask:add:title');
}

elgg_push_breadcrumb(elgg_echo('gtask'));
elgg_push_breadcrumb($title);


$content = elgg_view("gtask/forms/edit", array(
	'entity' => $entity,
	'form' => $form,
));
if($is_xhr){
	echo elgg_view('gtask/lightbox', array(
		'title' => $title,
		'content' => $content,
	));
	exit;
}

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);