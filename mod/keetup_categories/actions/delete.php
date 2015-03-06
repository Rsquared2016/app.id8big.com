<?php

	/**
	 * Elgg entity: delete action
	 * 
	 */

	// Make sure we're logged in (send us to the front page if not)
		admin_gatekeeper();

	// Get input data
		$guid = (int) get_input('guid');
		$sucess = false;
	// Make sure we actually have permission to edit
		$entity = get_entity($guid);
		if ($entity instanceof KtCategory && $entity->canEdit()) {
	
		// Delete it!
			$rowsaffected = $entity->delete();
			if ($rowsaffected > 0) {
				$sucess = true;
			}
		}
		
		if($sucess) {
		// Success message
			system_message(elgg_echo("keetup_categories:category:deleted"));
			
		} else {
			register_error(elgg_echo("keetup_categories:category:error:deleting"));
		}
		// Forward
			forward($_SERVER['HTTP_REFERER']);
		
?>