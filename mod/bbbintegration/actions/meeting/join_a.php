<?php

/**
 * BigBlueButton
 */

// Get meeting
$guid = get_input('guid');
$meeting = get_entity($guid);

// Get user logged in
$user_logged_in = elgg_get_logged_in_user_entity();

if (!elgg_instanceof($meeting, 'object', 'meeting') || !elgg_instanceof($user_logged_in, 'user')) {
    echo elgg_echo('meeting:error:join');
    exit;
}

// Get meeting id
$meeting_id = $meeting->getGUID();

// Get bbb
$bbb = new BigBlueButton();

// Check if meeting is running
$is_running = $bbb->meetingIsRunning($meeting_id);
if ($is_running) {
    // Join to meeting
    $success = $meeting->addParticipant();    
    if ($success) {
        $role = BigBlueButton::ROLE_VIEWER;
        $password = BBBINTEGRATION_ATTENDEE_PASSWORD;
        if ($user_logged_in->getGUID() == $meeting->getOwnerGUID()) {
            $role = BigBlueButton::ROLE_MODERATOR;
            $password = BBBINTEGRATION_MODERATOR_PASSWORD;
        }
        $join_url = $bbb->getJoinMeetingUrl(
            $meeting_id,
            $user_logged_in->name,
            $user_logged_in->getGUID(),
            $role,
            array(
                'password' => $password,
            )
        );
        forward($join_url);
    }
    else {
        echo elgg_echo('meeting:error:join');
        exit;
    }
}

// Create meeting
$name = $meeting->title;
$participants = $meeting->participants;
if (empty($participants)) {
    $participants = -1;
}
$duration = $meeting->duration;
$params = array(
    'meetingID' => $meeting_id, 
    'attendeePW' => BBBINTEGRATION_ATTENDEE_PASSWORD,
    'moderatorPW' => BBBINTEGRATION_MODERATOR_PASSWORD,
    'duration' => $duration,
    'maxParticipants' => $participants,
);

$response = $bbb->createMeeting($name, $params);

if ($response['returncode'] == BigBlueButton::API_QUERY_SUCCESS) {
    // Join to meeting
    $success = $meeting->addParticipant();
    if ($success) {
        $role = BigBlueButton::ROLE_VIEWER;
        $password = BBBINTEGRATION_ATTENDEE_PASSWORD;
        if ($user_logged_in->getGUID() == $meeting->getOwnerGUID()) {
            $role = BigBlueButton::ROLE_MODERATOR;
            $password = BBBINTEGRATION_MODERATOR_PASSWORD;
        }
        $join_url = $bbb->getJoinMeetingUrl(
            $response['meetingID'],
            $user_logged_in->name,
            $user_logged_in->getGUID(),
            $role,
            array(
                'password' => $password,
            )
        );
        forward($join_url);
    }
    else {
        echo elgg_echo('meeting:error:join');
        exit;
    }
}
else {
    echo elgg_echo('meeting:error:join');
    exit;
}