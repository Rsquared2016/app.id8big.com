<?php
	/**
	 * Delete an invitation to join a closed group.
	 *
	 * @package ElggGroups
	 */

	// Load configuration
	global $CONFIG;

	gatekeeper();

	$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
	$group_guid = get_input('group_guid');

	$user = get_entity($user_guid);
	$group = get_entity($group_guid);

	// If join request made
			if (check_entity_relationship($group->guid, 'invited', $user->guid))
			{
				remove_entity_relationship($group->guid, 'invited', $user->guid);
				system_message(elgg_echo("groups:invitekilled"));
				
			$params = array(
				'group' => $group,
				'user' => $user,
			);

			//We launch a trigger so others plugins can make other stuffs
			elgg_trigger_plugin_hook('kt_groups:invitekilled', 'group', $params);				
			}

	forward($_SERVER['HTTP_REFERER']);

?>