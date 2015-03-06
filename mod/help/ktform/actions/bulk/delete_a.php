<?php
/*
 * Bulk action delete.
 * 
 */
// Make sure we're logged in (send us to the front page if not)
gatekeeper();

//Show hidden entities.
if(elgg_is_admin_logged_in()) {
	$access_status = access_get_show_hidden_status();
	access_show_hidden_entities(TRUE);
}

// Get input data
$guids = get_input('guids');

if(!is_array($guids)) {
	$guids = array($guids);
}

$fw = get_input('fw', 'fw_ref'); //If we add the string 'fw_ref' => Redirecciona al referer.

$success = TRUE;
try {
	foreach ($guids as $guid) {
		// Make sure we actually have permission to edit
		$entity = get_entity($guid);

		if($entity && $entity->canEdit()) {
			// Delete it!
			$rowsaffected = $entity->delete();

			if(!$rowsaffected) {
				throw new DataFormatException(sprintf(elgg_echo("help_ktform:delete:entity:not_deleted"), $entity->getSubtype()));
			}
		} else {
			throw new DataFormatException(elgg_echo("help_ktform:delete:entity:not_deleted"));
		}
	}
} catch(Exception $e) {
	register_error($e->getMessage());
	$sucess = FALSE;
}

if($success) {
	// Success message
	system_message(elgg_echo("help_ktform:delete:entity:deleted"), elgg_echo('help_ktform:delete:content:deleted'));
}


if($fw == 'fw_ref') {
	$fw = REFERER;
}

if(elgg_is_admin_logged_in()) {
	//Return to previous access ?
	access_show_hidden_entities($access_status);
}

// Forward
forward($fw);