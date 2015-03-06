<?php

/*
 * Event attend
 */

// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get logged in user
$user_logged_in = elgg_get_logged_in_user_entity();

// Get entity
$entity_guid = get_input('entity_guid');
$entity = get_entity($entity_guid);
if (!elgg_instanceof($entity, '', '', 'Events')) {
	forward();
}

// Get attend
$attend = get_input('attend', '');

// Attend
$success = $entity->attend($attend);

if ($success) {
	system_message(elgg_echo('events:guests:attend:success'));
}
else {
	register_error(elgg_echo('events:guests:attend:error'));
}

forward($entity->getURL());