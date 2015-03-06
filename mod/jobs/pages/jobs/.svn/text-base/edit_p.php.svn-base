<?php

/**
 * Add bookmark page
 *
 * @package ElggBookmarks
 */
$entity_guid = get_input('guid');

$entity = get_entity($entity_guid);
$form = new KtJobForm();


$can_post = JobsSettings::userCanPostJob(elgg_get_logged_in_user_entity());
if(!$can_post) {
	register_error(elgg_echo('jobs:add:not:allowed'));
	forward('jobs/last');
}

if (elgg_instanceof($entity, 'object', 'job')) {
	if (!$entity->canEdit()) {
		register_error(elgg_echo('jobs:unknow_job'));
		forward(REFERRER);
	}

	$title = elgg_echo('jobs:edit:title', array('title' => $entity->title));

	$form->setObject($entity);
} else {

	$title = elgg_echo('jobs:add:title');
}

elgg_push_breadcrumb(elgg_echo('jobs'), 'jobs/last');
elgg_push_breadcrumb($title);


$content = elgg_view("jobs/forms/edit", array('entity' => $entity, 'form' => $form));

$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));

echo elgg_view_page($title, $body);