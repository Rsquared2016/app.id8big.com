<?php

/**
 * GCalendar
 */

// Require
//$vendors = elgg_get_plugins_path() . 'gcalendar/vendors/';
//require_once($vendors . 'google/Google_Client.php');
//require_once($vendors . 'google/contrib/Google_Oauth2Service.php');
//require_once($vendors . 'google/contrib/Google_CalendarService.php');

define('GCALENDAR_SYNC', 'gcalendar_sync');
define('GCALENDAR_CALENDAR_ID', 'calendar_id');

elgg_register_event_handler('init', 'system', 'gcalendar_init');

/**
 * GCalendar: Init
 */
function gcalendar_init() {
	
	// Library
	$vendors = elgg_get_plugins_path() . 'gcalendar/vendors/';
	if (!elgg_is_active_plugin('gdrive')) {
		elgg_register_library('google:client', $vendors . 'google/Google_Client.php');
		elgg_register_library('google:oauth2service', $vendors . 'google/contrib/Google_Oauth2Service.php');
	}
	elgg_register_library('google:calendarservice', $vendors . 'google/contrib/Google_CalendarService.php');
	if (!elgg_is_active_plugin('gdrive')) {
		elgg_load_library('google:client');
		elgg_load_library('google:oauth2service');
	}
	elgg_load_library('google:calendarservice');
	
	// Page Handler
	elgg_register_page_handler('gcalendar', 'gcalendar_page_handler');
	
	// Extend Views
	elgg_extend_view('js/elgg', 'gcalendar/js');
	elgg_extend_view('css/elgg', 'gcalendar/css');
    $page = get_input('page');
    if (elgg_in_context('events') && $page == 'calendar') {
        elgg_extend_view('navigation/menu/extras', 'gcalendar/widgets/calendars');
    }
	
	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:page', 'gcalendar_title_menu');
	
	// Events
	elgg_register_event_handler('gcalendar', 'create', 'gcalendar_gcalendar_create_event');
	elgg_register_event_handler('create', 'collaborator', 'gcalendar_create_collaborator_visitor_event');
	elgg_register_event_handler('delete', 'collaborator', 'gcalendar_delete_collaborator_visitor_event');
	elgg_register_event_handler('create', 'visitor', 'gcalendar_create_collaborator_visitor_event');
	elgg_register_event_handler('delete', 'visitor', 'gcalendar_delete_collaborator_visitor_event');
	
	// Actions
	elgg_register_action('gcalendar/sync', dirname(__FILE__) . '/actions/gcalendar/sync_a.php');
	elgg_register_action('gcalendar/import', dirname(__FILE__) . '/actions/gcalendar/import_a.php');
	elgg_register_action('gcalendar/delete', dirname(__FILE__) . '/actions/gcalendar/delete_a.php');
    
    // Register entity
	elgg_register_entity_type('object', 'gcalendar');
    add_subtype('object', 'gcalendar', 'GCalendar');
	
}

/**
 * GCalendar: Page Handler
 */
function gcalendar_page_handler($page) {
	
	// Base path
	$base_path = elgg_get_plugins_path() . 'gcalendar/pages/gcalendar';
	
	switch($page[0]) {
		case 'authenticate':
			require_once $base_path . "/authenticate_p.php";
			break;
		
		case 'sync':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gcalendar/sync_p.php");
			return true;
			break;
        
        case 'import':
            require_once $base_path . "/import_p.php";
            break;
		
//        case 'getevents':
//            require_once $base_path . "/getevents_p.php";
//            break;
        
		default:
			require_once $base_path . '/index.php';
			break;
	}
	
	return true;
	
}

function gcalendar_gcalendar_create_event($event, $type, $object) {
	
	$check_event = ($event == 'gcalendar');
	$check_type = ($type == 'create');
	$check_object = (elgg_instanceof($object, 'object', 'meeting'));
	
	if ($check_event && $check_type && $check_object) {
		$container = $object->getContainerEntity();
		
		if ($container instanceof ProjectGroup) {
			// Google Calendar
			$gc = new GCalendarIntegration();
			$gc->authenticate();

			$attendees = array();
			
			// Get collaborators
			$options = array(
				'type' => 'user',
				'relationship' => 'collaborator',
				'relationship_guid' => $container->getGUID(),
				'inverse_relationship' => true,
				'offset' => 0,
				'limit' => null,
			);
			$collaborators = elgg_get_entities_from_relationship($options);
			
			if ($collaborators) {
				foreach($collaborators as $col) {
					$attendees[] = $col->email;
				}
			}
			
			// Get visitors
			$options = array(
				'type' => 'user',
				'relationship' => 'visitor',
				'relationship_guid' => $container->getGUID(),
				'inverse_relationship' => true,
				'offset' => 0,
				'limit' => null,
			);
			$visitors = elgg_get_entities_from_relationship($options);
			
			if ($visitors) {
				foreach($visitors as $vis) {
					$attendees[] = $vis->email;
				}
			}
			
			if (!empty($attendees)) {
				$description = $object->description;
				$description .= '

';
				$description .= $object->getURL();
				$options = array(
					'summary' => $object->title,
					'description' => $description,
					'attendees' => $attendees,
					'start' => $object->site_start_datetime,
					'end' => $object->site_end_datetime,
					'timezone' => $object->timezone,
				);
				$event = $gc->insertEvent($options);
				
				if ($event instanceof Google_Event) {
					$object->event_id = $event->getId();
				}
			}
		}
	}
	
}

/**
 * GCalendar: Create Collaborator Visitor Event
 */
function gcalendar_create_collaborator_visitor_event($event, $type, $object) {
	
	$check_event = ($event == 'create');
	$check_type = ($type == 'collaborator' || $type == 'visitor');
	$check_object = ($object instanceof ElggRelationship);
	
	if ($check_event && $check_type && $check_object) {
		$user = get_entity($object->guid_one);
		$project = get_entity($object->guid_two);
		
		if ($user instanceof ElggUser && $project instanceof ProjectGroup) {
			// Get site timezone
			if (is_callable('elgg_timezone_get_timezone_site')) {
				// Function added into this module
				$site_timezone = elgg_timezone_get_timezone_site();
			}
			else {
				$site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
			}
			// Get current timezone
			$current_timezone = date_default_timezone_get();
			if (empty($site_timezone)) {
				$site_timezone = $current_timezone;
			}
			// Set site timezone
			date_default_timezone_set($site_timezone);
			// Get site_end_datetime to compare
			$site_end_datetime = time();
			// Set current timezone
			date_default_timezone_set($current_timezone);
			
			// Get meetings
			$options = array(
				'type' => 'object',
				'subtype' => 'meeting',
				'container_guid' => $project->getGUID(),
				'metadata_name_value_pairs' => array(
					array(
						'name' => 'site_end_datetime',
						'value' => $site_end_datetime,
						'operand' => '>=',
					),
				 ),
				'offset' => 0,
				'limit' => null,
			);
			$meetings = elgg_get_entities_from_metadata($options);
			
			if ($meetings) {
				foreach($meetings as $m) {
					create_annotation(
							$m->getGUID(),
							GCALENDAR_SYNC,
							time(),
							'',
							$user->getGUID(),
							ACCESS_LOGGED_IN);
					
					// Notify
					$to = $m->getOwnerGUID();
					$from = elgg_get_site_entity()->getGUID();
					$subject = elgg_echo('gcalendar:new:collaborator:visitor:notify:subject', array($project->name));
					$url = $project->getURL();
					$message = elgg_echo('gcalendar:new:collaborator:visitor:notify:body', array($project->name, $url));
					notify_user($to, $from, $subject, $message);
				}
			}
		}
	}
	
	return true;
	
}

/**
 * GCalendar: Delete Collaborator Visitor Event
 */
function gcalendar_delete_collaborator_visitor_event($event, $type, $object) {
	
	$check_event = ($event == 'delete');
	$check_type = ($type == 'collaborator' || $type == 'visitor');
	$check_object = ($object instanceof stdClass);
	
	if ($check_event && $check_type && $check_object) {
		$user = get_entity($object->guid_one);
		$project = get_entity($object->guid_two);
		
		if ($user instanceof ElggUser && $project instanceof ProjectGroup) {
			// Get site timezone
			if (is_callable('elgg_timezone_get_timezone_site')) {
				// Function added into this module
				$site_timezone = elgg_timezone_get_timezone_site();
			}
			else {
				$site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
			}
			// Get current timezone
			$current_timezone = date_default_timezone_get();
			if (empty($site_timezone)) {
				$site_timezone = $current_timezone;
			}
			// Set site timezone
			date_default_timezone_set($site_timezone);
			// Get site_end_datetime to compare
			$site_end_datetime = time();
			// Set current timezone
			date_default_timezone_set($current_timezone);
			
			// Get files
			$options = array(
				'type' => 'object',
				'subtype' => 'meeting',
				'container_guid' => $project->getGUID(),
				'metadata_name_value_pairs' => array(
					array(
						'name' => 'site_end_datetime',
						'value' => $site_end_datetime,
						'operand' => '>=',
					),
				 ),
				'offset' => 0,
				'limit' => null,
			);
			$meetings = elgg_get_entities($options);
			
			if ($meetings) {
				// Creo una anotacion sobre el archivo indicando que debo
				// sincronizar los permisos entre el archivo y el dueño de la anotacion
				foreach($meetings as $m) {
					create_annotation(
							$m->getGUID(),
							GCALENDAR_SYNC,
							time(),
							'',
							$user->getGUID(),
							ACCESS_LOGGED_IN);
					
					// Notify
					$to = $m->getOwnerGUID();
					$from = elgg_get_site_entity()->getGUID();
					$subject = elgg_echo('gcalendar:delete:collaborator:visitor:notify:subject', array($project->name));
					$url = $project->getURL();
					$message = elgg_echo('gcalendar:delete:collaborator:visitor:notify:body', array($project->name, $url));
					notify_user($to, $from, $subject, $message);
				}
			}
		}
	}
	
	return true;
	
}

/**
 * Add a menu item to the user ownerblock
 */
function gcalendar_title_menu($hook, $type, $return, $params) {
	
//	if (elgg_instanceof($params['entity'], 'user')) {
//		$url = "gdrive/owner/{$params['entity']->username}";
//		$item = new ElggMenuItem('pages', elgg_echo('gdrive'), $url);
//		$return[] = $item;
//	}
//	else {
		$page = get_input('page');
		$page_array = explode('/', $page);
		$is_list = false;
		if (isset($page_array[0], $page_array[2])) {
			if ($page_array['0'] == 'group' && $page_array[2] == 'all') {
				$is_list = true;
			}
		}
		
		$page_owner = elgg_get_page_owner_entity();
		if ($page_owner instanceof ProjectGroup && elgg_in_context('meeting') && $is_list) {
			if ($page_owner->meeting_enable != "no") {
				// Sync
				if ($page_owner->canWriteToContainer()) {
					$url = "gcalendar/sync/{$page_owner->guid}";
					$item = new ElggMenuItem('gcalendar_sync', elgg_echo('gcalendar:group:sync'), $url);
					$item->setLinkClass('gcalendar-auth gcalendar-auth-no gcalendar-sync');//elgg-button elgg-button-action flRig
					$return[] = $item;
				}
			}
		}
//	}

	return $return;
	
}

function gcalendar_get_friendly_gcalendar_id($gcalendar_id) {
    
    if (empty($gcalendar_id) || !is_string($gcalendar_id)) {
        return $gcalendar_id;
    }
    
    $pos = strpos($gcalendar_id, '@');
    $gcalendar_id = substr($gcalendar_id, 0, $pos);
    $gcalendar_id = elgg_get_friendly_title($gcalendar_id);
    
    return $gcalendar_id;
    
}

function gcalendar_get_user_time_start($google_event, $with_format = FALSE){
    $user = elgg_get_logged_in_user_entity();
    $user_timezone = elgg_timezone_get_timezone_user($user);	

    if (is_callable('elgg_timezone_get_timezone_site')) {
        // Function added into this module
        $server_timezone = elgg_timezone_get_timezone_site();
    }
    else {
        $server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
    }

    if (!$user_timezone) {
        $user_timezone = $server_timezone;
    }

    $default_timezone = date_default_timezone_get();
    date_default_timezone_set($user_timezone);
    
    $start = $google_event->getStart();
    
    $star_date_time = strtotime($start->dateTime);
    
    $return_time = $star_date_time;
    
    if ($with_format) {
        
        $return_time = date($with_format, $return_time);
        
    }
	
    date_default_timezone_set($default_timezone);
    
	return $return_time;
	
}

function gcalendar_get_user_time_end($google_event, $with_format = FALSE){
    $user = elgg_get_logged_in_user_entity();
    $user_timezone = elgg_timezone_get_timezone_user($user);	

    if (is_callable('elgg_timezone_get_timezone_site')) {
        // Function added into this module
        $server_timezone = elgg_timezone_get_timezone_site();
    }
    else {
        $server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
    }

    if (!$user_timezone) {
        $user_timezone = $server_timezone;
    }

    $default_timezone = date_default_timezone_get();
    date_default_timezone_set($user_timezone);
    
    $end = $google_event->getEnd();
    
    $end_date_time = strtotime($end->dateTime);
    
    $return_time = $end_date_time;
    
    if ($with_format) {
        
        $return_time = date($with_format, $return_time);
    }
    
    date_default_timezone_set($default_timezone);
	
	return $return_time;
	
}