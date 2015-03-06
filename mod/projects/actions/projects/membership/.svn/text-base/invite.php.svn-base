<?php
/**
 * Invite users to join a project
 *
 * @package ElggProjects
 */

$notifications_handlers = array(
	'email',
	'site',
);

$logged_in_user = elgg_get_logged_in_user_entity();

$user_guid = get_input('user_guid');
if (!is_array($user_guid)) {
	$user_guid = array($user_guid);
}
$project_guid = get_input('project_guid');
$project = get_entity($project_guid);

$invite_type = project_get_invite_type_options(array('value' => get_input('invite_type'), 'with_options_values' => FALSE));

$description = get_input('description');

if (empty($invite_type)) {
	$invite_type = ProjectSettings::REL_INVITED_COLLABORATORS;
}

$invite_type_string = elgg_echo("project:invitation:type:single:{$invite_type}");
$description_string = '';

if (!empty($description) && is_string($description)) {
	$description_string = elgg_echo('project:email:invitation:description_body', array($description));
}


if (count($user_guid) > 0) {
	foreach ($user_guid as $u_id) {
		$user = get_user($u_id);

		if ($user && $project && ($project instanceof ProjectGroup) && $project->canEdit()) {

			if (!check_entity_relationship($project->guid, 'invited', $user->guid)) {

				// Create relationship
				$project->addRelationship($u_id, 'invited');
				$project->addRelationship($u_id, $invite_type);

				// Send email
				$url = elgg_normalize_url("projects/invitations/$user->username");
				$result = notify_user($user->getGUID(), $project->owner_guid,
						elgg_echo('projects:invite:subject', array($user->name, $project->name)),
						elgg_echo('projects:invite:body', array(
							$user->name,
							$logged_in_user->name,
							$project->name,
							$invite_type_string,
							$url,
							$description_string,
						)),
						$notifications_handlers);
				
				if ($result) {
					system_message(elgg_echo("projects:userinvited"));
				} else {
					register_error(elgg_echo("projects:usernotinvited"));
				}
			} else {
				register_error(elgg_echo("projects:useralreadyinvited"));
			}
		}
	}
}

forward(REFERER);
