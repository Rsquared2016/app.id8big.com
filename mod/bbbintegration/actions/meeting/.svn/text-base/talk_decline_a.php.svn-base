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
    register_error(elgg_echo('meeting:talk:decline:error'));
    forward();
}

// Delete annotations
$options = array(
    'guid' => $user_logged_in->getGUID(),
    'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
    'annotation_owner_guids' => $user->getGUID(),
	'annotation_values' => MEETING_REQUEST_TALK_STATUS_REQUEST,
);
$annotations = elgg_get_annotations($options);
if ($annotations) {
	$annotation = current($annotations);
	
	$success = update_annotation($annotation->id,
		MEETING_REQUEST_TALK_ANNOTATION,
		MEETING_REQUEST_TALK_STATUS_DECLINE,
		'',
		$user->getGUID(),
		ACCESS_LOGGED_IN
	);
}
//$success = elgg_delete_annotations($options);

if ($success) {
    system_message(elgg_echo('meeting:talk:decline:success'));
}
else {
    register_error(elgg_echo('meeting:talk:decline:error'));
}
forward();