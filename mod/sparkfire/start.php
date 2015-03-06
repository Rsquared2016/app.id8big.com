<?php
/**
* sparkfire
*
* @author Emanuel Kling
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

define('THEME_GRAPHICS_CUSTOM_SITE', elgg_get_site_url().'mod/sparkfire/graphics/');

//require_once(dirname(__FILE__) . '/vendors/plugin/plugin.php');
require_once(dirname(__FILE__) . '/lib/main.php');

function sparkfire_init() {

	// ultimo paso register steps
	//elgg_get_logged_in_user_entity()->start_using = 'no';

	//Initializate the plugin
	//sparkfire_initializateplugin();

	//Page Handler
	//elgg_register_page_handler('sparkfire','sparkfire_page_handler');
	//Register the cutsom site js.
	elgg_register_simplecache_view('js/sparkfire');
	$sparkfire_js_url = elgg_get_simplecache_url('js', 'sparkfire');
	elgg_register_js('sparkfire', $sparkfire_js_url);
	elgg_load_js('sparkfire');

	//Register some actions
	$action_path = elgg_get_plugins_path() . 'sparkfire/actions/';
	elgg_register_action('profile/inline_edit', "$action_path/profile/inline_edit.php");
	elgg_register_action('profile/edit', "$action_path/profile/profile_edit.php");
    
    elgg_register_action('register', "$action_path/user/register.php", 'public');


	/* CSS */
	//elgg_extend_view('css/elgg', 'css/custom_site/custom', 9999);		// theme main configuration CSS
	 /* CSS FILE INDEPENDENT */
	 elgg_extend_view('css/custom_site/custom', 'css/theme_professionalelgg/setup', 400);
	 elgg_register_simplecache_view('css/custom_site/custom');
	 $theme_custom_css = elgg_get_simplecache_url('css', 'custom_site/custom');
	 elgg_register_css('theme_custom', $theme_custom_css, 900);

	//User sidebar options.
//	elgg_extend_view('theme_elements/sidebar_extras', 'page/elements/user_sidebar');

	elgg_register_simplecache_view('js/jeditable');
	$jeditable_js_url = elgg_get_simplecache_url('js', 'jeditable');
	elgg_register_js('jeditable', $jeditable_js_url);

//	elgg_register_js('jeditable', '/mod/sparkfire/vendors/jeditable/jquery.jeditable.js'); //Normal js
//	elgg_register_js('jeditable.autogrow', '/mod/sparkfire/vendors/jeditable/jquery.jeditable.autogrow.js'); //Normal js
//	elgg_register_js('jquery.autogrow', '/mod/sparkfire/vendors/jeditable/js/jquery.autogrow.js'); //Normal js

	elgg_load_js('jeditable');
//	elgg_load_js('jeditable.autogrow');
//	elgg_load_js('jquery.autogrow');


	//Fields setup
	elgg_register_plugin_hook_handler('profile:fields', 'profile', 'sparkfire_profile_fields');
	elgg_register_plugin_hook_handler('action', 'profile/edit', 'sparkfire_profile_edit_fields');

	//Check in main lib.
	elgg_register_plugin_hook_handler('register_exteps', 'get:user:fields', 'sparkfire_register_exteps_fields');
	elgg_register_plugin_hook_handler('register_exteps', 'get:required:fields', 'sparkfire_register_exteps_req_fields');
    elgg_register_plugin_hook_handler('theme:right:sidebar:widgets', 'activity', 'sparkfire_theme_right_sidebar_widgets_activity_hook');
	elgg_register_plugin_hook_handler('view', 'groups_custom/groups/profile/tabs', 'sparkfire_view_groups_custom_groups_profile_tabs_hook');
//	elgg_register_plugin_hook_handler('view', 'groups_custom/groups/profile/module', 'sparkfire_view_groups_custom_groups_profile_module_hook');

    //user hover menu
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'sparkfire_user_entity_menu_setup');
	elgg_register_plugin_hook_handler('register', 'menu:page', 'sparkfire_register_menu_page_hook');

	//Agenda activity widget.
	elgg_register_ajax_view('agenda/widget');		
	
    //user hover menu
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'sparkfire_user_entity_menu_setup');
	elgg_register_plugin_hook_handler('config', 'htmlawed', 'sparkfire_config_htmlawed_hook');
    elgg_register_plugin_hook_handler('view', 'input/access', 'sparkfire_override_input_access_view');
    elgg_register_plugin_hook_handler('view', 'input/write_access', 'sparkfire_override_input_write_access_view');
}

function sparkfire_profile_fields($hook, $type, $returnvalue, $params) {
	$profile_sparkfire = array (
		'looking_for' => 'plaintext',
		'how_i_can_help' => 'plaintext',
		'what_i_have_done' => 'plaintext'
	);

	if(is_array($returnvalue)) {
		$returnvalue = array_merge($returnvalue, $profile_sparkfire);
	}

	return $returnvalue;

}

function sparkfire_page_handler($page) {

}

function sparkfire_setup() {
	if (!elgg_in_context('admin')) {
		 elgg_load_css('theme_custom');
	}
	
	if (elgg_in_context('activity')) {    
		elgg_extend_view('navigation/menu/extras', 'agenda/widget', 400);
	}
	
}

function sparkfire_view_groups_custom_groups_profile_tabs_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_type = ($type == 'groups_custom/groups/profile/tabs');

	if ($check_hook && $check_type) {
		if (isset($params['vars'])) {
			$vars = $params['vars'];
			$entity = $vars['entity'];

			if (elgg_instanceof($entity, 'group', 'project')) {
				$return = elgg_view('sparkfire/groups_custom/groups/profile/tabs', $vars);
			}
		}
	}

	return $return;

}

function sparkfire_view_groups_custom_groups_profile_module_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_type = ($type == 'groups_custom/groups/profile/module');

	if ($check_hook && $check_type) {
		$profile_groups_tabs = get_input('profile_groups_tabs', false);
		if ($profile_groups_tabs) {
			$return = elgg_view('sparkfire/groups_custom/groups/profile/module', $params['vars']);
		}
	}

	return $return;

}

/**
 * Add a remove user link to user hover menu
 */
function sparkfire_user_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		$entity = $params['entity'];
		// Check for valid user
		if (!elgg_instanceof($entity, 'user')) {
			return $return;
		}

			$options = array(
				'name' => 'friends',
                'href' => "friends/{$entity->username}",
				'text' => elgg_echo('friends'),
				'priority' => 999,
			);
			$return[] = ElggMenuItem::factory($options);

			$options = array(
				'href' => "friendsof/{$entity->username}",
				'name' => 'friends:of',
				'text' => elgg_echo('friends:of'),
				'priority' => 999,
			);
			$return[] = ElggMenuItem::factory($options);

	}

	return $return;
}

function sparkfire_config_htmlawed_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'config');
	$check_type = ($type == 'htmlawed');
	
	if ($check_hook && $check_type) {
		if (array_key_exists('safe', $return)) {
			$return['safe'] = FALSE;
		}
	}
	
	return $return;
	
}

function sparkfire_theme_right_sidebar_widgets_activity_hook($hook, $type, $return, $params) {

    $check_hook = ($hook == 'theme:right:sidebar:widgets');
    $check_type = ($type == 'activity');

    if ($check_hook && $check_type) {
        if (isset($return['groups'])) {
            unset($return['groups']);
        }
        if (isset($return['members'])) {
            unset($return['members']);
        }
    }

    return $return;

}

function sparkfire_override_input_access_view($hook, $type, $return, $params) {
	$view = elgg_extract('view', $params);
	$vars = elgg_extract('vars', $params);
	$viewtype = elgg_extract('viewtype', $params);
	
	$handler = get_input('handler');
	
	if ($view == 'input/access' && $viewtype == 'default' && $handler != 'groups') {
		$container_entity = elgg_get_page_owner_entity();
		if (($container_entity instanceof ElggGroup) && !($container_entity instanceof ProjectGroup)) {
			$vars['entity'] = $container_entity;
			return elgg_view('input/group_container_access', $vars);
		}
	}
	
	return $return;
	
}

function sparkfire_override_input_write_access_view($hook, $type, $return, $params) {
	$view = elgg_extract('view', $params);
	$vars = elgg_extract('vars', $params);
	$viewtype = elgg_extract('viewtype', $params);
	
	$handler = get_input('handler');
	
	if ($view == 'input/write_access' && $viewtype == 'default' && $handler != 'groups') {
		$container_entity = elgg_get_page_owner_entity();
		if (($container_entity instanceof ElggGroup) && ($container_entity instanceof ProjectGroup)) {
			$vars['entity'] = $container_entity;
			return elgg_view('input/group_container_write_access', $vars);
		}
	}
	
	return $return;
	
}

function sparkfire_register_menu_page_hook($hook, $type, $return, $params) {

    $check_hook = ($hook == 'register');
    $check_type = ($type == 'menu:page');

    if ($check_hook && $check_type) {
        foreach ($return as $key => $menu_item) {
            $name = $menu_item->getName();
            switch ($name) {
                case 'friends:view:collections':
                case 'import_contacts':
                    $context = $menu_item->getContext();
                    array_push($context, 'members');
                    $menu_item->setContext($context);
                    break;
            }
        }
        $user = elgg_get_logged_in_user_entity();
        if (elgg_instanceof($user, 'user')) {
            $return[] = ElggMenuItem::factory(array(
                'name' => 'friends',
                'text' => elgg_echo('friends'),
                'href' => 'friends/' . $user->username,
                'contexts' => array('friends', 'members')
            ));
            $return[] = ElggMenuItem::factory(array(
                'name' => 'friends:of',
                'text' => elgg_echo('friends:of'),
                'href' => 'friendsof/' . $user->username,
                'contexts' => array('friends', 'members')
            ));
        }
    }

    return $return;

}

elgg_register_event_handler('init', 'system', 'sparkfire_init');
elgg_register_event_handler('pagesetup', 'system', 'sparkfire_setup');
