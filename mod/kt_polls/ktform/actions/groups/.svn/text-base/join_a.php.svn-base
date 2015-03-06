<?php

/**
 * Join a group action.
 *
 * @package ElggGroups
 */
// Load configuration
global $CONFIG;
gatekeeper();

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$group_guid = get_input('group_guid');

// @todo fix for #287
// disable access to get entity.
$invitations = ktgroups_get_invited_groups($user_guid, TRUE);

if (in_array($group_guid, $invitations)) {
	$ia = elgg_set_ignore_access(TRUE);
}

$user = get_entity($user_guid);
$group = get_entity($group_guid);


if (($user instanceof ElggUser) && ($group instanceof ElggGroup)) {
	$params = array(
		'group' => $group,
		'user' => $user,
	);
	
	$subtype = $group->getSubtype();

	if ($group->isPublicMembership()) {
		
		$joined = $group->join($user);
		$before_join = elgg_trigger_plugin_hook('kt_groups:before_join', 'group', $params, FALSE);
		
		if ($joined || $before_join) {
			if ($subtype) {
				system_message(elgg_echo("groups:joined:{$subtype}"));
			} else {
				system_message(elgg_echo("groups:joined"));
			}

			// Remove any invite or join request flags
			remove_entity_relationship($group->guid, 'invited', $user->guid);
			remove_entity_relationship($user->guid, 'membership_request', $group->guid);

			// add to river
			add_to_river('river/relationship/member/create', 'join', $user->guid, $group->guid);



			//We launch a trigger so others plugins can make other stuffs
			elgg_trigger_plugin_hook('kt_groups:joined', 'group', $params);

			forward($group->getURL());
			exit;
		} else {
			if ($subtype) {
				register_error(elgg_echo("groups:cantjoin:{$subtype}"));
			} else {
				register_error(elgg_echo("groups:cantjoin"));
			}
		}
	} else {
		// Closed group, request membership
		system_message(elgg_echo('groups:privategroup'));
		forward(elgg_add_action_tokens_to_url($CONFIG->url . "action/groups/joinrequest?user_guid=$user_guid&group_guid=$group_guid"));
		exit;
	}
} else {
	register_error(elgg_echo("groups:cantjoin"));
}

forward($_SERVER['HTTP_REFERER']);
