<?php

/**
 * BigBlueButton Integration
 */

//if (!elgg_is_xhr()) {
//    forward();
//}

if (!elgg_is_logged_in()) {
    echo '';
    exit;
}

// Get logged in user
$user_logged_in = elgg_get_logged_in_user_entity();
if (!$user_logged_in) {
    echo '';
    exit;
}

$return = array();

// Check for talks => request
//$time = time() - 600;
$options = array(
    'guid' => $user_logged_in->getGUID(),
    'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
//    'annotation_created_time_upper' => $time,
	'annotation_values' => MEETING_REQUEST_TALK_STATUS_REQUEST,
);
$annotations = elgg_get_annotations($options);

if ($annotations) {
    $annotation = current($annotations);
    
    // Get user
    $user_guid = $annotation->owner_guid;
    
	$return['request_talk'] = elgg_view('meeting/request_talk/wrapper', array(
		'user_guid' => $user_guid,
	));
}

// Check for talk accepted
$dbprefix = elgg_get_config('dbprefix');
$options = array(
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
	
	// Get meeting id
    $meeting_id = $annotation->value;
    
    // Get user
    $user_guid = $annotation->entity_guid;
	
	// Check if meeting is running
    $bbb = new BigBlueButton();
    $is_running = $bbb->meetingIsRunning($meeting_id);
    if ($is_running) {
        $return['accept_talk'] = elgg_view('meeting/accept_talk/wrapper', array(
            'meeting_id' => $meeting_id,
            'user_guid' => $user_guid,
        ));
    }
    else {
        // Delete annotations
        $time = time() - $annotation->time_created;
        // If the user does not respond after five minutes, the application is removed
        if ($time > 600) {
            $options = array(
                'guid' => $user_guid,
                'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
                'annotation_owner_guids' => $user_logged_in->getGUID(),
            );
            elgg_delete_annotations($options);
        }
    }
	
}

// Check for talks => decline
$options = array(
    'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
	'annotation_owner_guids' => $user_logged_in->getGUID(),
	'annotation_values' => MEETING_REQUEST_TALK_STATUS_DECLINE,
);
$annotations = elgg_get_annotations($options);
if ($annotations) {
    $annotation = current($annotations);
    
    // Get user
    $user_guid = $annotation->entity_guid;
    
	$return['decline_talk'] = elgg_view('meeting/decline_talk/wrapper', array(
		'user_guid' => $user_guid,
	));
}

//Checking users online
// Load library
//elgg_load_library('elgg:meeting');
//
//$limit = 5;
//$options = array(
//    'limit' => $limit,
//    'count' => TRUE,
//);
//$count = meeting_get_online_users($options);
//$options['count'] = FALSE;
//$users = meeting_get_online_users($options);
//
//// Push context 'meeting_widgets_user_online' and 'widgets'
//elgg_push_context('meeting_widgets_user_online');
//elgg_push_context('widgets');
//
//$body = elgg_view_entity_list($users, array(
//    'size' => 'small',
//    'count' => $count,
//    'limit' => $limit,
//    'pagination' => false,
//));
//if (empty($body)) {
//    $body = '<p>'.elgg_echo('meeting:widgets:online:users:empty').'</p>';
//}
//
//elgg_pop_context();
//elgg_pop_context();
//
//$return['online_users'] = $body;

echo json_encode($return);

exit;