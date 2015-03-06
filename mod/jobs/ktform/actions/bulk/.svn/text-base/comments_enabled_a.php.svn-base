<?php

/*
 * Bulk action allow.
 * 
 */
// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get input data
$guids = get_input('guids');

$enabled = get_input('enabled', TRUE); //Boolean input.

$comment_enabled = ($enabled)? 'on' : 'off';

if(!is_array($guids)) {
	$guids = array($guids);
}

$fw = get_input('fw', REFERER); //If we add the string 'fw_ref' => Redirecciona al referer.

$success = TRUE;
try {
	foreach ($guids as $guid) {
		// Make sure we actually have permission to edit
		$entity = get_entity($guid);

		if($entity && $entity->canEdit()) {
			//Add comments enabled option.
			$entity->comments_on = $comment_enabled;

		} else {
			throw new DataFormatException(elgg_echo("jobs_ktform:comments:bulk:action:entity:not:allowed"));
		}
	}
} catch(Exception $e) {
	register_error($e->getMessage());
	$sucess = FALSE;
}

if($success) {
	// Success message
	system_message(elgg_echo("jobs_ktform:comments:bulk:action:entity:comments:$comment_enabled"));
}

// Forward
//forward($fw);
forward(REFERER);
