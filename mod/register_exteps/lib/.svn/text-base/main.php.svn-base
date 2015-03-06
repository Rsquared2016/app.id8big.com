<?php

/**
 * register_exteps
 *
 * Main Lib description here...
 * 
 * @author Bortoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
function register_exteps_get_value_facebook($name = false) {

	$value = '';

	if ($name) {
		$user = get_loggedin_user();
		if ($user) {
			$facebook_uid = get_private_setting($user->getGUID(), 'plugin:settings:facebookservice:uid');
			if ($facebook_uid) {
				if ($user->next_step == 'personal_information') {
					if (isset($_SESSION['fb_data']) && is_array($_SESSION['fb_data'])) {
						if (is_callable('facebookservice_get_profile_fields_to_upgrade') && is_callable('facebookservice_get_gender_relation')) {
							$inputs = facebookservice_get_profile_fields_to_upgrade();
							$gender = facebookservice_get_gender_relation();

							if ($name == 'sexo') {
								$key = $inputs[$name];
								$value = $gender[$_SESSION['fb_data'][$key]];
							} else {
								$key = $inputs[$name];
								$value = $_SESSION['fb_data'][$key];
							}
						}
					}
				}
			}
		}
	}

	return $value;
}

function register_exteps_gatekeeper($user = FALSE) {
	$current_step = get_input('tab');

	$next_step_url = register_exteps_get_step_url($user);

	if ($next_step_url) {
		forward();
	}
}

function register_exteps_get_step($user = FALSE) {

	$user = ProfileComplete::get_user_entity($user);

	//$next_step = 'basic_information';
	$next_step = 'personal_information';

	if ($user) {
		if (empty($user->next_step) == FALSE) {
			$next_step = $user->next_step;
		} else {
			$next_step = 'profile_image';
		}
	}

	return $next_step;
}

function register_exteps_get_step_url($user = FALSE) {
	global $CONFIG;

	$user = ProfileComplete::get_user_entity($user);

	$user_type = $user->getSubtype();
	if (empty($user_type)) {
		$user_type = US_USER;
	}

	$next_step = register_exteps_get_step($user);

	if ($next_step == 'go_home') {
		return NULL;
	}

	$next_step_url = $CONFIG->url . 'register/';
	//$next_step_url = elgg_http_add_url_query_elements($next_step_url, array('user_type' => $user_type, 'tab' => $next_step));
	$next_step_url = elgg_http_add_url_query_elements($next_step_url, array('tab' => $next_step));

	return $next_step_url;
}

function register_exteps_get_user_tab($user_type) {

	$tabs = array();

	if (empty($user_type)) {
		$user_type = US_USER;
	}

	switch ($user_type) {

		default:
			$tabs = array(
				//'basic_information' => elgg_echo("register_exteps:tab_info:basic_information:title:{$user_type}"),
				//'profile_image' => elgg_echo("register_exteps:tab_info:profile_image:title:{$user_type}"),
				'create_account' => elgg_echo('register_exteps:tab_info:create_acount'),
				'personal_information' => elgg_echo("register_exteps:tab_info:personal_information:title:{$user_type}"),
				//'professional_information' => elgg_echo("register_exteps:tab_info:profile_image:title:{$user_type}"),
//				'start_using' => elgg_echo('register_exteps:tab_info:start_using'),
			);
			break;
	}

	return $tabs;
}

/**
 * Registers a user, returning false if the username already exists
 *
 * @param string $username The username of the new user
 * @param string $password The password
 * @param string $name The user's display name
 * @param string $email Their email address
 * @param bool $allow_multiple_emails Allow the same email address to be registered multiple times?
 * @param int $friend_guid Optionally, GUID of a user this user will friend once fully registered
 * @return int|false The new user's GUID; false on failure
 */
if (!is_callable('register_user_subtype')) {

	function register_user_subtype($username, $password, $name, $email, $allow_multiple_emails = false, $friend_guid = 0, $invitecode = '') {
		// Load the configuration
		global $CONFIG;

		$username = trim($username);
		// no need to trim password.
		$password = $password;
		$name = trim($name);
		$email = trim($email);

		// A little sanity checking
		if (empty($username)
				|| empty($password)
				|| empty($name)
				|| empty($email)) {
			return false;
		}

		// See if it exists and is disabled
		$access_status = access_get_show_hidden_status();
		access_show_hidden_entities(true);

		// Validate email address
		if (!validate_email_address($email)) {
			throw new RegistrationException(elgg_echo('registration:emailnotvalid'));
		}

		// Validate password
		if (!validate_password($password)) {
			throw new RegistrationException(elgg_echo('registration:passwordnotvalid'));
		}

		// Validate the username
		if (!validate_username($username)) {
			throw new RegistrationException(elgg_echo('registration:usernamenotvalid'));
		}

		// Check to see if $username exists already
		if ($user = get_user_by_username($username)) {
			//return false;
			throw new RegistrationException(elgg_echo('registration:userexists'));
		}

		// If we're not allowed multiple emails then see if this address has been used before
		if ((!$allow_multiple_emails) && (get_user_by_email($email))) {
			throw new RegistrationException(elgg_echo('registration:dupeemail'));
		}

		access_show_hidden_entities($access_status);

		// Check to see if we've registered the first admin yet.
		// If not, this is the first admin user!
		$have_admin = datalist_get('admin_registered');

		//KT: Modification: User subtype
		$user_subtype = kt_get_user_subtype();

		// Otherwise ...
		$user = new ElggUser();

		//Subtype
		if ($user_subtype != '') {
			$user->subtype = $user_subtype;
		}

		$user->username = $username;
		$user->email = $email;
		$user->name = $name;
		$user->access_id = ACCESS_PUBLIC;
		$user->salt = generate_random_cleartext_password(); // Note salt generated before password!
		$user->password = generate_user_password($user, $password);
		$user->owner_guid = 0; // Users aren't owned by anyone, even if they are admin created.
		$user->container_guid = 0; // Users aren't contained by anyone, even if they are admin created.
		$user->save();

		// If $friend_guid has been set, make mutual friends
		if ($friend_guid) {
			if ($friend_user = get_user($friend_guid)) {

//				$generated_invite_code = generate_invite_code($friend_user->username);
//				
//				if (is_callable('kt_get_entity_by_invitecode')) {
//					$invitation = kt_get_entity_by_invitecode($invitecode);
//					if ($invitation) {
//						$generated_invite_code = $invitation->generateInviteCode();
//					}
//				}
//				
//				if ($invitecode == $generated_invite_code) {
				$friend_added = $user->addFriend($friend_guid);
				$added_friend = $friend_user->addFriend($user->guid);

				if ($friend_added && $added_friend) {
					// @todo Should this be in addFriend?
					add_to_river('friends/river/create', 'friend', $user->getGUID(), $friend_guid);
					add_to_river('friends/river/create', 'friend', $friend_guid, $user->getGUID());
				}
//				}
			}
		}

		global $registering_admin;
		if (!$have_admin) {
			$user->admin = true;
			set_user_validation_status($user->getGUID(), TRUE, 'first_run');
			datalist_set('admin_registered', 1);
			$registering_admin = true;
		} else {
			$registering_admin = false;
		}

		// Turn on email notifications by default
		set_user_notification_setting($user->getGUID(), 'email', true);

		$user->user_subtype = $user_subtype;
		return $user->getGUID();
	}

}

function re_validate_next_steps($user = FALSE, $current_step = FALSE) {
	if (register_exteps_can_this_step($user, $current_step) == FALSE) {
		register_exteps_gatekeeper();
	}
}

function register_exteps_can_this_step($user = FALSE, $current_step = FALSE) {

	$user = ProfileComplete::get_user_entity($user);

	if (!$user) {
		return FALSE;
	}

	$user_type = $user->getSubtype();
	if (empty($user)) {
		$user_type = US_USER;
	}

	if ($current_step == FALSE) {
		$current_step = get_input('tab');
	}

	$tabs = register_exteps_get_user_tab($user_type);
	$tabs_keys = array_keys($tabs);

	$user_next_step = $user->next_step;
	if ($user_next_step == 'go_home') {
		return TRUE;
	}

	if (!in_array($current_step, $tabs_keys)) {
		return FALSE;
	}


	$user_key = 0;
	$tab_key = 0;

	foreach ($tabs_keys as $key => $value) {
		if ($value == $user_next_step) {
			$user_key = $key;
		}

		if ($value == $current_step) {
			$tab_key = $key;
		}
	}

	if ($user_key < $tab_key) {
		return FALSE;
	}

	if ($user_key == $tab_key) {
		return -1;
	}

	return TRUE;
}

function kt_profile_get_years() {
	$current_year = date('Y');
	$to_year = $current_year - 150;

	$years = array();
	for ($current_year; $current_year >= $to_year; $current_year--) {
		$years[$current_year] = $current_year;
	}

	return $years;
}

function kt_profile_get_months() {

	$months = array();

	for ($i = 1; $i <= 12; $i++) {
		$tmp_i = $i;
		if ($i < 10) {
			$tmp_i = '0' . $i;
		}
		$months[$tmp_i] = $tmp_i;
	}

	return $months;
}

function kt_profile_get_days() {

	$days = array();

	for ($i = 1; $i <= 31; $i++) {
		$tmp_i = $i;
		if ($i < 10) {
			$tmp_i = '0' . $i;
		}
		$days[$tmp_i] = $tmp_i;
	}

	return $days;
}

function kt_register_gatekeeper() {
	$plugin_settings = trim(get_plugin_setting('open_registration', 'register_exteps'));

	$open_registration = FALSE;
	if (!empty($plugin_settings) && $plugin_settings == 'yes') {
		$open_registration = TRUE;
	}

	if ($open_registration == FALSE) {
		$params = array(
			'open_registration' => $open_registration
		);

		$validate_access = trigger_plugin_hook('register:gatekeeper', 'system', $params, FALSE);


		if ($validate_access == FALSE) {
			register_error(elgg_echo('register_exteps:no_access_registration'));
			forward();
		}
	}

	return TRUE;
}

function kt_retrieve_bdate_for_input($value = 0) {
	//The value should be yyyy-mm-dd
	$delimiter = '-';

	$bdate = array(
		'y' => 0,
		'm' => 0,
		'd' => 0,
	);

	if (!empty($value)) {
		$value = date('Y-m-d', $value);
		$tmp_bdate = explode($delimiter, $value);

		if (count($tmp_bdate) == 3) {
			$bdate = array(
				'y' => $tmp_bdate[0],
				'm' => $tmp_bdate[1],
				'd' => $tmp_bdate[2],
			);
		}
	}

	return $bdate;
}

function kt_profile_get_dni_types($is_pulldown = FALSE) {

	$dni_types = array(
		'CI' => 'CI',
		'DNI' => 'DNI',
		'LC' => 'LC',
		'LE' => 'LE',
	);

	if ($is_pulldown) {
		$dni_types = array('0' => elgg_echo('profile:tipo_documento:opciones')) + $dni_types;
	}

	return $dni_types;
}

function kt_validate_bdate($bdate) {
	$valid_bdate = FALSE;
	if (is_array($bdate)) {
		if (count($bdate) == 3) {
			$year = $bdate['y'];
			$month = $bdate['m'];
			$day = $bdate['d'];

			$valid_year = ($year > 0);
			$valid_month = (($month > 0) && ($month <= 12));
			$valid_day = (($day > 0) && ($day <= 31));

			if ($valid_day && $valid_month && $valid_year) {
				$valid_bdate = TRUE;
			}
		}
	}

	return $valid_bdate;
}

function kt_get_provincias_values() {
	global $CONFIG;

	$query = "SELECT * 
FROM  `provincias` 
LIMIT 0 , 9999;";

	$data = get_data($query);

	return $data;
}

function kt_generate_provincias_pulldown() {

	$provincias = kt_get_provincias_values();

	if (empty($provincias)) {
		return array();
	}

	$options = array();
	$options[0] = elgg_echo('profile:provincias:select_one');

	foreach ($provincias as $provincia) {
		$options[$provincia->id] = $provincia->provincia;
	}

	return $options;
}

function get_anunciantes_options() {
	$options = array();
	$anunciante_lang = elgg_echo('profile:anunciantes_select');
	$options[$anunciante_lang] = 1;
	//¿Es anunciante en Páginas Amarillas?
	return $options;
}

function get_preferencias_options($is_checkbox = FALSE) {
	$options = array(
		'Hoteles',
		'Turismo',
		'Empresas',
		'Descuentos',
	);

	if ($is_checkbox) {
		return array_flip($arrayarray);
	}

	return $options;
}

function kt_get_user_type($user = FALSE) {

	$user = ProfileComplete::get_user_entity($user);

	$user_type = US_USER;
	if ($user) {
		if ($user->user_subtype) {
			$user_type = $user->user_subtype;
		}
	}

	return $user_type;
}

function kt_set_user_type($user = FALSE, $value = US_USER) {

	$user = ProfileComplete::get_user_entity($user);

	if ($user) {

		switch ($value) {
			default:
				$user->user_subtype = US_USER;
				break;
		}
	}
}

function kt_get_sex_types($is_pulldown = FALSE) {
	$sex_types = array(
		'0' => elgg_echo("register_exteps:label:gender"),
		'M' => elgg_echo("register_exteps:label:gender:male"),
		'F' => elgg_echo("register_exteps:label:gender:female"),
		'O' => elgg_echo("register_exteps:label:gender:other"),
	);

	if ($is_pulldown == FALSE) {
		unset($sex_types[0]);
	}

	return $sex_types;
}

/**
 * Returns the private metanames that should not be shown in profile by another user
 * that have not privileges
 * 
 * @return array 
 */
function register_exteps_get_profile_private_metanames() {
	$private_metanames = array();

	return $private_metanames;
}

function process_dni_number($dni) {

	$dni = str_replace('.', '', $dni);
	$dni = str_replace('-', '', $dni);
	$dni = str_replace('_', '', $dni);
	$dni = str_replace(' ', '', $dni);

	if (is_numeric($dni) && !empty($dni) && strlen($dni) > 4) {
		return $dni;
	}

	return FALSE;
}

/**
 * wrapper for recursive array walk decoding
 */
function register_exteps_profile_array_decoder(&$v) {
	$v = html_entity_decode($v, ENT_COMPAT, 'UTF-8');
}