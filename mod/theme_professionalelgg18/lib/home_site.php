<?php

/**
 * Home Site
 */

// Define Constants
//define('HOME_SITE_GRAPHICS', elgg_get_site_url() . 'mod/theme_professionalelgg18/home_site/graphics/');

elgg_register_event_handler('init', 'system', 'home_site_init');

function home_site_init() {
	
	// Plugin Hook
	elgg_register_plugin_hook_handler('index', 'system', 'home_site_index');
	
	// Extend Views
	elgg_extend_view('css/elgg', 'css/theme_professionalelgg/home_site');
	
	//Allow to display home page when is into "Restrict pages to logged-in users"
	elgg_register_plugin_hook_handler('public_pages', 'walled_garden', 'theme_public_pages');
	
	elgg_register_plugin_hook_handler('forward', 'system', 'home_site_logging_action_forwarding');
}

function theme_public_pages($hook, $type, $return, $params) {
	
	$return[] = 'login';
	
	$return[] = 'uservalidationbyemail/.*';
	$return[] = 'mod/' . THEME_NAME . '/graphics/.*';
	
	return $return;
}

function home_site_index($hook, $type, $return, $params) {
	
	if ($return == true) {
		// Another hook has already replaced the front page
		return $return;
	}

	$forward_to = ThemeSettings::getForwardHomePageInURL();
	if (elgg_is_logged_in() && $forward_to != elgg_get_site_url()) {
		forward($forward_to);
		return FALSE;
	}
	
	$to_include_path = elgg_get_plugins_path() . THEME_NAME . '/pages/home_site/';
	
	if (!include_once($to_include_path . 'index.php')) {
		return FALSE;
	}

	// Return true to signify that we have handled the front page
	return TRUE;
	
}


/**
 * Get the logged in url that system should forward
 * 
 * @param string $hook
 * @param string $type
 * @param string $return
 * @param array $params
 * @return string
 */
function home_site_logging_action_forwarding($hook, $type, $return, $params) {
	$action = get_input('action');
	
	if ($hook == 'forward' && $type == 'system' && $action == 'login' && elgg_is_logged_in()) {
		return ThemeSettings::getForwardLoggedInURL();
	}
}