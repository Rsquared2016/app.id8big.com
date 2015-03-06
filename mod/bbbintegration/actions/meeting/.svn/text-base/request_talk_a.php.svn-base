<?php

/*
 * BigBlueButton Integration
 */

// Get user to talk
$user_guid = get_input('user_guid', false);
$user = get_entity($user_guid);

// Get user logged in
$user_logged_in = elgg_get_logged_in_user_entity();

// Check for error
if (!elgg_instanceof($user, 'user') || !elgg_instanceof($user_logged_in, 'user')) {
	echo elgg_echo('meeting:talk:error');
	exit;
}

// Create annotation
$success = FALSE;
$options = array(
	'guid' => $user->getGUID(),
	'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
	'annotation_owner_guids' => $user_logged_in->getGUID(),
);
$annotations = elgg_get_annotations($options);
if ($annotations) {
	$annotation = current($annotations);
	$success = update_annotation($annotation->id, MEETING_REQUEST_TALK_ANNOTATION, MEETING_REQUEST_TALK_STATUS_REQUEST, '', $user_logged_in->getGUID(), ACCESS_LOGGED_IN);
} else {
	$success = create_annotation($user->getGUID(), MEETING_REQUEST_TALK_ANNOTATION, MEETING_REQUEST_TALK_STATUS_REQUEST, '', $user_logged_in->getGUID(), ACCESS_LOGGED_IN);
}

if ($success) {
	system_message(elgg_echo('meeting:request:talk:success'));
} else {
	register_error(elgg_echo('meeting:request:talk:error'));
}
forward(REFERER);