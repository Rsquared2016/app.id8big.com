<?php

/**
 * Elgg projects plugin edit action.
 *
 * @package ElggProjects
 */
elgg_make_sticky_form('projects');

/**
 * wrapper for recursive array walk decoding
 */
function projects_profile_array_decoder(&$v) {
	$v = _elgg_html_decode($v);
}

// Get project fields
$input = array();
$project_required_fields = elgg_get_config('project_required_fields');
$accesslevel = elgg_get_config('project_access_fields');

foreach (elgg_get_config('project') as $shortname => $valuetype) {
	$input[$shortname] = get_input($shortname);

	if (in_array($shortname, $project_required_fields)) {
		if (empty($input[$shortname])) {
			register_error(elgg_echo("projects:errors:empty:{$shortname}"));
			forward(REFERER);
		}
	}

	// @todo treat profile fields as unescaped: don't filter, encode on output
	if (is_array($input[$shortname])) {
		array_walk_recursive($input[$shortname], 'projects_profile_array_decoder');
	} else {
		$input[$shortname] = _elgg_html_decode($input[$shortname]);
	}

	if ($valuetype == 'tags') {
		$input[$shortname] = string_to_tag_array($input[$shortname]);
	}
}

$input['name'] = htmlspecialchars(get_input('name', '', false), ENT_QUOTES, 'UTF-8');

$user = elgg_get_logged_in_user_entity();

$project_guid = (int) get_input('project_guid');
$is_new_project = $project_guid == 0;

if ($is_new_project
		&& (elgg_get_plugin_setting('limited_projects', 'projects') == 'yes')
		&& !$user->isAdmin()) {
	register_error(elgg_echo("projects:cantcreate"));
	forward(REFERER);
}

$project = new ProjectGroup($project_guid); // load if present, if not create a new project
if ($project_guid && !$project->canEdit()) {
	register_error(elgg_echo("projects:cantedit"));
	forward(REFERER);
}


$project->name = $input['name'];
$project->description = $input['description'];


// Validate create
if (!$project->name) {
	register_error(elgg_echo("projects:notitle"));
	forward(REFERER);
}


// Set project tool options
$tool_options = elgg_get_config('group_tool_options');
if ($tool_options) {
	foreach ($tool_options as $project_option) {
		$option_toggle_name = $project_option->name . "_enable";
		$option_default = $project_option->default_on ? 'yes' : 'no';
		$project->$option_toggle_name = get_input($option_toggle_name, $option_default);
	}
}

// Project membership - should these be treated with same constants as access permissions?
$is_public_membership = (get_input('membership') == ACCESS_PUBLIC);
$project->membership = $is_public_membership ? ACCESS_PUBLIC : ACCESS_PRIVATE;

if ($is_new_project) {
	$project->access_id = ACCESS_PUBLIC;
}

$old_owner_guid = $is_new_project ? 0 : $project->owner_guid;
$new_owner_guid = (int) get_input('owner_guid');

$owner_has_changed = false;
$old_icontime = null;
if (!$is_new_project && $new_owner_guid && $new_owner_guid != $old_owner_guid) {
	// verify new owner is member and old owner/admin is logged in
	if (is_group_member($project_guid, $new_owner_guid) && ($old_owner_guid == $user->guid || $user->isAdmin())) {
		$project->owner_guid = $new_owner_guid;

		// @todo Remove this when #4683 fixed
		$owner_has_changed = true;
		$old_icontime = $project->icontime;
	}
}

$must_move_icons = ($owner_has_changed && $old_icontime);

$success_guid = $project->save();
// Invisible project support
// @todo this requires save to be called to create the acl for the project. This
// is an odd requirement and should be removed. Either the acl creation happens
// in the action or the visibility moves to a plugin hook
if (projects_ask_for_allow_hidden_creation()) {
	
	$visibility = (int) get_input('vis', '', false);
	
	if ($visibility != ACCESS_PUBLIC && $visibility != ACCESS_LOGGED_IN) {
		$visibility = $project->group_acl;
	}

	if ($project->access_id != $visibility) {
		//Set an input to advice the events that need to change permissions on entities
		set_input('project_change_permissions', TRUE);
		$project->access_id = $visibility;
	}
}

$success_guid = $project->save();
if ($success_guid) {
	// Assume we can edit or this is a new project
	if (sizeof($input) > 0) {
		foreach ($input as $shortname => $value) {

			if ($shortname == 'name' || $shortname == 'description') {
				continue;
			}

			$options = array(
				'guid' => $project->getGUID(),
				'metadata_name' => $shortname,
				'limit' => FALSE,
			);

			elgg_delete_metadata($options);

			// only create metadata for non empty values (0 is allowed) to prevent metadata records with empty string values #4858
			if (!is_null($value) && ($value !== '')) {
				//		$project->$shortname = $value;

				if (isset($accesslevel[$shortname])) {
					$access_metadata_id = (int) $accesslevel[$shortname];
				} else {
					// this should never be executed since the access level should always be set
					$access_metadata_id = ACCESS_PUBLIC;
				}
				if (is_array($value)) {
					$i = 0;
					foreach ($value as $interval) {
						$i++;
						$multiple = ($i > 1) ? TRUE : FALSE;
						create_metadata($project->getGUID(), $shortname, $interval, 'text', $project->getOwnerGUID(), $access_metadata_id, $multiple);
					}
				} else {
					create_metadata($project->getGUID(), $shortname, $value, 'text', $project->getOwnerGUID(), $access_metadata_id);
				}
			}
		}
	}
}

// project saved so clear sticky form
elgg_clear_sticky_form('projects');

// project creator needs to be member of new project and river entry created
if ($is_new_project) {

	// @todo this should not be necessary...
	elgg_set_page_owner_guid($project->guid);

	$project->join($user);
	add_to_river('river/group/project/create', 'create', $user->guid, $project->guid, $project->access_id);
}

$has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));

if ($has_uploaded_icon) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "projects/" . $project->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $project->owner_guid;
	$filehandler->setFilename($prefix . ".jpg");
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('icon'));
	$filehandler->close();
	$filename = $filehandler->getFilenameOnFilestore();

	$sizes = array('tiny', 'small', 'medium', 'large');

	$thumbs = array();
	foreach ($sizes as $size) {
		$thumbs[$size] = get_resized_image_from_existing_file(
				$filename, $icon_sizes[$size]['w'], $icon_sizes[$size]['h'], $icon_sizes[$size]['square']
		);
	}

	if ($thumbs['tiny']) { // just checking if resize successful
		$thumb = new ElggFile();
		$thumb->owner_guid = $project->owner_guid;
		$thumb->setMimeType('image/jpeg');

		foreach ($sizes as $size) {
			$thumb->setFilename("{$prefix}{$size}.jpg");
			$thumb->open("write");
			$thumb->write($thumbs[$size]);
			$thumb->close();
		}

		$project->icontime = time();
	}
}

// @todo Remove this when #4683 fixed
if ($must_move_icons) {
	$filehandler = new ElggFile();
	$filehandler->setFilename('projects');
	$filehandler->owner_guid = $old_owner_guid;
	$old_path = $filehandler->getFilenameOnFilestore();

	$sizes = array('', 'tiny', 'small', 'medium', 'large');

	if ($has_uploaded_icon) {
		// delete those under old owner
		foreach ($sizes as $size) {
			unlink("$old_path/{$project_guid}{$size}.jpg");
		}
	} else {
		// move existing to new owner
		$filehandler->owner_guid = $project->owner_guid;
		$new_path = $filehandler->getFilenameOnFilestore();

		foreach ($sizes as $size) {
			rename("$old_path/{$project_guid}{$size}.jpg", "$new_path/{$project_guid}{$size}.jpg");
		}
	}
}

/**
 * Lanunch an event to change permissions and other related stuffs to projects after saved.
 */
elgg_trigger_event('project:updated', 'group',$project);

system_message(elgg_echo("projects:saved"));

forward($project->getUrl());
