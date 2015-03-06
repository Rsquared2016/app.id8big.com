<?php

/**
 * Remove a user from a project
 *
 * @package ElggProjects
 */
$user_guid = get_input('user_guid');
$project_guid = get_input('project_guid');

$user = get_entity($user_guid);
$project = get_entity($project_guid);

elgg_set_page_owner_guid($project->guid);

if (($user instanceof ElggUser) && ($project instanceof ProjectGroup)) {
	// Don't allow removing project owner
	
	$member_type = $project->getMemberType($user->getGUID());
	
	$can_remove = ($project->canEdit() && $project->getOwnerGUID() != $user->guid);
	$can_collaborator_remove = (($project->getMemberType(elgg_get_logged_in_user_guid()) == ProjectSettings::REL_COLLABORATOR) && $member_type == ProjectSettings::REL_VISITOR);

	if ($can_remove == FALSE && $can_collaborator_remove == TRUE) {
		$can_remove = TRUE;
	}

	if ($can_remove) {
		if ($project->leave($user)) {
			system_message(elgg_echo("projects:removed", array($user->name)));
		} else {
			register_error(elgg_echo("projects:cantremove"));
		}
	} else {
		register_error(elgg_echo("projects:cantremove"));
	}
} else {
	register_error(elgg_echo("projects:cantremove"));
}

forward(REFERER);
