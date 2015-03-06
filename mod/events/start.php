<?php

/**
 * events
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
// Define constants
define('EVENTS_ATTEND_ANNOTATION_NAME', 'attend');
define('EVENTS_ATTEND_NOT_REPLIED', 'not_replied');
define('EVENTS_ATTEND_YES', 'yes');
define('EVENTS_ATTEND_MAYBE', 'maybe');
define('EVENTS_ATTEND_NO', 'no');
define('EVENT_STATE_CLOSED', 'closed');
define('EVENT_STATE_OPENED', 'opened');
define('Events_ENABLE_DEMO', FALSE);
define('EVENT_DATE_FORMAT', 'Y-m-d, g:i A');
define('EVENT_TIME_FORMAT', 'g:i A');

require_once(dirname(__FILE__) . '/lib/timezone_lib.php');
require_once(dirname(__FILE__) . '/lib/calendar_lib.php');
require_once(dirname(__FILE__) . '/lib/mail_queue_lib.php');
require_once(dirname(__FILE__) . '/lib/main.php');
require_once(dirname(__FILE__) . '/lib/access_lib.php');

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/events_lib.php');

global $SITE_TIMEZONE;
if (is_callable('elgg_timezone_setter')) {
	$SITE_TIMEZONE = elgg_timezone_setter();
}

function events_init() {
	
	// Initializate the plugin
	//events_initializateplugin();
	
	// Page Handler
	elgg_register_page_handler('events', 'events_page_handler');
	elgg_register_entity_url_handler('object', 'event', 'events_url');
    
    // Extend view
	elgg_extend_view('register/extend', 'events/input/timezone_users');
	elgg_extend_view('forms/account/settings', 'events/input/timezone_users');
	elgg_extend_view('events/profile/profile_footer', 'events/profile/guests');
    
    //Calendar metatags, js and css.
	elgg_extend_view('page/elements/head', 'events/calendar/metatags', 1000);
	elgg_extend_view('css/elgg', 'events/calendar/css');
	elgg_register_css('qtip2.css', elgg_get_site_url().'mod/events/vendors/qtip2/jquery.qtip.css');		// qtip CSS
	elgg_load_css('qtip2.css');

	elgg_register_js('qtip2.js', elgg_get_site_url().'mod/events/vendors/qtip2/jquery.qtip.min.js');
	elgg_load_js('qtip2.js');

	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'events_entity_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'events_owner_block_menu');
    elgg_register_plugin_hook_handler('action', 'register', 'events_register_action_validator');
	elgg_register_plugin_hook_handler('action', 'usersettings/save', 'events_register_action_validator');
	elgg_register_plugin_hook_handler('usersettings:save', 'user', 'events_usersettings_save_event');
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'events_register_menu_project_profile_menu_hook');
    
    // Events
	elgg_register_event_handler('create', 'user', 'events_register_user_event');
    

	// JS
	elgg_register_js('form.placeholder.js', 'mod/events/vendors/placeholder/jquery.placeholder.min.js');
	
	// Menu
	$listing_item = new ElggMenuItem('events', elgg_echo('events:plugin:menu:title'), 'events');
	elgg_register_menu_item('site', $listing_item);
	
	// Widgets
	elgg_register_widget_type('event', elgg_echo('events'), elgg_echo('events:widget:description'));
	
	// Groups
	if (elgg_get_plugin_setting('group_support', 'events') == 'yes') {
		add_group_tool_option('events', elgg_echo('events:enable:events'), TRUE);
		elgg_extend_view('groups/tool_latest', 'events/group_module');
	}
        
}

/**
 * Plugin hook that catch the register action and validate the timezone
 * 
 * @param type $hook
 * @param type $object_type
 * @param type $returnvalue
 * @param type $params
 * @return boolean 
 */
function events_register_action_validator($hook, $object_type, $returnvalue, $params) {
	$user_timezone = get_input('user_timezone');

	if (!elgg_timezone_validate_input($user_timezone)) {
		register_error(elgg_echo('events:register:timezone:error'));
		return FALSE;
	}
}

function events_register_user_event($event, $otype, $object) {
	$check_event = ($event == 'create');
	$check_otype = ($otype == 'user');
	$check_object = (elgg_instanceof($object, 'user'));

	if ($check_event && $check_otype && $check_object) {
		$user_timezone = get_input('user_timezone');
		elgg_timezone_set_timezone_user($object, $user_timezone);
	}
}

function events_usersettings_save_event() {
	$user_guid = get_input('guid');

	if (!$user_guid) {
		$user = elgg_get_logged_in_user_entity();
	} else {
		$user = get_entity($user_guid);
	}

	$user_timezone = get_input('user_timezone');
	elgg_timezone_set_timezone_user($user, $user_timezone);
}


/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost Events post entity
 * @return string Events post URL
 */
function events_url($entity) {

	global $CONFIG;
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
	return $CONFIG->url . "events/view/" . $entity->getGUID() . "/" . $title;
	
}

/**
 *  All events:			events/all
 *  User's events:		events/owner/<username>
 *  Friends' events:		events/friends/<username>
 *  View events:			events/view/<guid>/<title>
 *  New events:			events/add/<guid> (container: user, group, parent)
 *  Edit events:			events/edit/<guid>
 *  Group events:			events/group/<guid>/owner
 */
function events_page_handler($page) {
	
	global $CONFIG;
	
	switch ($page[0]) {
		case "admin":
			!@include_once(dirname(__FILE__) . "/pages/admin_p.php");
			return false;
			break;
		case 'add':
			!@include_once(dirname(__FILE__) . "/pages/edit_p.php");
			return true;

			break;

		case 'edit':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/edit_p.php");
			return true;

			break;

		case 'owner':
			set_input('username', $page[1]);
			set_input('entity_owner_filter', 'mine');

			!@include_once(dirname(__FILE__) . "/pages/list_p.php");
			return true;

			break;
		case 'friends':
			set_input('entity_owner_filter', 'friends');
			!@include_once(dirname(__FILE__) . "/pages/list_p.php");
			return true;

			break;

		case 'view':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/profile_p.php");
			return true;
			break;
		
		case 'group':
			set_input('guid', $page[1]);
			set_input('entity_owner_filter', 'mine');
			!@include_once(dirname(__FILE__) . "/pages/list_p.php");
			return true;
			break;
		
		case 'invite':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/invite_p.php");
			return true;
			break;
		
		case 'search_users':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/search_users_p.php");
			return true;
			break;
		case 'calendar':
			if($page[1]) {
				set_input('username', $page[1]);
			}
			!@include_once(dirname(__FILE__) . "/pages/calendar.php");
			return true;
			break;
		case 'search':
			set_input('entity_owner_filter', 'all');
			set_input('searching_events',true);
			!@include_once(dirname(__FILE__) . "/pages/list_p.php");
			return true;
			break;
		case 'past':
			!@include_once(dirname(__FILE__) . "/pages/past_p.php");
			return true;
			break;

		default:
			if (is_numeric($page[1])) {
				set_input('guid', $page[1]);
				!@include_once(dirname(__FILE__) . "/pages/profile_p.php");
				return true;
			} else {
				set_input('entity_owner_filter', 'all');
				!@include_once(dirname(__FILE__) . "/pages/list_p.php");
				return true;
			}

			break;
	}
}

function events_entity_menu($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:entity');
	
	if ($check_hook && $check_type) {
		$entity = elgg_extract('entity', $params);
		$view_type = elgg_extract('view_type', $params);
		
		if (elgg_instanceof($entity, 'object', 'event')) {
			
			if ($view_type == 'listing') {
				$extra_fields = EventsBaseMain::ktform_get_extra_listing_fields('event');

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
								 'name' => "event:listing:title:{$internalname}",
								 'text' => "<span>$value</span>",
								 'href' => false,
								 'priority' => 2,
							);
							$return[] = ElggMenuItem::factory($options);
						}
					}
				}
			}
			
			// Add item cancel/reopen event
			if ($entity->canEdit() && !elgg_in_context('widgets')) {
				$past = false;
				
				// Si el evento es pasado, no aparecen los links
				$current_timezone = date_default_timezone_get();
				$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	
				$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
				if (!$user_timezone) {
					$user_timezone = $server_timezone;
				}
				date_default_timezone_set($server_timezone);
				if ($entity->end_event_date_time < time()) {
					$past = true;
				}
				date_default_timezone_set($current_timezone);
				if (!$past) {
					if ($entity->state == EVENT_STATE_OPENED) {
						$name = 'event_cancel';
						$text = elgg_echo('events:list:cancel');
						$href = elgg_add_action_tokens_to_url(elgg_get_site_url() . "action/events/event/cancel/?guid=".$entity->getGUID());
						$menu_item = new ElggMenuItem($name, $text, $href);
					} else {
						$name = 'event_reopen';
						$text = elgg_echo('events:list:reopen');
						$href = elgg_add_action_tokens_to_url(elgg_get_site_url() . "action/events/event/reopen/?guid=" . $entity->getGUID());
						$menu_item = new ElggMenuItem($name, $text, $href);
					}
					$menu_item->setPriority(250);
					$return[] = $menu_item;
				}
			}
		}
	}
	
	return $return;
	
}

/**
 * Add a menu item to the user ownerblock
 */
function events_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "events/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('pages', elgg_echo('events'), $url);
		$return[] = $item;
	}
	else {
		if (elgg_get_plugin_setting('group_support', 'events') == 'yes' && $params['entity']->events_enable != "no") {
			$url = "events/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('pages', elgg_echo('events:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
	
}

function events_setup() {
	global $CONFIG;
	
	$page_owner = elgg_get_page_owner_entity();
	
	$listing_link = $CONFIG->url . 'events/';

	if (!($page_owner instanceof ElggGroup)) {
		$listing_item = new ElggMenuItem('events', elgg_echo('events:plugin:menu:title'), $listing_link);
		elgg_register_menu_item('site', $listing_item);
	}

	$context = elgg_get_context();

	if ($context == 'admin') {
		//add_submenu_item(elgg_echo("events:admin"), $CONFIG->url . "events/admin");
	}

//	if ($context == 'activity') {
            
//            elgg_extend_view('navigation/menu/extras', 'widgets/events_activity');
//            elgg_extend_view('navigation/menu/extras', 'widgets/event/content');
//        }
	if ($context == 'events') {

		if (elgg_is_logged_in()) {
//			$add_item = new ElggMenuItem('add', elgg_echo('events:plugin:page_owner:add'), $listing_link . 'add/');
//			elgg_register_menu_item('page', $add_item);
			
			$calendar_owner = '';
			if ($page_owner instanceof ElggGroup) {
				$calendar_owner = $page_owner->username;
			}
			$calendar_item = new ElggMenuItem('calendar', elgg_echo('events:plugin:page_owner:calendar'), $listing_link . 'calendar/' .$calendar_owner);
			elgg_register_menu_item('page', $calendar_item);
            
			if (!($page_owner instanceof ElggGroup)) {
				$add_item = new ElggMenuItem('past', elgg_echo('events:plugin:page_owner:past_events'), $listing_link . 'past/');
				elgg_register_menu_item('page', $add_item);
			}
		}

		if (elgg_is_active_plugin('theme_professionalelgg18')) {
			if (!($page_owner instanceof ElggGroup)) {
				$list_all_item = new ElggMenuItem('listing', elgg_echo('events:plugin:page_owner:list'), $listing_link.'all/');
				elgg_register_menu_item('page', $list_all_item);
			}
		} else {

			$submenu_links = EventsBaseMain::ktform_get_listing_tabs($listing_link, $context);

			foreach ($submenu_links as $key => $link) {
				$tmp_item = new ElggMenuItem($key, elgg_echo('events_ktform:custom_tabs:' . $key), $link);
				elgg_register_menu_item('page', $tmp_item);
			}
		}
	}
}

function events_register_menu_project_profile_menu_hook($hook, $type, $return, $params) {
	
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
			if ($page_owner->events_enable == 'yes' && $project_gatekeeper) {
				$options = array(
					'name' => 'events',
					'text' => elgg_echo('groups:tabs:events'),
					'href' => "events/group/" . $page_owner->guid . "/all",
					'priority' => 600,
					'selected' => elgg_in_context('events'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}

elgg_register_event_handler('init', 'system', 'events_init');
elgg_register_event_handler('pagesetup', 'system', 'events_setup');