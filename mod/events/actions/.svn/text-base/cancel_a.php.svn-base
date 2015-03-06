<?php

/**
 * Elgg blog: edit post action
 * 
 * @package ElggBlog
 */
// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get input data
$guid = (int) get_input('guid');

$event = get_entity($guid);


if (!($event instanceof Events)) {
	throw new Exception(elgg_echo('events:no_event'));
}

if (!$event->canEdit()) {
	throw new Exception(elgg_echo('events:no_permission'));
}


try {
	$event->state = EVENT_STATE_CLOSED;
	
	//Notify the invited user 
	$event->notifyEventClosed();
	
	
	system_message(elgg_echo('events:canceled'));
} catch (Exception $exc) {
	register_error($exc->getMessage());
}

forward(REFERER);