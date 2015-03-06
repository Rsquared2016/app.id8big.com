<?php

$user_guids = get_input('user_guids', false);

$meeting_guid = get_input('meeting_guid', false);

if (!$user_guids) {
    register_error(elgg_echo('meeting:invited_visitors:empty'));
	forward(REFERRER);
} else {
    $error = array();
	$success = array();
    
    $meeting = get_entity($meeting_guid);
    $invitor = elgg_get_logged_in_user_entity();
    $site_entity = elgg_get_site_entity();
	foreach($user_guids as $user_guid) {
		$user = get_user($user_guid);
        
		if ($user instanceof ElggUser) {
            $meeting->annotate('invited', $user_guid, ACCESS_LOGGED_IN);
            $subject = elgg_echo('meeting:invited_visitors:message:subject', array($invitor->name));
            $message = elgg_echo("meeting:invited_visitors:message:body", array($user->name, $invitor->name, $meeting->getURL()));
            $result = notify_user($user->getGUID(), $site_entity->getGUID(), $subject, $message);
			

			if ($result) {
				$success[] = $user_guid;
			}
			else {
				$error[] = $user_guid;
			}
		}
		else {
			$error[] = $user_guid;
		}
	}
	//=======================

	// Save 'send' the message
	if (empty($success)) {
		register_error(elgg_echo("meeting:invited_visitors:message:error"));
		forward(REFERER);
	}
	else {
        $message_success = elgg_echo('meeting:invited_visitors:message:success');
        system_message($message_success);
        forward($meeting->getURL());
	}
}
