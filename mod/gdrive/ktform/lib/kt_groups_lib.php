<?php

function kt_groups_init() {
	/**
	 * @KTODO: REVIEW THIS ABOUT REGISTER ACTIONS
	 */
	elgg_register_action('groups/invite', dirname(dirname(__FILE__)) . '/actions/groups/invite_a.php');
	elgg_register_action('groups/join', dirname(dirname(__FILE__)) . '/actions/groups/join_a.php');
	elgg_register_action('groups/killinvitation', dirname(dirname(__FILE__)) . '/actions/groups/killinvitation_a.php');
	elgg_register_action('groups/joinrequest', dirname(dirname(__FILE__)) . '/actions/groups/joinrequest_a.php');
	elgg_register_action('groups/leave', dirname(dirname(__FILE__)) . '/actions/groups/leave_a.php');
	elgg_register_action('groups/killrequest', dirname(dirname(__FILE__)) . '/actions/groups/groupskillrequest_a.php');
	elgg_register_action('groups/addtogroup', dirname(dirname(__FILE__)) . '/actions/groups/addtogroup_a.php');

	elgg_extend_view('gdrive_ktform_group/profile/widgets', 'groups/profileitems');
	elgg_extend_view('gdrive_ktform_group/profile/left_col', 'gdrive_ktform_group/profile/left_col_links', 800);

	elgg_register_page_handler('my_groups', 'kt_groups_page_handler');


	//If groups is disabled, load some libs.
	gdrive_ktform_group_load_libraries();
}

function kt_groups_page_handler($page) {
   $pluginspath = get_config('pluginspath');
   switch ($page[0]) {
	  case 'invitations':
		 !@include_once dirname(dirname(__FILE__)) . '/pages/groups/invitationrequests_p.php';
		 return true;
		 break;

	  case 'membershipreq':
			$allow_section = FALSE;
			$group_guid = get_input('group_guid');
			if ($group_guid) {
				$group = get_entity($group_guid);
				if ($group instanceof ElggGroup) {
					if ($group->canEdit()) {
						$allow_section = TRUE;
					}
				}
			}

			if (!$allow_section) {
				forward();
			}
		 !@include_once dirname(dirname(__FILE__)) . '/pages/groups/membershipreq_p.php';
		 return true;
		 break;

	  case "memberlist":
		 set_input('group_guid', $page[1]);
		 include($pluginspath . "groups/memberlist.php");
		 break;
   }
}

if (!function_exists('ktgroups_get_invited_groups')) {

	/**
	 * Grabs groups by invitations
	 * Have to override all access until there's a way override access to getter functions.
	 *
	 * @param $user_guid
	 * @return unknown_type
	 */
	function ktgroups_get_invited_groups($user_guid, $return_guids = FALSE) {
		$ia = elgg_set_ignore_access(TRUE);
		$invitations = elgg_get_entities_from_relationship(array('relationship' => 'invited', 'relationship_guid' => $user_guid, 'inverse_relationship' => TRUE, 'limit' => 9999));
		elgg_set_ignore_access($ia);

		if ($return_guids) {
			$guids = array();
			foreach ($invitations as $invitation) {
				$guids[] = $invitation->getGUID();
			}

			return $guids;
		}

		return $invitations;
	}

}

/**
 * If groups plugin is disable, load some libs, views translations.
 */
function gdrive_ktform_group_load_libraries() {
	if (elgg_is_active_plugin('groups')) {
		return false;
	}
	
	elgg_extend_view('css/elgg', 'groups/css');

	//Add translations.
	register_translations(dirname(dirname(dirname(__FILE__))) . '/groups/languages/', TRUE);


	//Groups events and hooks.
	// Register a handler for create groups
	elgg_register_event_handler('create', 'group', 'kt_groups_create_event_listener');

	// Register a handler for delete groups
	elgg_register_event_handler('delete', 'group', 'kt_groups_delete_event_listener');

	// Access permissions
	elgg_register_plugin_hook_handler('access:collections:write', 'all', 'kt_groups_write_acl_plugin_hook');

	elgg_register_event_handler('join', 'group', 'kt_groups_user_join_event_listener');
	elgg_register_event_handler('leave', 'group', 'kt_groups_user_leave_event_listener');
	
}

//Group usefull functions.

/**
 * Groups created so create an access list for it
 */
function kt_groups_create_event_listener($event, $object_type, $object) {

	$ac_name = elgg_echo('groups:group') . ": " . $object->name;
	$group_id = create_access_collection($ac_name, $object->guid);
	if ($group_id) {
		$object->group_acl = $group_id;
	} else {
		// delete group if access creation fails
		return false;
	}

	return true;
}

/**
 * Groups deleted, so remove access lists.
 */
function kt_groups_delete_event_listener($event, $object_type, $object) {
	delete_access_collection($object->group_acl);

	return true;
}

/**
 * Return the write access for the current group if the user has write access to it.
 */
function kt_groups_write_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	$page_owner = elgg_get_page_owner_entity();
	// get all groups of user in question
	$user = get_entity($params['user_id']);
	if ($user instanceof ElggUser) {
		$groups = elgg_get_entities_from_relationship(array(
			'relationship' => 'member',
			'relationship_guid' => $user->getGUID(),
			'inverse_relationship' => FALSE,
			'limit' => 999
				));

		if (is_array($groups)) {
			foreach ($groups as $group) {
				$group_type_key = 'item:group';
				$group_subtype = $group->getSubtype();
				if ($group_subtype != '') {
					$group_type_key .= ":$group_subtype";
				}

				$returnvalue[$group->group_acl] = elgg_echo($group_type_key) . ': ' . $group->name;
			}
		}
	}

	// This doesn't seem to do anything.
	// There are no hooks to override container permissions for groups
//
//		if ($page_owner instanceof ElggGroup)
//		{
//			if (can_write_to_container())
//			{
//				$returnvalue[$page_owner->group_acl] = elgg_echo('groups:group') . ": " . $page_owner->name;
//			}
//		}
	return $returnvalue;
}

/**
 * Listens to a group join event and adds a user to the group's access control
 *
 */
function kt_groups_user_join_event_listener($event, $object_type, $object) {

	$group = $object['group'];
	$user = $object['user'];
	$acl = $group->group_acl;

	add_user_to_access_collection($user->guid, $acl);

	return true;
}

/**
 * Listens to a group leave event and removes a user from the group's access control
 *
 */
function kt_groups_user_leave_event_listener($event, $object_type, $object) {

	$group = $object['group'];
	$user = $object['user'];
	$acl = $group->group_acl;

	remove_user_from_access_collection($user->guid, $acl);

	return true;
}

elgg_register_event_handler('init', 'system', 'kt_groups_init');

