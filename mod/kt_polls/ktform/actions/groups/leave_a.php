<?php
	/**
	 * Leave a group action.
	 * 
	 * @package ElggGroups
	 */

	// Load configuration
	global $CONFIG;
	
	gatekeeper();
	
	$user_guid = get_input('user_guid');
	$group_guid = get_input('group_guid');
	
	$user = NULL;
	if (!$user_guid) $user = $_SESSION['user'];
	else
		$user = get_entity($user_guid);
		
	$group = get_entity($group_guid);
	
	if (($user instanceof ElggUser) && ($group instanceof ElggGroup))
	{
		
		$subtype = $group->getSubtype();
		$subtype_key = '';
		
		if (!empty($subtype)) {
			$subtype_key = ":{$subtype}";
		}
		
		if ($group->getOwnerGUID() != $_SESSION['guid']) {
			if ($group->leave($user))
				system_message(elgg_echo("groups:left{$subtype_key}"));
			else
				register_error(elgg_echo("groups:cantleave{$subtype_key}"));
		} else {
			register_error(elgg_echo("groups:cantleave{$subtype_key}"));
		}
	}
	else
		register_error(elgg_echo("groups:cantleave{$subtype_key}"));
		
	forward(REFERER);
