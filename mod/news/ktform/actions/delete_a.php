<?php
/**
 * Elgg entity: delete action
 * 
 */

// Make sure we're logged in (send us to the front page if not)
	gatekeeper();
	//keetup Note: this code is only for this proyect, we need to show disabled pics
	if (elgg_is_admin_logged_in()){
		$access_status = access_get_show_hidden_status();
		access_show_hidden_entities(true);
	}
	
// Get input data
	$guid = (int) get_input('guid');
	$fw = get_input('fw', ''); //If we add the string 'fw_ref' => Redirecciona al referer.
	$sucess = false;
// Make sure we actually have permission to edit
	$old_access = access_get_show_hidden_status();
	access_show_hidden_entities(TRUE);
	$entity = get_entity($guid);
	access_show_hidden_entities($old_access);
	
	if($entity) {
		if ($entity->canEdit()) {
		// Delete it!
				$rowsaffected = $entity->delete();
				if ($rowsaffected > 0) {
					$sucess = true;
				}
		}

		//Try to detect object type.
		$subtype = $entity->getSubtype();
		if($sucess) {
			if(!$fw && is_callable(array($entity, 'getListingLink'))) {
				$fw = $entity->getListingLink();
			}

		// Success message
			system_message(sprintf(elgg_echo("news_ktform:delete:entity:deleted"), elgg_echo('item:object:'.$subtype)));

		} else {
			register_error(sprintf(elgg_echo("news_ktform:delete:entity:not_deleted"), elgg_echo('item:object:'.$subtype)));
		}
	} else {
		register_error(sprintf(elgg_echo("news_ktform:delete:entity:not_deleted"), elgg_echo('item:object:'.$subtype)));
	}
	if (elgg_is_admin_logged_in()){
		access_show_hidden_entities($access_status);
	}
	
	if($fw == 'fw_ref') {
		$fw = REFERER;
	}
	// Forward
	forward($fw);