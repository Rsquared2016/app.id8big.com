<?php

/**
 * Add exam page
 *
 * @package Exam
 */

// Get exam
$entity_guid = get_input('guid', 0);
$entity = get_entity($entity_guid);

$logged_in_user = elgg_get_logged_in_user_entity();
$container = $entity->getContainerEntity();
$member_type = $container->getMemberType($logged_in_user->getGUID());

$error = true;
if (elgg_instanceof($entity, 'object', 'meeting')) {
	$error = false;
}
if ($error) {
	register_error(elgg_echo('meeting:unknow_meeting'));
	forward(REFERRER);
}

if ( ($member_type != ProjectSettings::REL_COLLABORATOR) && ($container->getOwnerGUID() != $logged_in_user->getGUID()) ){
	register_error(elgg_echo('meeting:no_colaborator'));
	forward(REFERRER);
}

$title = elgg_echo('meeting:button:invite:visitors');

$content = elgg_view_form('meeting/invite_visitors');
$body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
));

echo elgg_view_page($title, $body);