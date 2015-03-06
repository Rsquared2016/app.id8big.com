<?php

/**
 * BigBlueButton Integration
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

define('Meeting_ENABLE_DEMO', FALSE);
define('BBBINTEGRATION_ATTENDEE_PASSWORD', 'rcAS5Z2R83');
define('BBBINTEGRATION_MODERATOR_PASSWORD', 'dPUm770qhE');
define('MEETING_PARTICIPANT_ANNOTATION', 'meeting_participant_annotation');
define('MEETING_REQUEST_TALK_ANNOTATION', 'meeting_request_talk_annotation');
//define('MEETING_TALK_ANNOTATION', 'meeting_talk_annotation');
define('MEETING_REQUEST_TALK_STATUS_REQUEST', 'request');
define('MEETING_REQUEST_TALK_STATUS_DECLINE', 'decline');
define('MEETING_REQUEST_TALK_STATUS_COMPLETE', 'complete');
define('MEETING_FRIENDS_ONLINE_USERS', FALSE);
define('MEETING_TIME_FORMAT', 'g:i A');

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/meeting_lib.php');
require_once(dirname(__FILE__) . '/lib/main.php');

// Global Site Timezone
global $SITE_TIMEZONE;

function meeting_init() {
	// Initializate the plugin
	//meeting_initializateplugin();
    
    // Root
    $root = dirname(__FILE__);
	
	// Page Handler
	elgg_register_page_handler('meeting', 'meeting_page_handler');
	elgg_register_entity_url_handler('object', 'meeting', 'meeting_url');

	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'meeting_page_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'meeting_owner_block_menu');
    elgg_register_plugin_hook_handler('entity:profile:output:fields:extend', 'object', 'meeting_entity_profile_output_fields_extend_object_hook');
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'meeting_register_menu_project_profile_menu_hook');
	elgg_register_plugin_hook_handler('view', 'user/elements/summary', 'meeting_view_user_elements_summary_hook');

	// JS
	elgg_register_js('form.placeholder.js', 'mod/bbbintegration/vendors/placeholder/jquery.placeholder.min.js');
	
	// Menu
	$listing_item = new ElggMenuItem('meeting', elgg_echo('meeting:plugin:menu:title'), 'meeting');
	elgg_register_menu_item('site', $listing_item);
	
	// Widgets
	elgg_register_widget_type('meeting', elgg_echo('meeting'), elgg_echo('meeting:widget:description'));
	
	// Groups
	if (elgg_get_plugin_setting('group_support', 'bbbintegration') == 'yes') {
		add_group_tool_option('meeting', elgg_echo('meeting:enablemeeting'), TRUE);
		elgg_extend_view('groups/tool_latest', 'meeting/group_module');
	}
    
    // Timezone
    if (!elgg_is_active_plugin('events')) {
        $action = get_input('action');
        if ($action != 'admin/plugins/activate') {
            elgg_register_library('elgg:meeting:timezone', "{$root}/lib/timezone_lib.php");
            elgg_load_library('elgg:meeting:timezone');
        }
        elgg_extend_view('forms/account/settings', 'meeting/settings/account/timezone');
        elgg_register_plugin_hook_handler('usersettings:save', 'user', 'meeting_usersettings_save_hook');
        if (is_callable('elgg_timezone_setter')) {
            global $SITE_TIMEZONE;
        	$SITE_TIMEZONE = elgg_timezone_setter();
        }
    }
    
    
    elgg_register_action('meeting/invite_visitors', elgg_get_plugins_path() . 'bbbintegration/actions/meeting/invite_visitors_a.php');
    
    elgg_register_event_handler("create",'object',"meeting_send_notification_to_collaborators");
	
}

/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost Meeting post entity
 * @return string Meeting post URL
 */
function meeting_url($entity) {

	global $CONFIG;
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
	return $CONFIG->url . "meeting/view/" . $entity->getGUID() . "/" . $title;
	
}

/**
 *  All meeting:			meeting/all
 *  User's meeting:		meeting/owner/<username>
 *  Friends' meeting:		meeting/friends/<username>
 *  View meeting:			meeting/view/<guid>/<title>
 *  New meeting:			meeting/add/<guid> (container: user, group, parent)
 *  Edit meeting:			meeting/edit/<guid>
 *  Group meeting:			meeting/group/<guid>/owner
 */
function meeting_page_handler($page) {
	
	global $CONFIG;
	
	switch ($page[0]) {
		case 'add':               
			!@include_once(dirname(__FILE__) . "/pages/meeting/edit_p.php");
			return true;

			break;

		case 'edit':                   
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/meeting/edit_p.php");
			return true;

			break;

		case 'owner':
			set_input('username', $page[1]);
			set_input('entity_owner_filter', 'mine');

			!@include_once(dirname(__FILE__) . "/pages/meeting/list_p.php");
			return true;

			break;
		case 'friends':
			set_input('entity_owner_filter', 'friends');
			!@include_once(dirname(__FILE__) . "/pages/meeting/list_p.php");
			return true;

			break;

		case 'view':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/meeting/profile_p.php");
			return true;
			break;
		case 'group':
			set_input('guid', $page[1]);
			set_input('entity_owner_filter', 'mine');
			!@include_once(dirname(__FILE__) . "/pages/meeting/list_p.php");
			return true;
			break;
            
        case 'join':
            set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/meeting/join_p.php");
			return true;
            break;
        case 'invite_visitors':
            set_input('guid', $page[1]);
            !@include_once(dirname(__FILE__) . "/pages/meeting/invite_visitors_p.php");
			return true;
            break;
		
		case "talk":
			gatekeeper();
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) .  "/pages/meeting/talk_p.php");
			return true;
			break;
		
		case "check_for_requests_talks":
			!@include_once(dirname(__FILE__) .  "/pages/meeting/check_for_requests_talks_p.php");
			return true;
			break;
		
		case "onlineusers":
			set_input('page_owner_guid', $page[1]);
			!@include_once(dirname(__FILE__) .  "/pages/meeting/onlineusers_p.php");
			return true;
			break;

		default:
			if (is_numeric($page[1])) {
				set_input('guid', $page[1]);
				!@include_once(dirname(__FILE__) . "/pages/meeting/profile_p.php");
				return true;
			} else {
				set_input('entity_owner_filter', 'all');
				!@include_once(dirname(__FILE__) . "/pages/meeting/list_p.php");
				return true;
			}

			break;
	}
}

function meeting_page_menu($hook, $type, $return, $params) {
	
	$entity = elgg_extract('entity', $params);
	$view_type = elgg_extract('view_type', $params);

	if (elgg_instanceof($entity, 'object', 'meeting') && $view_type == 'listing') {
		
		$extra_fields = MeetingBaseMain::ktform_get_extra_listing_fields('meeting');

		if ($extra_fields && is_array($extra_fields) && count($extra_fields)) {
			
			foreach ($extra_fields as $internalname => $options) {
				$output_view = $options['output_view'];
				$output_vars = array('value' => $entity->$internalname, 'entity' => $entity);
				if (array_key_exists('options', $options)) {
					$output_vars = array_merge($options['options'], $output_vars);
				}

				$value = elgg_view($output_view, $output_vars);
				if ($value) {
					$options = array(
						 'name' => "meeting:listing:title:{$internalname}",
						 'text' => "<span>$value</span>",
						 'href' => false,
						 'priority' => 2,
					);
						 
					$return[] = ElggMenuItem::factory($options);
				}
			}
			
			return $return;
		}
	}
	
}

/**
 * Add a menu item to the user ownerblock
 */
function meeting_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "meeting/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('meeting', elgg_echo('meeting'), $url);
		$return[] = $item;
	}
	else {
		if (elgg_get_plugin_setting('group_support', 'bbbintegration') == 'yes' && $params['entity']->meeting_enable != "no") {
			$url = "meeting/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('meeting', elgg_echo('meeting:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
	
}

/**
 * User settings save
 */
function meeting_usersettings_save_hook() {
    
	$user_guid = get_input('guid');
    
    if (!$user_guid) {
        $user = elgg_get_logged_in_user_entity();
    }
    else {
        $user = get_entity($user_guid);
    }

	$user_timezone = get_input('user_timezone');
    
	elgg_timezone_set_timezone_user($user, $user_timezone);
    
}

function meeting_entity_profile_output_fields_extend_object_hook($hook, $type, $return, $params) {
    
    $check_hook = ($hook == 'entity:profile:output:fields:extend');
    $check_type = ($type == 'object');
    
    if ($check_hook && $check_type) {
        $entity = $params['entity'];
        
        if (elgg_instanceof($entity, 'object', 'meeting')) {
            if (is_array($return)) {
                $return_aux = array();
                
                foreach($return as $shortname => $data) {
                    if ($shortname == 'start_date') {
                        $start_date = strtotime($data['value']);
                        $data['value'] = $entity->getStartDatetimeFriendly($start_date, true, false);
                        $return_aux[$shortname] = $data;
                    }
                    elseif ($shortname == 'timezone') {
                        $return_aux[$shortname] = $data;
                        $user_start_time = $entity->getStartDatetimeForUser();
                        $data_aux = array(
                            'label' => elgg_echo('meeting:meeting:label:user_start_date'),
                            'value' => $entity->getStartDatetimeFriendly($user_start_time, true, false),
                        );
                        $return_aux['user_start_date'] = $data_aux;
                        
                        $data_aux = array(
                            'label' => elgg_echo('meeting:meeting:label:user_start_time'),
                            'value' => $entity->getStartDatetimeFriendly($user_start_time, false, true),
                        );
                        $return_aux['user_start_time'] = $data_aux;
                    }
                    else {
                        $return_aux[$shortname] = $data;
                    }
                }
                
                $return = $return_aux;
            }
        }
    }
    
    return $return;
    
}

function meeting_send_notification_to_collaborators($event, $object_type, $object) {
	$validate_event = ($event == 'create');
	$validate_object_type = ($object_type == 'object');
	$validate_object = ($object instanceof Meeting);

	
	if ($validate_event && $validate_object_type && $validate_object) {
		$container = $object->getContainerEntity();
        if ($container instanceof ElggGroup) {
            $options = array(
                'relationship' => 'collaborator',
                'relationship_guid' => $container->getGUID(),
                'inverse_relationship' => TRUE,
                'limit' => 9999,
                'types' => 'user',
            );
            $users = elgg_get_entities_from_relationship($options);
            $invitor = get_user($object->owner_guid);
            $site_entity = elgg_get_site_entity();
            foreach($users as $user) {
                $subject = elgg_echo('meeting:collaborators:message:subject', array($object->name));
                $message = elgg_echo("meeting:collaborators:message:body", array($user->name, $invitor->name, $object->name,$object->getURL()));
                notify_user($user->getGUID(), $site_entity->getGUID(), $subject, $message);
            }
                
        }
    }
}

function meeting_register_menu_project_profile_menu_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:project_profile_menu');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project')) {
			$project_gatekeeper = false;
			if (is_callable('project_gatekeeper')) {
				$project_gatekeeper = project_gatekeeper(false);
			}
			
			// Tab project discussion
			if ($page_owner->meeting_enable == 'yes' && $project_gatekeeper) {
				$options = array(
					'name' => 'meeting',
					'text' => elgg_echo('groups:tabs:meeting'),
					'href' => "meeting/group/" . $page_owner->guid . "/all",
					'priority' => 625,
					'selected' => elgg_in_context('meeting'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}

/**
 * BBBIntegration: View user elements summary hook
 */
function meeting_view_user_elements_summary_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_type = ($type == 'user/elements/summary');
	$check_context = (elgg_in_context('meeting_widgets_user_online'));

	if ($check_hook && $check_type && $check_context) {
		$vars = $params['vars'];

		$return = elgg_view('meeting/widgets/user/elements/summary', $vars);
	}

	return $return;
	
}

elgg_register_event_handler('init', 'system', 'meeting_init');