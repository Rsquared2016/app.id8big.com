<?php
/**
 * Leave a project action.
 *
 * @package ElggProjects
 */

$user_guid = get_input('user_guid');
$project_guid = get_input('project_guid');
$actual_relationship = get_input('relationship');

$user = NULL;
if (!$user_guid) {
	$user = elgg_get_logged_in_user_entity();
} else {
	$user = get_entity($user_guid);
}

$project = get_entity($project_guid);

elgg_set_page_owner_guid($project->guid);

if (($user instanceof ElggUser) && ($project instanceof ProjectGroup)) {
	if ($project->getOwnerGUID() == elgg_get_logged_in_user_guid()) {
        if ($actual_relationship == ProjectSettings::REL_COLLABORATOR) {
            remove_entity_relationship($user_guid, ProjectSettings::REL_COLLABORATOR, $project_guid);
            $success = add_entity_relationship($user_guid, ProjectSettings::REL_VISITOR, $project_guid);
            if ($success) {
                system_message(elgg_echo('projects:change_relation:visitor:ok'));
            } else {
                register_error(elgg_echo("projects:change_relation:error"));
            }
        } else {
            remove_entity_relationship($user_guid, ProjectSettings::REL_VISITOR, $project_guid);
            $success = add_entity_relationship($user_guid, ProjectSettings::REL_COLLABORATOR, $project_guid);
            if ($success) {
                system_message(elgg_echo('projects:change_relation:collaborator:ok'));
            } else {
                register_error(elgg_echo("projects:change_relation:error"));
            }
        }
	} else {
		register_error(elgg_echo("projects:change_relation:error"));
	}
} else {
	register_error(elgg_echo("projects:change_relation:error"));
}

forward(REFERER);
