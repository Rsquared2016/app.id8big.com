<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

//require_once(dirname(__FILE__) . '/vendors/plugin/plugin.php');
require_once(dirname(__FILE__) . '/lib/main.php');

function circles_init() {

	//Initializate the plugin
//	circles_initializateplugin();

	//Page Handler
	elgg_register_page_handler('circles', 'circles_page_handler');

	// Actions
	$action_path = dirname(__FILE__) . '/actions/circles/';
	elgg_register_action('circles/edit', $action_path . 'edit.php');
	elgg_register_action('circles/delete', $action_path . 'delete.php');
	
	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:filter', 'circles_register_menu_filter_hook');
	elgg_register_plugin_hook_handler('route', 'activity', 'circles_route_activity_hook');
	if (elgg_is_active_plugin('activity_share')) {
		elgg_register_plugin_hook_handler('route', 'dashboard', 'circles_route_activity_hook');
	}
    elgg_register_plugin_hook_handler('register', 'menu:page', 'circles_register_menu_page_hook');
	
	// Extend View
	elgg_extend_view('css/elgg', 'circles/css');
	elgg_extend_view('js/elgg', 'circles/js');
//	elgg_extend_view('riverdashboard/newestmembers', 'circles/block_dashboard', 501);
//	elgg_extend_view('core/river/sidebar', 'circles/block_dashboard');
	
	// Js
//	elgg_register_js('circles.fancybox.js', elgg_get_site_url() . 'mod/circles/vendors/fancybox/fancybox/jquery.fancybox-1.3.4.js');
	
	
	// Css
//	elgg_register_css('circles.fancybox.css', elgg_get_site_url() . 'mod/circles/vendors/fancybox/fancybox/jquery.fancybox-1.3.4.css');
	
	
}

function circles_page_handler($page) {
	
	// Load library
//	elgg_load_css('circles.fancybox.css');
//	elgg_load_js('circles.fancybox.js');
	elgg_load_css('lightbox');
	elgg_load_js('lightbox');
	
	// Page path
	$circles_page_path = dirname(__FILE__) . '/pages/circles/';
	$activity_page_path = dirname(__FILE__) . '/pages/activity/';

	switch ($page[0]) {
		case 'activity':
			$page_type = elgg_extract(1, $page, 'all');
			if ($page_type == 'owner') {
				$page_type = 'mine';
			}
			set_input('page_type', $page_type);
			include($activity_page_path . 'index.php');
			break;
		case 'searchfriends':
			include($circles_page_path . 'search.php');
			break;
		case 'new':
			include($circles_page_path . 'edit.php');
			break;
		case 'index':
		default:
			include($circles_page_path . 'index.php');
			break;
	}
	
	return true;
	
}

function circles_setup() {

	if (elgg_is_logged_in()) {
		elgg_register_menu_item('site', array(
			'name' => 'circles',
			'text' => elgg_echo('circles'),
			'href' => elgg_get_site_url() . 'circles/',
		));
	}
	
}

function circles_register_menu_filter_hook($hook, $type, $return, $params) {
	
	$context = elgg_get_context();
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:filter');
	$check_context = ($context == 'activity');
	
	if ($check_hook && $check_type && $check_context) {
		// Remove all tabs
		$return = array();
	}
	
	return $return;
	
}

function circles_route_activity_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'route');
	$check_type = ($type == 'activity' || $type == 'dashboard');
	$check_xhr = (elgg_is_xhr());
	
	if ($check_hook && $check_type && $check_xhr) {
		$segments = $return['segments'];
		$page_type = elgg_extract(0, $segments, 'all');
		
		$return['handler'] = 'circles';
		$return['segments'] =  array('activity', $page_type);
		
	}
	
	return $return;
	
}

function circles_register_menu_page_hook($hook, $type, $return, $params) {

    $check_hook = ($hook == 'register');
    $check_type = ($type == 'menu:page');

    if ($check_hook && $check_type) {
        foreach($return as $menu_item) {
            $name = $menu_item->getName();
            switch($name) {
                case 'friends':
                case 'friends:of':
                case 'import_contacts':
                case 'friends:view:collections':
                    $context = $menu_item->getContext();
                    array_push($context, 'circles');
                    $menu_item->setContext($context);
                    break;
            }
        }
        $user = elgg_get_logged_in_user_entity();
        if (elgg_instanceof($user, 'user') &&
            (elgg_in_context('friends') ||
             elgg_in_context('circles') ||
             elgg_in_context('members'))) {
            $return[] = ElggMenuItem::factory(array(
                'name' => 'friends:view:collections',
                'text' => elgg_echo('friends:collections'),
                'href' => "collections/$user->username",
            ));
        }
    }

    return $return;

}

elgg_register_event_handler('init', 'system', 'circles_init');
elgg_register_event_handler('pagesetup', 'system', 'circles_setup');