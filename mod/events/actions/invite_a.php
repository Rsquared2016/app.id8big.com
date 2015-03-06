<?php

/*
 * Event invite
 */

// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get logged in user
$user_logged_in = elgg_get_logged_in_user_entity();

// Get entity
$guid = get_input('guid');
$entity = get_entity($guid);
if (!elgg_instanceof($entity, '', '', 'Events')) {
	forward();
}

// Get users
$user_destination = get_input('user_destination', false);
if (!empty($user_destination) && is_array($user_destination)) {
	$user_destination = array_unique($user_destination);
}

// Cache to the session to make form sticky
$_SESSION['sent_to'] = $user_destination;

if (empty($user_destination)) {
	register_error(elgg_echo("events:invite:error:users:empty"));
	forward(REFERER);
}


// Send messages to users
$error = array();
$success = array();
foreach($user_destination as $user_guid) {
	$user = get_entity($user_guid);
	if (elgg_instanceof($user, 'user')) {
		
		$result = $entity->addGuest($user_guid);

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

// Save 'send' the message
if (empty($success)) {
	register_error(elgg_echo("events:invite:error"));
	forward(REFERER);
}
else {
	$message_success = elgg_echo('events:invite:success');
	if (!empty($error)) {
		$message_success = elgg_echo('events:invite:error:users');
	}
}

// successful so uncache form values
unset($_SESSION['sent_to']);

// Success message
system_message($message_success);

// Forward to event
forward($entity->getURL());