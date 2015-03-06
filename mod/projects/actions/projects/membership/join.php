<?php
/**
 * Join a project
 *
 * Three states:
 * open project so user joins
 * closed project so request sent to project owner
 * closed project with invite so user joins
 * 
 * @package ElggProjects
 */

global $CONFIG;

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$project_guid = get_input('project_guid');

$user = get_entity($user_guid);

// access bypass for getting invisible project
$ia = elgg_set_ignore_access(true);
$project = get_entity($project_guid);
elgg_set_ignore_access($ia);

if (($user instanceof ElggUser) && ($project instanceof ProjectGroup)) {

	// join or request
	$join = false;
	if ($project->isPublicMembership() || $project->canEdit($user->guid)) {
		// anyone can join public projects and admins can join any project
		$join = true;
	} else {
		if (check_entity_relationship($project->guid, 'invited', $user->guid)) {
			// user has invite to closed project
			$join = true;
		}
	}
	
	//Verify if the user is trying to join with a shared url or hacked one
	if ($join == FALSE) {
		if ($project->isOpenProject() == FALSE) {
			register_error(elgg_echo("projects:cannotrequest"));
			forward(REFERER);
		}
	}

	if ($join) {
		if (projects_join_project($project, $user)) {
			system_message(elgg_echo("projects:joined"));
			forward($project->getURL());
		} else {
			register_error(elgg_echo("projects:cantjoin"));
		}
	} else {
		add_entity_relationship($user->guid, 'membership_request', $project->guid);

		// Notify project owner
		$url = "{$CONFIG->url}projects/requests/$project->guid";
		$subject = elgg_echo('projects:request:subject', array(
			$user->name,
			$project->name,
		));
		$body = elgg_echo('projects:request:body', array(
			$project->getOwnerEntity()->name,
			$user->name,
			$project->name,
			$user->getURL(),
			$url,
		));
		
		if (notify_user($project->owner_guid, $user->getGUID(), $subject, $body)) {
			system_message(elgg_echo("projects:joinrequestmade"));
		} else {
			register_error(elgg_echo("projects:joinrequestnotmade"));
		}
	}
} else {
	register_error(elgg_echo("projects:cantjoin"));
}

forward(REFERER);
