<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$is_xhr = elgg_is_xhr();
if (!$is_xhr) {
	forward();
}

$guid = get_input('guid');
$entity = get_entity($guid);

if (!($entity instanceof ProjectGroup)) {
	register_error(elgg_echo('gcalendar:sync:error'));
	forward();
}
if (!$entity->canWriteToContainer()) {
	forward();
}

// Google Drive
$gc = new GCalendarIntegration();
$gc->authenticate();

// Sync permissions
$options = array(
	'type'=> 'object',
	'subtype' => 'meeting',
	'owner_guid' => elgg_get_logged_in_user_guid(),
	'container_guid' => $entity->getGUID(),
	'annotation_names' => GCALENDAR_SYNC,
	'offset' => 0,
	'limit' => null,
);
$meetings = elgg_get_entities_from_annotations($options);

if ($meetings) {
	foreach ($meetings as $m) {
		$event_id = $m->event_id;
		$attendees = array();
		$attendees_delete = array();
		
		// Get users to sync
		$annotations = $m->getAnnotations(GCALENDAR_SYNC, null);
		if ($annotations) {
			foreach ($annotations as $an) {
				$user = get_entity($an->owner_guid);
				
				$is_collaborator = false;
				$is_visitor = false;
				
				if ($user instanceof ElggUser) {
					$is_collaborator = check_entity_relationship($user->getGUID(), 'collaborator', $entity->getGUID());
					if (!$is_collaborator) {
						$is_visitor = check_entity_relationship($user->getGUID(), 'visitor', $entity->getGUID());
					}
					
					if ($is_collaborator || $is_visitor) {
						$attendees[] = $user->email;
					}
					else {
						$attendees_delete[] = $user->email;
					}
					
					// Delete annotation sync
					elgg_delete_annotations(array(
						'guid' => $m->getGUID(),
						'annotation_names' => GCALENDAR_SYNC,
						'annotation_owner_guids' => $user->getGUID(),
					));
				}
			}
		}
		
		if (!empty($attendees) || !empty($attendees_delete)) {
			$params = array(
				'event_id' => $event_id,
				'attendees' => $attendees,
				'attendees_delete' => $attendees_delete,
			);
			$update_event = $gc->updateEvent($params);
		}
	}
}

system_message(elgg_echo('gcalendar:sync:success'));

forward();