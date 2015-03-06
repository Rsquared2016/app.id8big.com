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

// KTODO: verificar si son amigos si corresopnde

// Get bbb
$bbb = new BigBlueButton();

// Chequeo si el usuario logueado tiene una solicitud de conversacion del otro
// usuario. Si es asi, el usuario logueado se une a la conversacion en base a
// meeting_id guardada en la anotacion. Si no, el usuario logueado crea una reunion
// y el id de esta se guarda en una anotacion creada sobre el otro usuario.
$options = array(
    'guid' => $user_logged_in->getGUID(),
    'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
    'annotation_owner_guids' => $user->getGUID(),
	'annotation_values' => MEETING_REQUEST_TALK_STATUS_REQUEST,
);
$annotations = elgg_get_annotations($options);
if ($annotations) {
    $annotation = current($annotations);
    
    // Delete annotations
//    $options = array(
//        'guid' => $user_logged_in->getGUID(),
//        'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
//        'annotation_owner_guids' => $user->getGUID(),
//    );
//    elgg_delete_annotations($options);
	
	// Create meeting to talk
	$name = elgg_echo('meeting:talk:meeting:name', array($user_logged_in->name, $user->name));
	$params = array(
		'attendeePW' => BBBINTEGRATION_ATTENDEE_PASSWORD,
		'moderatorPW' => BBBINTEGRATION_MODERATOR_PASSWORD,
		'maxParticipants' => 2,
	);
	$response = $bbb->createMeeting($name, $params);
	
	if ($response['returncode'] == BigBlueButton::API_QUERY_SUCCESS) {
		// Create annotation
//		$options = array(
//			'guid' => $user->getGUID(),
//			'annotation_names' => MEETING_TALK_ANNOTATION,
//			'annotation_owner_guids' => $user_logged_in->getGUID(),
//		);
//		$annotations = elgg_get_annotations($options);
//		if ($annotations) {
//			$annotation = current($annotations);
//			update_annotation($annotation->id,
//							  MEETING_TALK_ANNOTATION,
//							  $response['meetingID'],
//							  '',
//							  $user_logged_in->getGUID(),
//							  ACCESS_LOGGED_IN);
//		}
//		else {
//			create_annotation($user->getGUID(),
//							  MEETING_TALK_ANNOTATION,
//							  $response['meetingID'],
//							  '',
//							  $user_logged_in->getGUID(),
//							  ACCESS_LOGGED_IN);
//		}
		update_annotation($annotation->id,
			MEETING_REQUEST_TALK_ANNOTATION,
			$response['meetingID'],
			'',
			$user->getGUID(),
			ACCESS_LOGGED_IN
		);
		
		// Join to meeting
		$join_url = $bbb->getJoinMeetingUrl(
			$response['meetingID'],
			$user_logged_in->name,
			$user_logged_in->getGUID(),
			BigBlueButton::ROLE_MODERATOR,
			array(
				'password' => BBBINTEGRATION_MODERATOR_PASSWORD,
			)
		);
		forward($join_url);
	}
	else {
		echo elgg_echo('meeting:talk:error');
		exit;
	}
}
else {
	// Check for accept talk
	$dbprefix = elgg_get_config('dbprefix');
	$options = array(
		'guid' => $user->getGUID(),
		'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
		'annotation_owner_guids' => $user_logged_in->getGUID(),
		'joins' => array(
			"JOIN {$dbprefix}metastrings msv on n_table.value_id = msv.id"
		),
		'wheres' => array(
			"(msv.string NOT IN ('".MEETING_REQUEST_TALK_STATUS_REQUEST."', '".MEETING_REQUEST_TALK_STATUS_DECLINE."', '".MEETING_REQUEST_TALK_STATUS_COMPLETE."'))",
		),
	);
	$annotations = elgg_get_annotations($options);
	
	if ($annotations) {
		$annotation = current($annotations);
		
		// Delete annotations
//		$options = array(
//			'guid' => $user->getGUID(),
//			'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
//			'annotation_owner_guids' => $user_logged_in->getGUID(),
//		);
//		elgg_delete_annotations($options);
		update_annotation($annotation->id,
			MEETING_REQUEST_TALK_ANNOTATION,
			MEETING_REQUEST_TALK_STATUS_COMPLETE,
			'',
			$user_logged_in->getGUID(),
			ACCESS_LOGGED_IN
		);
		
		// Get meeting id
		$meeting_id = $annotation->value;
		
		// Check if meeting is running
		$is_running = $bbb->meetingIsRunning($meeting_id);
		if ($is_running) {
			// Join to meeting
			$join_url = $bbb->getJoinMeetingUrl(
				$meeting_id,
				$user_logged_in->name,
				$user_logged_in->getGUID(),
				BigBlueButton::ROLE_VIEWER,
				array(
					'password' => BBBINTEGRATION_ATTENDEE_PASSWORD,
				)
			);
			forward($join_url);
		}
		else {
			// 'request_talk' is used to indicate that it is accepting a request
			// for talk
			echo elgg_echo('meeting:talk:leave', array($user->name));
			exit;
		}
	}
}