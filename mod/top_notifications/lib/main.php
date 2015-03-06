<?php

/*
 * Top notifications lib
 */

/**
 * Get friend request
 */
function top_notifications_get_friend_request($options = array()) {
	
	$user_loggedin = elgg_get_logged_in_user_guid();
	
	$defaults = array(
		'relationship' => 'friendrequest',
		'relationship_guid' => $user_loggedin,
		'inverse_relationship' => TRUE,
		'limit' => 5,
		'offset' => 0,
		'count' => FALSE,
	);
	if (!is_array($options)) {
		$options = array();
	}
	$options = array_merge($defaults, $options);
	
	$entities = elgg_get_entities_from_relationship($options);
	
	return $entities;
	
}

/**
 * Get messages
 */
function top_notifications_get_messages($options = array()) {
	
	$user_loggedin = elgg_get_logged_in_user_guid();
	
	$defaults = array(
		'type' => 'object',
		'subtype' => 'messages',
		'metadata_name_value_pairs' => array(
			array('name' => 'toId', 'value' => $user_loggedin),
//			array('name' => 'readYet', 'value' => 0),
		),
		'owner_guid' => $user_loggedin,
		'limit' => 5,
		'offset' => 0,
		'count' => FALSE,
//		'unread' => FALSE,  => If TRUE, check for news messages, if FALSE check for all messages
	);
	if (!is_array($options)) {
		$options = array();
	}
	$options = array_merge($defaults, $options);
	
	// Get messages news?
	if (isset($options['unread']) && $options['unread'] === TRUE) {
		$options['metadata_name_value_pairs'][] = array('name' => 'readYet', 'value' => 0);
	}
	
	$entities = elgg_get_entities_from_metadata($options);
	
	return $entities;
	
}

/**
 * Get data to attend
 * 
 * @param ElggAnnotation $object
 * @return array 
 */
function top_notifications_get_data_to_attend ($object = NULL) {
	
	$data = array();
	
	if (empty($object)) {
		return $data;
	}
	
	if (!($object instanceof ElggAnnotation)) {	
		return $data;
	}
	
	$data['view'] = 'top_notifications/notifications_items/attend';
	$data['subject_guid'] = $object->owner_guid;
	$data['object_guid'] = $object->entity_guid;
	$data['annotation_id'] = $object->id;
	
	return $data;
	
}

/**
 * Get data to like
 * 
 * @param ElggAnnotation $object
 * @return array 
 */
function top_notifications_get_data_to_like($object = NULL) {
	
	$data = array();
	
	if (empty($object)) {
		return $data;
	}
	
	if (!($object instanceof ElggAnnotation)) {	
		return $data;
	}
	
	$data['view'] = 'top_notifications/notifications_items/like';
	$entity = get_entity($object->entity_guid);
	if ($entity) {
		$data['subject_guid'] = $entity->owner_guid;
	}
	$data['object_guid'] = $object->entity_guid;
	$data['annotation_id'] = $object->id;
	
	return $data;
	
}

/**
 * Get data to phototag
 * 
 * @param ElggRelationship $object
 * @return array 
 */
function top_notifications_get_data_to_phototag($object = NULL) {
	
	$data = array();
	
	if (empty($object)) {
		return $data;
	}
	
	if (!($object instanceof ElggRelationship)) {	
		return $data;
	}
	
	$data['view'] = 'top_notifications/notifications_items/phototag';
	$data['subject_guid'] = $object->guid_one;
	$data['object_guid'] = $object->guid_two;
	
	return $data;
	
}

/**
 * Get data to like
 * 
 * @param ElggAnnotation $object
 * @return array 
 */
function top_notifications_get_data_to_generic_comment($object = NULL) {
	$data = array();
	
	if (empty($object)) {
		return $data;
	}
	
	if (!($object instanceof ElggAnnotation)) {	
		return $data;
	}
	
	$data['view'] = 'top_notifications/notifications_items/comment';
	$entity = get_entity($object->entity_guid);
	if ($entity) {
		// Get users who commented
		$user_loggedin_id = elgg_get_logged_in_user_guid();
		
		$users = array();
		if ($entity->owner_guid != $user_loggedin_id) {
			$users[] = $entity->owner_guid;
		}
		$options_ann = array(
			'guid' => $entity->getGUID(),
			'annotation_name' => 'generic_comment',
		);
		$annotations = elgg_get_annotations($options_ann);
		if ($annotations) {
			foreach ($annotations as $annot) {
				$owner_annotation = $annot->owner_guid;
				if ($owner_annotation != $user_loggedin_id && !in_array($owner_annotation, $users)) {
					$users[] = $owner_annotation;
				}
			}
		}
		$data['subject_guid'] = $users;
	}
	$data['object_guid'] = $object->entity_guid;
	$data['annotation_id'] = $object->id;
	
	return $data;
	
}

/**
 * Get data to friend
 * 
 * @param ElggRelationship $object
 * @return array 
 */
function top_notifications_get_data_to_friend($object = NULL) {
	
	$data = array();
	
	if (empty($object)) {
		return $data;
	}
	
	if (!($object instanceof ElggRelationship)) {	
		return $data;
	}
	
	$data['view'] = 'top_notifications/notifications_items/friend';
	$data['subject_guid'] = $object->guid_one;
	$data['object_guid'] = $object->guid_two;
	
	return $data;
	
}

/**
 * Add to Notifications
 * 
 */
function top_notifications_add_to_notifications($view, $action_type, $subject_guid, $object_guid, $access_id = "", $posted = 0, $annotation_id = 0) {
	
	$dbprefix = elgg_get_config('dbprefix');
	
	// use default viewtype for when called from REST api
	if (!elgg_view_exists($view, 'default')) {
		return false;
	}
	if (!($subject = get_entity($subject_guid))) {
		return false;
	}
	if (!($object = get_entity($object_guid))) {
		return false;
	}
	if (empty($action_type)) {
		return false;
	}
	if ($posted == 0) {
		$posted = time();
	}
	if ($access_id === "") {
		$access_id = $object->access_id;
	}
	$annotation_id = (int)$annotation_id;
	$type = $object->getType();
	$subtype = $object->getSubtype();
	$action_type = sanitise_string($action_type);
	
	// Attempt to save river item; return success status
	$result = FALSE;
	try {
		$result = insert_data("insert into {$dbprefix}notifications " .
			" set type = '{$type}', " .
			" subtype = '{$subtype}', " .
			" action_type = '{$action_type}', " .
			" access_id = {$access_id}, " .
			" view = '{$view}', " .
			" subject_guid = {$subject_guid}, " .
			" object_guid = {$object_guid}, " .
			" annotation_id = {$annotation_id}, " .
			" posted = {$posted} ");
	} catch (Exception $e) {
		
	}
		
	return $result;
	
}

/**
 * Mark read notifications
 */
function top_notifications_mark_read_notifications() {
	
	$dbprefix = elgg_get_config('dbprefix');
	
	$user_loggedin = elgg_get_logged_in_user_entity();
	
	$result = FALSE;
	
	if ($user_loggedin) {
		$result = FALSE;
		try {
			$query = "UPDATE `{$dbprefix}notifications`
			SET read_notification = 1
			WHERE subject_guid = {$user_loggedin->getGUID()}";

			$result = update_data($query);
		} catch (Exception $e) {
			
		}
	}
	
	return $result;
	
}

/**
 * Get notifications
 */
function top_notifications_get_notifications($options = array()) {
	
	$dbprefix = elgg_get_config('dbprefix');
	
	$defaults = array(
		'unread' => FALSE,
		'offset' => 0,
		'limit' => 5,
		'count' => FALSE,
	);
	if (!is_array($options)) {
		$options = array();
	}
	$options = array_merge($defaults, $options);
	
	$user_loggedin = elgg_get_logged_in_user_guid();
	
	$query_notif = "SELECT ";
	if ($options['count']) {
		$query_notif .= "COUNT(*) as count";
	}
	else {
		$query_notif .= "*";
	}
	$query_notif .= " FROM `{$dbprefix}notifications` WHERE `subject_guid` = '{$user_loggedin}'";
	if ($options['unread']) {
		$query_notif .= " AND `read_notification` = 0";
	}
	$query_notif .= " ORDER BY posted DESC";
	if (!$options['count'] && $options['limit']) {
		$query_notif .= " LIMIT ".$options['offset'].", ".$options['limit'];
	}
	
	try {
		$data = get_data($query_notif);
		if ($data) {
			if ($options['count']) {
				$obj = current($data);
				return $obj->count;
			}
			return $data;
		}
		return FALSE;
	} catch (Exception $e) {
		
	}
	
	return FALSE;
	
}

/**
 * Build Notifications Tabla
 * 
 * Builds the notification table to record a user notices
 * 
 * This table is equal to the river items, only add the field 'read' to see if the user read the notice or not
 */
function build_notifications_table() {
	
	$dbprefix = elgg_get_config('dbprefix');
	
	$query = "DROP TABLE IF EXISTS `{$dbprefix}notifications`;";
	$query2 = "CREATE TABLE IF NOT EXISTS `{$dbprefix}notifications` (
		`id` int(20) NOT NULL AUTO_INCREMENT,
		`type` varchar(8) NOT NULL,
		`subtype` varchar(32) NOT NULL,
		`action_type` varchar(32) NOT NULL,
		`access_id` int(11) NOT NULL,
		`view` text NOT NULL,
		`subject_guid` int(11) NOT NULL,
		`object_guid` int(11) NOT NULL,
		`annotation_id` int(11) NOT NULL,
		`read_notification` int(1) DEFAULT 0,
		`posted` int(11) NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
	";

	$qs[] = $query;
	$qs[] = $query2;
	foreach ($qs as $q) {
		if (!update_data($q)) {
			throw new Exception('Couldn\'t execute the statitics table setup: ' . $q);
		}
	}
	
}