<?php

/**
 * top_notifications
 *
 * @author German Scarel
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
//require_once(dirname(__FILE__) . '/vendors/plugin/plugin.php');
require_once(dirname(__FILE__) . '/lib/main.php');

define('TOP_NOTIFICATIONS_NOTIFICATIONS_ENABLED', true);
define('TOP_NOTIFICATIONS_MESSAGES_ENABLED', true);
define('TOP_NOTIFICATIONS_FRIEND_REQUIEST_ENABLED', true);

function top_notifications_init() {
	
	//Page Handler
	elgg_register_page_handler('top_notifications', 'top_notifications_page_handler');
	
	// Hooks
	elgg_register_plugin_hook_handler('public_pages', 'walled_garden', 'top_notifications_walled_garden');
	elgg_register_plugin_hook_handler('register', 'menu:topbar', 'top_notifications_register_menu_topbar_hook');
	
	//Elgg header extend
	if (elgg_is_active_plugin('theme_professionalelgg18')) {
		elgg_extend_view('page/elements/top_notif_extend', 'top_notifications/elgg_header_extend', 1000);
	} else {
		elgg_extend_view('page/elements/topbar', 'top_notifications/elgg_header_extend', 1000);
	}

	//Css
	elgg_extend_view('css/elgg', 'top_notifications/css');

	//Js
	elgg_extend_view('js/elgg', 'top_notifications/js');
	
	// Notifications
	elgg_register_event_handler('create', 'friend', 'top_notifications_event_handler_notifications');
	elgg_register_event_handler('create', 'annotation', 'top_notifications_event_handler_notifications');
	elgg_register_event_handler('create', 'phototag', 'top_notifications_event_handler_notifications');
	elgg_register_plugin_hook_handler('creating', 'river', 'top_notifications_creating_river_hook');

	// Run function once
	run_function_once('build_notifications_table');
	
}

/**
 * 	Event handler notifications
 * 
 * When $object is
 * 	- ElggRelationship:	$type_notification = $object_type
 *  - ElggAnnotation:	$type_notification = $object->name
 *  - Elgg..
 */
function top_notifications_event_handler_notifications($event, $object_type, $object) {

	//Check event
	$check_event = ($event == 'create');

	// Get notification name
	$notification_name = FALSE;
	if ($object instanceof ElggRelationship) {
		$notification_name = $object_type;
	} elseif ($object instanceof ElggAnnotation) {
		$notification_name = $object->name;
	}

	if ($check_event && $notification_name) {
		$data = array();
		switch ($notification_name) {
			case 'attend':
				// Invitation to event...
				$data = top_notifications_get_data_to_attend($object);
				break;
			case 'likes':
				// i like the content...
				$data = top_notifications_get_data_to_like($object);
				break;
			case 'phototag':
				// Tagged in a photo...
				$data = top_notifications_get_data_to_phototag($object);
				break;
			case 'generic_comment':
				$data = top_notifications_get_data_to_generic_comment($object);
				break;
			case 'friend':
				// Only notifies you when a user accepts a friend request
				if (elgg_is_active_plugin('friend_request')) {
					$data = top_notifications_get_data_to_friend($object);
				}
				break;
			default:
				// Nothing...
				break;
		}

		$default_data = array(
			'view' => '',
			'action_type' => $notification_name,
			'subject_guid' => 0,
			'object_guid' => 0,
			'access_id' => "",
			'posted' => 0,
			'annotation_id' => 0,
		);
		if (!empty($data) && is_array($data)) {
			$default_data = array_merge($default_data, $data);
		}

		if ($default_data['subject_guid'] != elgg_get_logged_in_user_guid()) {
			if (!is_array($default_data['subject_guid'])) {
				$default_data['subject_guid'] = array($default_data['subject_guid']);
			}
			foreach ($default_data['subject_guid'] as $subject_guid) {
				top_notifications_add_to_notifications(
						$default_data['view'], $default_data['action_type'], $subject_guid, $default_data['object_guid'], $default_data['access_id'], $default_data['posted'], $default_data['annotation_id']);
			}
		}
	}
}

/**
 * top_notifications_creating_river_hook
 * 
 * This hook is released to capture the creation of a river of friendship that makes the friend request to approve a friendship
 */
function top_notifications_creating_river_hook($hook, $object_type, $returnvalue, $params) {

	$action = get_input('action', '');

	$check_hook = ($hook == 'creating');
	$check_object_type = ($object_type == 'river');
	$check_action = ($action == 'friend_request/approve');

	if ($check_hook && $check_object_type && $check_action) {
		$event = 'create';
		$object_type = 'friend';

		$object = check_entity_relationship($returnvalue['subject_guid'], 'friend', $returnvalue['object_guid']);

		// Pass stdClass to ElggRelationship
		$object = row_to_elggrelationship($object);

		top_notifications_event_handler_notifications($event, $object_type, $object);
	}
}

function top_notifications_page_handler($page) {

	if (isset($page[0])) {
		switch ($page[0]) {
			case "notifications":
				!@include_once(dirname(__FILE__) . "/pages/notifications_p.php");
				return false;
				break;
			case "admin":
				!@include_once(dirname(__FILE__) . "/pages/admin_p.php");
				return false;
				break;
			default:
				return false;
		}
	}
}

function top_notifications_walled_garden($hook, $type, $return, $params) {

	$return[] = 'mod/top_notifications/endpoint/.*';

	return $return;
}

//function top_notifications_setup() {
//	global $CONFIG;
//	if (get_context()=='admin') {
//    	add_submenu_item(elgg_echo("top_notifications:admin"), $CONFIG->wwwroot . "top_notifications/admin" );
//	}
//}

function top_notifications_register_menu_topbar_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:topbar');
	$is_active_theme = (elgg_is_active_plugin('theme_professionalelgg18'));
	
	if ($check_hook && $check_type && !$is_active_theme) {
		if (is_array($return)) {
			foreach($return as $key => $item) {
				$name = $item->getName();
				if ($name == 'messages') {
					unset($return[$key]);
				}
				if ($name == 'friends' && elgg_is_active_plugin('friend_request')) {
					unset($return[$key]);
				}
			}
		}
	}
	
	return $return;
	
}

elgg_register_event_handler('init', 'system', 'top_notifications_init');
//elgg_register_event_handler('pagesetup','system','top_notifications_setup');