<?php

/**
 * Search users
 */

global $CONFIG;

// Is XHR?
if (!elgg_is_xhr()) {
	forward();
}

// Result
$result = array();

// Get entity
$entity_guid = get_input('guid');
$entity = get_entity($entity_guid);

// Get term search
$q = stripslashes(get_input('term'));

//KTODO: Make configurable, what i want to search and return.
//Eg: search for city, state, or location field.
$display_no_result_message = FALSE;

//Validates logged in.
if(elgg_is_logged_in() && elgg_instanceof($entity, '', '', 'Events') && $q) {
	// Sanitase string
	$q = trim(sanitise_string($q));
	
	// Get access entity
	$access_id = $entity->access_id;
	
	// Get loggged in
	$user_logged_in = elgg_get_logged_in_user_entity();
	
	// Search
	switch ($access_id) {
		case ACCESS_PRIVATE:
			// Nothing
			break;
		case ACCESS_FRIENDS:
			// Friends
			$options = array(
				'relationship' => 'friend',
				'relationship_guid' => $user_logged_in->getGUID(),
				'types' => 'user',
				'limit' => 20,
				'joins' => array("JOIN {$CONFIG->dbprefix}users_entity ue on ue.guid = e.guid"),
				'wheres' => "(ue.name LIKE '%{$q}%' OR ue.username LIKE '%{$q}%')",
			);
			$users = elgg_get_entities_from_relationship($options);
			break;
		case ACCESS_LOGGED_IN: // Logged in and Public
		case ACCESS_PUBLIC:
		default:
			$options = array(
				'types' => 'user',
				'limit' => 20,
				'joins' => array("JOIN {$CONFIG->dbprefix}users_entity ue on ue.guid = e.guid"),
				'wheres' => "(ue.name LIKE '%{$q}%' OR ue.username LIKE '%{$q}%')",
			);
			$users = elgg_get_entities_from_relationship($options);
			break;
	}
	
	if($users) {
		foreach ($users as $user) {			
			$element = array(
				'id' => $user->getGUID(),
				'value' => $user->name,
				'name' => $user->name,
				'icon' => $user->getIcon('tiny'),
				'type' => 'user',
			);

			$result[] = $element;		
		}
	}
}

if($display_no_result_message && count($result) == 0) {
	$value = elgg_echo('events:search:users:no:results');
	$result[] = array(
		'id' => 0, 
		'label' => $value, 
		'value' => $value,
	);
}

echo json_encode($result);