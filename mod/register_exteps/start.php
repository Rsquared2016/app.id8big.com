<?php

/**
 * register_exteps
 *
 * @author Bortoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
require_once(dirname(__FILE__) . '/lib/main.php');

define('US_USER', 'normal');
define('SHOW_USER_PROGRESS_WIDGET', FALSE);

function register_exteps_init() {

	if (elgg_is_logged_in()) {
		elgg_register_page_handler('register', 'exteps_register_page_handler');
	} else {
		elgg_register_plugin_hook_handler('route', 'register', 'register_exteps_root_register_hook');
	}

	elgg_extend_view('css/elgg', 'register_exteps/css');
	elgg_extend_view('register/after/extend', 'register_exteps/register/info');

	//Not used the register exteps register action.
	//register_action("register", TRUE, dirname(__FILE__) . "/actions/register_a.php");

	elgg_register_action("register/step/personal_information", dirname(__FILE__) . "/actions/personal_information_a.php");
	elgg_register_action("register/step/profile_icon", dirname(__FILE__) . "/actions/profile_icon_a.php");
//    register_action("register/step/professional_information", FALSE, dirname(__FILE__) . "/actions/professional_information_a.php");
//	elgg_register_action("profile/edit", dirname(__FILE__) . "/actions/profile/edit_a.php");
//	register_action("register/step/twitter_connect", FALSE, dirname(__FILE__) . "/actions/twitter_connect_a.php");
//	register_action("register/step/products/", FALSE, dirname(__FILE__) . "/actions/products_a.php");
//	register_action("register/step/guest_bartenders/", FALSE, dirname(__FILE__) . "/actions/guest_bartenders_a.php");


	elgg_register_event_handler('create', 'user', 'register_exteps_create_user_event', 500);
	//register_plugin_hook('register:gatekeeper', 'system', 'register_invite_code_hook');

	elgg_register_plugin_hook_handler('actionlist', 'captcha', 'register_captcha_actionlist_hook', 700);



	elgg_extend_view('page/elements/loggedin_block', 'register_exteps/widgets/first_steps');


	elgg_register_plugin_hook_handler('forward', 'system', 'register_exteps_forward_hook');
	if (elgg_is_logged_in() && !elgg_is_admin_logged_in()) {
//		register_exteps_gatekeeper();
		register_override_handlers();
	}

//    run_function_once('profile_generate_locations');

	elgg_register_plugin_hook_handler('index', 'system', 'register_exteps_welcome_site_login', 1);
}

//function profile_generate_locations() {
//    $scriptlocation = dirname(__FILE__) . '/scripts/localidades_mysql.sql';
//    run_sql_script($scriptlocation);
//}

function register_exteps_root_register_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'route');
	$check_type = ($type == 'register');

	if ($check_hook && $check_type) {
		include_once dirname(__FILE__) . '/pages/register/index_p.php';
		exit;
	}

	return $return;
}

function register_exteps_create_user_event($event, $object_type, $object) {

	//we get the input and then validate if is is correct

	$user_subtype = get_input('user_type', '');
	if ($user_subtype == US_USER) {
		$user_subtype = '';
	}

	$validate_event = ($event == 'create');
	$validate_object_type = ($object_type == 'user');
	$validate_object = ($object instanceof ElggUser);
	$validate_object_subtype = ($object->getSubtype() == $user_subtype);

	if ($validate_event && $validate_object_type && $validate_object && $validate_object_subtype) {
		$object->next_step = 'personal_information';
	} //end object validation
}

function register_exteps_forward_hook($hook, $type, $returnvalue, $params) {
	$check_hook = ($hook == 'forward');
	$check_type = ($type == 'system');

	if ($check_type && $check_hook) {
		$tab_url = get_input('skip_for_tab');

		if (get_input('kt_skeep_forward')) {
			return FALSE;
		}

		if ($tab_url) {
			return $tab_url;
		}

//		$tab = get_input('tab');
//
//		$action = get_input('action');
//		$is_step_action = FALSE;
//		if ($action) {
//			if (strstr($action, 'register/step/')) {
//				$is_step_action = TRUE;
//			}
//		}
//
//		if (elgg_is_logged_in() && !elgg_is_admin_logged_in() && $is_step_action == FALSE) {
//			$next_step = register_exteps_get_step_url();
//			if ($next_step) {
//				return $next_step;
//			}
//		}
	}
}

function exteps_elgg_register_page_handler($page) {
	//If no tab, go to personal information.
	$tab = strtolower(get_input('tab', 'personal_information'));

	/* if (!elgg_is_logged_in()) {
	  if ($tab == 'basic_information') {
	  set_input('tab', 'basic_information');
	  }
	  kt_register_gatekeeper();
	  } */

	if (!elgg_is_logged_in()) {
		register_error(elgg_echo('register_exteps:no_access_registration'));
		forward();
	}

	$user = ProfileComplete::get_user_entity();

	if ($user) {
		$user_type = $user->getSubtype();
		if (empty($user_type)) {
			$user_type = US_USER;
		}

		set_input('user_type', $user_type);

		if ($user->next_step == 'go_home') {
			$dev_mode = get_plugin_setting('dev_mode', 'register_exteps');

			if (empty($dev_mode)) {
				$dev_mode = 'no';
			}

			if (strtolower($dev_mode) == 'no') {
				forward();
			}
		}
	}
	!@include_once(dirname(__FILE__) . "/pages/register_p.php");
	return TRUE;
}

function register_exteps_setup() {
	
}

function exteps_register_page_handler($page) {
	//If no tab, go to personal information.
	$tab = strtolower(get_input('tab', 'personal_information'));
	
	/* if (!isloggedin()) {
	  if ($tab == 'basic_information') {
	  set_input('tab', 'basic_information');
	  }
	  kt_register_gatekeeper();
	  } */

	if (!elgg_is_logged_in()) {
		register_error(elgg_echo('register_exteps:no_access_registration'));
		forward();
	}

	$user = ProfileComplete::get_user_entity();
	
	if ($user) {
		$user_type = $user->getSubtype();
		if (empty($user_type)) {
			$user_type = US_USER;
		}

		set_input('user_type', $user_type);

		if ($user->next_step == 'go_home' && $user->start_using == 'yes') {
			$dev_mode = get_plugin_setting('dev_mode', 'register_exteps');

			if (empty($dev_mode)) {
				$dev_mode = 'no';
			}

			if (strtolower($dev_mode) == 'no') {
				forward();
			}
		}
	}
	!@include_once(dirname(__FILE__) . "/pages/register_p.php");
	return TRUE;
}

//
function register_override_handlers() {

	$user = elgg_get_logged_in_user_entity();
	$current_step = $user->next_step;
	
	if ($current_step != 'go_home' || $user->start_using == 'no') {
		global $CONFIG;
		$handlers = $CONFIG->pagehandler;

		if (!is_array($handlers)) {
			$handlers = array();
		}

		$allowed_handlers = array(
			'resetpassword',
			'login',
			'avatar',
			'avatar',
			'collections',
			'js',
			'css',
			'ajax',
			'admin',
			'admin_plugin_screenshot',
			'admin_plugin_text_file',
			'cron',
			'view',
			'livesearch',
			'tags',
			'about',
			'terms',
			'privacy',
			'expages',
			'notifications',
//			 'search',
			'images',
			'uservalidationbyemail',
			'kt_file',
			'register_exteps',
			'search_endpoint',
			'twitterservice',
			'external_login',
			'register_exteps',
			'meeting',
		);

		$custom_handler = 'exteps_register_page_handler';

		foreach ($handlers as $handlername => $handler) {
			if (!in_array($handlername, $allowed_handlers)) {
				$handlers[$handlername] = $custom_handler;
			}
		}

		$CONFIG->pagehandler = $handlers;
	}
}

/**
 * This function returns an array of actions the captcha will expect a captcha for, other plugins may
 * add their own to this list thereby extending the use.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function register_captcha_actionlist_hook($hook, $entity_type, $returnvalue, $params) {
	if ($hook == 'actionlist' && $entity_type == 'captcha') {
		if (!is_array($returnvalue)) {
			$returnvalue = array();
		}

		$register_action_key = array_search('register', $returnvalue);

		if ($register_action_key !== FALSE) {
			if (isset($returnvalue[$register_action_key])) {
				unset($returnvalue[$register_action_key]);
			}
		}

		return $returnvalue;
	}
}

function register_exteps_welcome_site_login($hook, $type, $return, $params) {

	$user = elgg_get_logged_in_user_entity();

	if ($user && (elgg_is_admin_logged_in() == FALSE)) {

		$profile_complete = new ProfileComplete($user);

		if ($profile_complete->isLoginStepIncomplete()) {
			//$profile_complete->forwardToStep(array('profile_image' => TRUE));
			$profile_complete->forwardToStep(array('personal_information' => TRUE));
		}
	}
}

elgg_register_event_handler('init', 'system', 'register_exteps_init', 900);
elgg_register_event_handler('pagesetup', 'system', 'register_exteps_setup');