<?php

/*
 * Events Access Lib
 */

// Define Constants
define('EVENTS_ACCESS_CUSTOM', TRUE); // Enable/Disable access custom
define('EVENTS_ACCESS_PUBLIC', 'event_access_public'); // Access Logged in
define('EVENTS_ACCESS_PRIVATE', 'event_access_private'); // Access by Collection
define('EVENTS_ACCESS_PRIVATE_NAME_PREFIX', 'Event: '); // Prefix of collection name

// Event handler
elgg_register_event_handler('init','system','events_access_init');

/**
 * Events Access Init 
 */
function events_access_init() {
	
	// Hooks
	if (EVENTS_ACCESS_CUSTOM) { // If access custom, register hook to filter access options
//		elgg_register_plugin_hook_handler('access:collections:write', 'all', 'events_access_write_acl_hook');
	}
	
	// Events
	elgg_register_event_handler('create', 'object', 'events_access_create_object_event');
	
}

/**
 * Events Access: Write ACL
 */
function events_access_write_acl_hook($hook, $entity_type, $returnvalue, $params) {
	
	// Checking...
	$check_hook = ($hook == 'access:collections:write');
	$check_entity_type = ($entity_type == 'user');
	
	// Get user
	$user_guid = $params['user_id'];
	$user = get_entity($user_guid);
	
	if ($user && $check_hook && $check_entity_type) {
		$context = elgg_get_context();
		
		if ($context == 'events') {
			// Set access custom options
			$returnvalue = events_access_get_access_custom_options();
		}
	}

	return $returnvalue;
	
}

/**
 * Events Access: Create Object Event
 */
function events_access_create_object_event($event, $object_type, $object) {
	
	$check_event = ($event == 'create');
	$check_object_type = ($object_type == 'object');
	$check_object = elgg_instanceof($object, '', '', 'Events');
	
	if ($check_event && $check_object_type && $check_object) {
		// Create access collection (ACCESS PRIVATE)
		$collection_name = EVENTS_ACCESS_PRIVATE_NAME_PREFIX . $object->title;
		$collection_owner = $object->getGUID();
		
		$collections = get_user_access_collections($collection_owner);
		if (empty($collections)) {
			$collection_id = create_access_collection($collection_name, $collection_owner);
		}
	}
	
}

/**
 * Events Access: Get access custom options
 */
function events_access_get_access_custom_options() {
	
	$access = array(
		// EVENTS_ACCESS_PUBLIC => ACCESS_LOGGED_IN
		EVENTS_ACCESS_PUBLIC => elgg_echo('events:access:'.EVENTS_ACCESS_PUBLIC),
		// EVENTS_ACCESS_PRIVATE = Access by Collection
		EVENTS_ACCESS_PRIVATE => elgg_echo('events:access:'.EVENTS_ACCESS_PRIVATE),
	);
	
	return $access;
	
}

/**
 * Events Access: Get access to event
 * 
 * Return access id for elgg according to the form
 */
function events_access_get_access_to_event(Events $event) {
	
	// Check event
	if (!elgg_instanceof($event, '', '', 'Events')) {
		return ACCESS_PRIVATE;
	}
	
	// Get input
	$access_id = get_input('access_id', EVENTS_ACCESS_PUBLIC);
	
	switch ($access_id) {
		case EVENTS_ACCESS_PRIVATE: // Access Private
			$access_id = events_access_get_access_private_event($event);
			break;
		default: // Access Public
			$access_id = events_access_get_access_public_event($event);
			break;
	}
	
	return $access_id;
	
}

/**
 * Events Access: Get access to form
 * 
 * Return access id to form according to the event
 */
function events_access_get_access_to_form(Events $event) {
	
	// Check event
	if (!elgg_instanceof($event, '', '', 'Events')) {
		return '';
	}
	
	// Get access id
	$access_id = $event->access_id;
	
	// Get access private/public according to elgg
	$access_private = events_access_get_access_private_event($event);
	$access_public = events_access_get_access_public_event($event);
	
	switch ($access_id) {
		case $access_private: // Access private
			$access_id = EVENTS_ACCESS_PRIVATE;
			break;
		default: // Access public
			$access_id = EVENTS_ACCESS_PUBLIC;
			break;
	}
	
	return $access_id;
	
}

/**
 * Events Access: Get access private event
 */
function events_access_get_access_private_event(Events $event) {
	
	// Access default
	$access_private = ACCESS_PRIVATE;
	
	// Check event
	if (!elgg_instanceof($event, '', '', 'Events')) {
		return $access_private;
	}
	
	// Get collection oner
	$collection_owner = $event->getGUID();
	
	// Get collections
	$collections = get_user_access_collections($collection_owner);
	if (!empty($collections) && is_array($collections)) {
		$collection = current($collections);
		$access_private = $collection->id;
	}
	
	return $access_private;
	
}

/**
 * Events Access: Get access public event
 */
function events_access_get_access_public_event(Events $event) {
	
	if (!elgg_instanceof($event, '', '', 'Events')) {
		return ACCESS_PRIVATE;
	}
	
	return ACCESS_LOGGED_IN;
	
}

/**
 * 
 */
function events_access_add_to_access_private(Events $event, $user_guid = 0) {
	
	// Check event
	if (!elgg_instanceof($event, '', '', 'Events')) {
		return false;
	}
	
	// Get user
	$user = get_entity($user_guid);
	if (!elgg_instanceof($user, 'user')) {
		return false;
	}
	
	// Get collection
	$collection_id = events_access_get_access_private_event($event);
	$collection = get_access_collection($collection_id);
	
	// Add user to access collection
	if (!empty($collection)) {
		$success = add_user_to_access_collection($user_guid, $collection_id);
		
		return $success;
	}
	
	return false;
	
}