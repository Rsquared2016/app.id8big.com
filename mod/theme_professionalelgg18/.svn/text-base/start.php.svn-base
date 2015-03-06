<?php

/**
 * Theme init file
 *
 * @global type $CONFIG
 */
define('THEME_THREE_COLUMN_SUPPORT', TRUE);	// three column support
//define('THEME_FULL_WIDTH_SUPPORT', FALSE);	// full screen width support
//define('THEME_RESPONSIVE_SUPPORT', FALSE);	// enable / disable responsive layouts
//define('THEME_USE_DYNAMIC_MENU', FALSE);	// dynamic menu sizes
define('THEME_USE_DUMMIES', FALSE);			// dummy info for testing purpouses
define('THEME_USE_CSS_SINGLE_FILE', TRUE);			// Load all the theme css into a single css file instead fo extend css/elgg.

require_once(dirname(__FILE__) . '/lib/theme_functions.php');
require_once(dirname(__FILE__) . '/lib/home_site.php');
require_once(dirname(__FILE__) . '/lib/ajaxify.php');

if (is_theme_dummies_enabled()) {
    require_once(dirname(__FILE__) . '/lib/dummies_lib.php');
}

function theme_professionalelgg_theme_init() {

	global $CONFIG;

	/* Useful paths */
	$theme_full_dir_name = dirname(__FILE__).'/'; // Get the full dirname

	$theme_pathinfo = pathinfo($theme_full_dir_name);
	$theme_dir_name = $theme_pathinfo['basename'];

	/* Define theme graphics' URLs */
	define('THEME_NAME', $theme_dir_name);
	define('THEME_BASE', $CONFIG->url . "mod/$theme_dir_name/");
	define('THEME_ELGG_GRAPHICS', THEME_BASE . "_graphics/");
	define('THEME_GRAPHICS', THEME_BASE . "graphics/");
	define('THEME_GRAPHICS_CUSTOM', THEME_GRAPHICS . "custom/");
	define('THEME_ENDPOINT', $CONFIG->url . "mod/$theme_dir_name/endpoint/");
	define('THEME_VENDORS', THEME_BASE . "vendors/");
	define('THEME_PATH', $theme_full_dir_name);

	// full screen width support
	$full_width_support = theme_get_full_width_support();
	define('THEME_FULL_WIDTH_SUPPORT', $full_width_support);

	// enable / disable responsive layouts
	$responsive_support = theme_get_responsive_support();
	define('THEME_RESPONSIVE_SUPPORT', $responsive_support);

	 /* CSS FILE INDEPENDENT */
	if(THEME_USE_CSS_SINGLE_FILE) {
		define('THEME_CSS_TO_EXTEND', 'css/theme_professionalelgg');
		elgg_register_simplecache_view('css/theme_professionalelgg');
		elgg_register_css('theme_professionalelgg', elgg_get_simplecache_url('css', 'theme_professionalelgg'), 501);
		elgg_load_css('theme_professionalelgg');

		// Add custom setup for css/elgg.
		elgg_extend_view('css/elgg', 'css/theme_professionalelgg/setup', 100);		 	// theme main configuration CSS
	} else {
		define('THEME_CSS_TO_EXTEND', 'css/elgg'); //File to extend css.
	}

	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/setup', 100);		 	// theme main configuration CSS
	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/bootstrap');		  	// twitter bootstrap CSS
	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/custom');				// custom CSS
	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/user_mn_top');		  	// twitter style user menu CSS

	// plugins compatibility (fixes and adaptations to make them work with this theme)
	if(elgg_is_active_plugin('captcha')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/captcha');		  	// captcha
	}
	if(elgg_is_active_plugin('asearch')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/asearch');		  	// asearch / live search
	}
	if(elgg_is_active_plugin('groups')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/groups');		  	// groups
	}
	if(elgg_is_active_plugin('file')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/file');		  		// file
	}
	if(elgg_is_active_plugin('messageboard')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/messageboard');		// message board
	}
	if(elgg_is_active_plugin('tidypics')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/tidypics');			// tidypics
	}
	if(elgg_is_active_plugin('videolist')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/videolist');			// videolist
	}
	if(elgg_is_active_plugin('events')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/events');			// events
	}
	if(elgg_is_active_plugin('activity_share')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/activity_share');	// activity share / share on activity
	}
	if(elgg_is_active_plugin('profile_manager')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/profile_manager');	// profile manager
	}
	if(elgg_is_active_plugin('top_notifications')) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/mod_compatibility/top_notifications');	// top notifications
	}

	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/custom_responsive', 1000);				// responsive css
	elgg_extend_view('js/elgg', 'js/theme_responsive');												// responsive js
	elgg_extend_view('js/admin', 'js/theme_responsive');												// responsive js

	/*
	// menu type
	if (theme_get_use_dynamic_menu()) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/site_menu/dynamic');		  		// dynamic Sizes topbar menu
	} else {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/site_menu/static');		  		// static Sizes topbar menu
	}
	*/

	//elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/user_mn_top');		  												// twitter style user menu CSS

	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/slideshow');		  												// theme slideshow CSS

	elgg_register_css('qtip2.css', 'mod/' . THEME_NAME . '/vendors/qtip2/jquery.qtip.css');  									// qtip CSS
	elgg_load_css('qtip2.css');

	elgg_register_js('qtip2.js', 'mod/' . THEME_NAME . '/vendors/qtip2/jquery.qtip.min.js');
	elgg_load_js('qtip2.js');

	elgg_register_js('site_js.js', 'mod/' . THEME_NAME . '/vendors/theme_professionalelgg/site_js.js');							// Site JS
	elgg_load_js('site_js.js');

	elgg_register_js('elastic.js', 'mod/' . THEME_NAME . '/vendors/jquery_elastic/jquery.elastic.source.js');					// Elastic textareas
	elgg_load_js('elastic.js');

	elgg_register_js('selectivizr.js', 'mod/' . THEME_NAME . '/vendors/selectivizr/selectivizr-min.js');						// selectivizr, adds some useful CSS selectors support for IE
	elgg_load_js('selectivizr.js');

	elgg_register_js('hovercard_init.js', 'mod/' . THEME_NAME . '/vendors/hovercard/hovercard_init.js');

	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/qtip2/qtip_custom');				// custom qtip CSS
	elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/qtip2/hovercard');				// breadcrumb hovercard CSS

	// Register JS
	elgg_register_js('jquery', 'mod/' . THEME_NAME . '/vendors/jquery/jquery-1.7.2.min.js', 'head');	  // jquery
	elgg_register_js('theme.crop.js', 'mod/' . THEME_NAME . '/vendors/jcrop/js/jquery.Jcrop.min.js');		// avatar image crop
	elgg_register_js('elgg.friendspicker', 'mod/' . THEME_NAME . '/vendors/js/lib/ui.friends_picker.js');	 // modified friends picker

	elgg_register_js('twitter.bootstrap', 'mod/' . THEME_NAME . '/vendors/twitter_bootstrap/bootstrap.min.js');	// twitter bootstrap js
	elgg_load_js('twitter.bootstrap');

	elgg_register_css('theme.crop.css', 'mod/' . THEME_NAME . '/vendors/jcrop/css/jquery.Jcrop.css');	  // crop CSS

	// Admin menu settings
	elgg_register_admin_menu_item('configure', 'theme_professional', 'appearance', 901);
	elgg_register_action('theme_professionalelgg18/style', dirname(__FILE__) . '/actions/theme_professionalelgg18/settings/style.php', 'admin');
	elgg_register_action('theme_professionalelgg18/settings', dirname(__FILE__) . '/actions/theme_professionalelgg18/settings/settings.php', 'admin');
	elgg_register_action('theme_professionalelgg18/site_forwarding', dirname(__FILE__) . '/actions/theme_professionalelgg18/settings/site_forwarding.php', 'admin');
	elgg_register_action('theme_professionalelgg18/ping', dirname(__FILE__) . '/actions/theme_professionalelgg18/settings/ping.php', 'admin');
	elgg_register_action('theme_professionalelgg18/home', dirname(__FILE__) . '/actions/theme_professionalelgg18/settings/home.php', "admin");
	elgg_register_action('theme_professionalelgg18/header_footer', dirname(__FILE__) . '/actions/theme_professionalelgg18/settings/header_footer.php', "admin");

	elgg_extend_view('css/admin', 'css/theme_professionalelgg/setup', 100);		 	// theme main configuration CSS
	elgg_extend_view('css/admin', 'css/theme_professionalelgg/admin');				// Admin extend custom css.

	// Color Picker.
	elgg_register_css('colorpicker', 'mod/' . THEME_NAME . '/vendors/colorpicker/css/colorpicker.css');	 // color picker css
	elgg_register_js('colorpicker', 'mod/' . THEME_NAME . '/vendors/colorpicker/js/colorpicker.js');	  // color picker js
	elgg_register_js('colorpicker_eye', 'mod/' . THEME_NAME . '/vendors/colorpicker/js/eye.js');			// color picker eye js

	elgg_extend_view("css/elgg", "css/profile/details");

	elgg_register_action('avatar/crop', dirname(__FILE__).'/actions/avatar/crop.php');

	// Show add/remove friend button
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'theme_users_setup_entity_menu', 502);
	elgg_register_plugin_hook_handler('register', 'menu:user_top_menu', 'theme_user_top_menu_initialize');

	// des-extiendo la vista del search para colocarla en la vista nueva de la top bar.
	elgg_unextend_view('page/elements/header', 'search/header');

	// Custom Profile Groups
	elgg_register_plugin_hook_handler('view', 'navigation/menu/default', 'theme_view_navigation_menu_default_hook');
	if (theme_get_use_widgets_profile_groups_as_tabs()) {
		elgg_register_plugin_hook_handler('view', 'groups/profile/widgets', 'theme_view_groups_profile_widgets_hook');
		elgg_register_plugin_hook_handler('view', 'page/components/module', 'theme_view_page_components_module_hook');
		elgg_register_plugin_hook_handler('view', 'groups/profile/module', 'theme_view_groups_profile_module_hook');
		elgg_register_plugin_hook_handler('view', 'discussion/group_module', 'theme_view_discussion_group_module_hook');
		elgg_register_plugin_hook_handler('forward', 'system', 'theme_forward_system_hook');
		elgg_register_plugin_hook_handler('action', 'discussion/save', 'theme_action_discussion_save_hook');
	}


}

/**
 * Verify if the dummie is enabled, via constant and added future integration with theme settings.
 *
 * @return boolean
 */
function is_theme_dummies_enabled() {
    $enable_dummies = elgg_get_plugin_setting('theme_dummies');

    switch($enable_dummies) {
	case 'yes':
	    return TRUE;
	    break;
	case 'no':
	    return FALSE;
	    break;
	default:
	    return THEME_USE_DUMMIES;
	    break;
    }
}

/**
 * Show add/remove friend button
 *
 * @return array
 * @access private
 */
function theme_users_setup_entity_menu($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	if (!elgg_instanceof($entity, 'user')) {
		return $return;
	}
	//KTODO: Definir donde ubicar el campo location. Se esta ocultando definiendo return array nuevamente.
	$return = array();
	$user = $entity;

	if ($user->location) {
		$options = array(
			'name' => 'user_location',
			'text' => $user->location,
			'href' => false,
			'priority' => 100,
		);
		$return[] = ElggMenuItem::factory($options);
	}
	return $return;
}

/**
 * Get the current body class for theme
 *
 * @global mix $CONFIG
 * @return string
 */
function theme_body_class() {
	global $CONFIG;
	$class = array();

	$class[] = 'body' . ucwords(elgg_get_context());
	$current_page_url = current_page_url();

	//Clean the query string from URL
	if (strpos($current_page_url,'?') > 0) {
		$current_page_url = substr( $current_page_url, 0, strpos($current_page_url,'?'));
	}

	if ($current_page_url == $CONFIG->url) {
		$class[] = 'bodyHome';
	}

	if (elgg_is_logged_in()) {
		$class[] = 'isLoggedIn';
	}
	if (elgg_is_admin_logged_in()) {
		$class[] = 'bodyIsAdmin';
	}
	if (elgg_is_logged_in()) {
		$class[] = 'isLoggedIn';
	}
	if (THEME_RESPONSIVE_SUPPORT) {
		$class[] = 'isResponsive';
	}

	$owner = elgg_get_page_owner_entity();
	if ($owner) {
		$class[] = 'body' . ucwords($owner->getType());
		if ($owner->getSubtype()) {
			$class[] = 'body' . ucwords($owner->getSubtype());
		}
	}

	$theme_body_class = get_input('theme_body_class', '');
	if ($theme_body_class) {
		$class[] = $theme_body_class;
	}
	return implode(' ', $class);
}

// custom page handler for members' section
function keetup_members_page_handler($page) {
	$base = elgg_get_plugins_path() . THEME_NAME . '/pages/members';

	if (!isset($page[0])) {
		$page[0] = 'newest';
	}

	$vars = array();
	$vars['page'] = $page[0];

	if ($page[0] == 'search') {
		$vars['search_type'] = $page[1];
		require_once "$base/search.php";
	} else {
		require_once "$base/index.php";
	}
	return true;
}


function theme_user_top_menu_initialize($hook, $type, $return, $params) {

    $user = elgg_get_logged_in_user_entity();

    if ($user instanceof ElggUser) {
		$usr_icon = $user->getIconURL('tiny');
		$usr_name = $user->username;
		$usr_url = $user->getURL();
		$usr_username = $user->username;

		if (empty($usr_name)) {
		    $usr_name = $usr_username;
		}
    }
    else {
		return array();
    }

    $return[] = ElggMenuItem::factory(array(
		"name" => 'top_username',
		"text" => $usr_name,
		"href" => FALSE,
		"item_class" => "usrNameLi",
		"title" => "{$usr_name}",
		'priority' => 1,
	    ));

	$return[] = ElggMenuItem::factory(array(
		"name" => 'top_profile',
		"text" => elgg_echo('user:menu:profile'),
		"href" => "profile/{$usr_username}",
		"item_class" => "",
		"title" => elgg_echo('user:menu:profile'),
		'priority' => 50,
	    ));

    $return[] = ElggMenuItem::factory(array(
		"name" => 'top_settings',
		"text" => elgg_echo('user:menu:settings'),
		"href" => "settings/user/{$usr_name}",
		"item_class" => "",
		"title" => elgg_echo('user:menu:settings'),
		'priority' => 100,
	    ));

    if ($user->isAdmin()) {
		$return[] = ElggMenuItem::factory(array(
			    "name" => 'top_admin_menu',
			    "text" => elgg_echo('user:menu:administration'),
			    "href" => 'admin',
			    "item_class" => "",
			    "title" => elgg_echo('user:menu:administration'),
			    'priority' => 500,
		));
    }
    $return[] = ElggMenuItem::factory(array(
		"name" => 'top_action_logout',
		"text" => elgg_echo('user:menu:logout'),
		"href" => 'action/logout',
		"item_class" => "nb",
		"title" => elgg_echo('user:menu:logout'),
		'priority' => 1000,
	    ));
    return $return;
}

/**
 * Hook para modificar la visualizacion de menu title en el perfil de grupos
 * Las opciones se muestran en un dropdown, si se tienen mas de dos
 */
function theme_view_navigation_menu_default_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_type = ($type == 'navigation/menu/default');

	if ($check_hook && $check_type) {
		$group = elgg_get_page_owner_entity();

		// Get page
		$handler = get_input('handler');
		$page = get_input('page');
		$page_array = explode('/', $page);
		$is_profile = FALSE;
		if (is_array($page_array) && isset($page_array[0]) && $page_array[0] == 'profile' && $handler == 'groups') {
			$is_profile = TRUE;
		}

		$is_title = false;
		if (isset($params['vars']) && isset($params['vars']['name']) && $params['vars']['name'] == 'title') {
			$is_title = true;
		}

		if (elgg_instanceof($group, 'group') && $is_profile && $is_title) {
			$params['vars'] = array_merge($params['vars'], array('entity' => $group));
			$return = elgg_view('groups_custom/navigation/menu/default', $params['vars']);
		}
	}

	return $return;

}

/**
 * Hook para reemplazar los widgets del perfil de grupos como tabs
 */
function theme_view_groups_profile_widgets_hook($hook, $view_type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_view_type = ($view_type == 'groups/profile/widgets');

	if ($check_hook && $check_view_type) {
		$vars = $params['vars'];

		$vars = array_merge($vars, array('profile_content' => $return));

		$content = elgg_view('groups_custom/groups/profile/tabs', $vars);

		return $content;
	}
}

/**
 * Hook para reemplazar el modo en que se visaulizan los widget del perfil de grupos
 */
function theme_view_groups_profile_module_hook($hook, $view_type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_view_type = ($view_type == 'groups/profile/module');

	if ($check_hook && $check_view_type) {
		$profile_groups_tabs = get_input('profile_groups_tabs', false);
		if ($profile_groups_tabs) {
			$return = elgg_view('groups_custom/groups/profile/module', $params['vars']);
		}
	}

	return $return;

}

/**
 * Hook para reemplazar el modo en que se visaulizan los widget del perfil de grupos
 */
function theme_view_page_components_module_hook($hook, $view_type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_view_type = ($view_type == 'page/components/module');

	if ($check_hook && $check_view_type) {
		$profile_groups_tabs = get_input('profile_groups_tabs', false);
		if ($profile_groups_tabs) {
			$return = elgg_view('groups_custom/page/components/module', $params['vars']);
		}
	}

	return $return;
}

function theme_view_discussion_group_module_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_type = ($type == 'discussion/group_module');

	if ($check_hook && $check_type) {
		$group = elgg_get_page_owner_entity();

		// Get page
		$handler = get_input('handler');
		$page = get_input('page');
		$page_array = explode('/', $page);
		$is_profile = FALSE;
		if (is_array($page_array) && isset($page_array[0]) && $page_array[0] == 'profile' && $handler == 'groups') {
			$is_profile = TRUE;
		}

		if (elgg_instanceof($group, 'group') && $is_profile) {
			if ($group->canWriteToContainer() && $group->forum_enable == 'yes') {
				$form = elgg_view('groups_custom/forms/discussion', $params['vars']);
				$return = $form . $return;
			}
		}
	}

	return $return;

}

function theme_forward_system_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'forward');
	$check_type = ($type == 'system');

	if ($check_hook && $check_type) {
		$action = get_input('action');
		$profile_group = get_input('profile_group', 0);
		if ($action == 'discussion/save' && $profile_group) {
			$container_guid = get_input('container_guid');
			$group = get_entity($container_guid);
			if (elgg_instanceof($group, 'group')) {
				$return = $group->getURL() . '?filter=forum';
			}
		}
	}

	return $return;

}

function theme_action_discussion_save_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'action');
	$check_type = ($type == 'discussion/save');

	if ($check_hook && $check_type) {
		$profile_group = get_input("profile_group");
		$desc = get_input("description");

		if ($profile_group) {
			if (!$desc) {
				elgg_make_sticky_form('topic');

				register_error(elgg_echo('theme:groups:discussion:error'));
				$return = false;
			}
			else {
				$title = substr($desc, 0, 50);
				$title = strip_tags($title);
                $title = html_entity_decode($title);
				set_input('title', $title);
			}
		}
	}

	return $return;

}

/**
 * Return the version of the module
 *
 * @param bool $humanreadable
 * @return string
 */
function theme_professionalelgg_get_version($humanreadable = FALSE) {
	$path = dirname(__FILE__) . '/';

	$version = '';
	$release = '';

	if (!include($path . "version.php")) {
		return false;
	}

	return (!$humanreadable) ? $version : $release;
}

/**
 * Add retro compatibility with previous proyects themes
 */
function theme_professionalelgg_page_setup() {

	$setup_view = 'css/theme_professionalelgg/setup';
	$view_location = elgg_get_view_location($setup_view);
	if(strpos($view_location, THEME_NAME) === FALSE) {
		elgg_extend_view(THEME_CSS_TO_EXTEND, 'css/theme_professionalelgg/setup_prepend', 50); // theme main configuration CSS
	}

}

elgg_register_event_handler('init', 'system', 'theme_professionalelgg_theme_init');
elgg_register_event_handler('pagesetup', 'system', 'theme_professionalelgg_page_setup');
