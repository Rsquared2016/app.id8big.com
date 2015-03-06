<?php

/**
 * Function to retrieve if the group support hidden groups creation
 * @return boolean if allow hidden creation or not
 */
function projects_ask_for_allow_hidden_creation() {
	$default_value = PROJECTS_HIDDEN_GROUPS;

	$setting_value = elgg_get_plugin_setting('hidden_projects', 'projects');

	switch ($setting_value) {
		case 'yes':
			return TRUE;
			break;
		case 'no':
			return FALSE;
			break;

		default:
			return $default_value;
			break;
	}
}

/**
 *	Function to get all options values of the status project, this is used for example in a pulldown
 * 
 * @param array $options
 * 
 *	 Array in format:
 * 
 *		with_options_values => bool if true, return an associative array with key => translated text, otherwise just an array with system names
 * 
 *		value => string if we send a value, then will return if exists the value
 * 
 *		selectable => bool, will add the first option as a null value and with a friendly text, for example "PLease select one option",s
 * 
 * @return string
 */
function projects_get_status_options(array $options = array()) {
	$default_options = array(
		'with_options_values' => TRUE,
		'value' => NULL,
		'selectable' => FALSE,
	);

	$options = array_merge($default_options, $options);

	$return = array();

	$status_options = array(
		'idea_phase',
		'team_building',
        'validating_business_model',
		'project_development',
        'beta_testing',
		'seeking_funding',
        'operating',
		'suspended',
	);
	
	$selectable_option = array(0 => elgg_echo("projects:status:opt:select_one"));


	if ($options['with_options_values']) {
		foreach ($status_options as $opt_value) {
			$return[$opt_value] = elgg_echo("projects:status:opt:{$opt_value}");
		}
	} else {
		foreach ($status_options as $opt_value) {
			$return[$opt_value] = $opt_value;
		}
	}

	if ($options['value'] !== NULL) {
		if (array_key_exists($options['value'], $return)) {
			return $return[$options['value']];
		} else {
			return NULL;
		}
	}
	
	if ($options['selectable'] === TRUE) {
		$return = $selectable_option + $return;
	}
	
	return $return;
}

/**
 * 	Function to get all options values of the type of project, this is used for example in a pulldown
 * 
 * @param array $options
 * 
 * 	 Array in format:
 * 
 * 		with_options_values => bool if true, return an associative array with key => translated text, otherwise just an array with system names
 * 
 * 		value => string if we send a value, then will return if exists the value
 * 
 * 		selectable => bool, will add the first option as a null value and with a friendly text, for example "PLease select one option",s
 * 
 * @return string
 */
function project_get_types_options(array $options = array()) {
	$default_options = array(
		'with_options_values' => TRUE,
		'value' => NULL,
		'selectable' => FALSE,
	);

	$options = array_merge($default_options, $options);

	$return = array();

	$status_options = array(
		'commercial',
		'nonprofit',
		'hybrid',
		'undecided',
	);

	$selectable_option = array(0 => elgg_echo("projects:types:opt:select_one"));


	if ($options['with_options_values']) {
		foreach ($status_options as $opt_value) {
			$return[$opt_value] = elgg_echo("projects:types:opt:{$opt_value}");
		}
	} else {
		foreach ($status_options as $opt_value) {
			$return[$opt_value] = $opt_value;
		}
	}

	if ($options['value'] !== NULL) {
		if (array_key_exists($options['value'], $return)) {
			return $return[$options['value']];
		} else {
			return NULL;
		}
	}


	if ($options['selectable'] === TRUE) {
		$return = $selectable_option + $return;
	}


	return $return;
}


/**
 * May the current user access item(s) on this page? If the page owner is a group,
 * membership, visibility, and logged in status are taken into account.
 *
 * @param boolean $forward If set to true (default), will forward the page;
 *                         if set to false, will return true or false.
 *
 * @return bool If $forward is set to false.
 */
function project_gatekeeper($forward = true) {

	$page_owner_guid = elgg_get_page_owner_guid();
	if (!$page_owner_guid) {
		return true;
	}
	$visibility = ElggProjectItemVisibility::factory($page_owner_guid);

	if (!$visibility->shouldHideItems) {
		return true;
	}
	if ($forward) {
		// only forward to group if user can see it
		$group = get_entity($page_owner_guid);
		$forward_url = $group ? $group->getURL() : '';

		if (!elgg_is_logged_in()) {
			$_SESSION['last_forward_from'] = current_page_url();
			$forward_reason = 'login';
		} else {
			$forward_reason = 'member';
		}

		register_error(elgg_echo($visibility->reasonHidden));
		forward($forward_url, $forward_reason);
	}

	return false;
}



/**
 * 	Function to get all options values of the invitations project, this is used for example in a pulldown
 * 
 * @param array $options
 * 
 * 	 Array in format:
 * 
 * 		with_options_values => bool if true, return an associative array with key => translated text, otherwise just an array with system names
 * 
 * 		value => string if we send a value, then will return if exists the value
 * 
 * 		selectable => bool, will add the first option as a null value and with a friendly text, for example "PLease select one option",s
 * 
 * @return string
 */
function project_get_invite_type_options(array $options = array()) {
	$default_options = array(
		'with_options_values' => TRUE,
		'value' => NULL,
		'selectable' => FALSE,
	);

	$options = array_merge($default_options, $options);

	$return = array();

	$invite_options = array(
		ProjectSettings::REL_INVITED_VISITOR,
		ProjectSettings::REL_INVITED_COLLABORATORS,
	);

	$selectable_option = array(0 => elgg_echo("projects:invite:opt:select_one"));


	if ($options['with_options_values']) {
		foreach ($invite_options as $opt_value) {
			$return[$opt_value] = elgg_echo("projects:invite:opt:{$opt_value}");
		}
	} else {
		foreach ($invite_options as $opt_value) {
			$return[$opt_value] = $opt_value;
		}
	}

	if ($options['value'] !== NULL) {
		if (array_key_exists($options['value'], $return)) {
			return $return[$options['value']];
		} else {
			return NULL;
		}
	}


	if ($options['selectable'] === TRUE) {
		$return = $selectable_option + $return;
	}


	return $return;
}