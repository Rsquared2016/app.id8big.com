<?php

/**
 * Elgg Social Login
 */

define('ELGG_SOCIAL_LOGIN_GRAPHICS', elgg_get_site_url() . 'mod/elgg_social_login/graphics/');
define('SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS', 'invited_contacts');

elgg_register_event_handler('init', 'system', 'elgg_social_login_init');

function elgg_social_login_init() {
	
	// Hooks
	elgg_register_plugin_hook_handler('index', 'system', 'elgg_social_login_index_system_hook');
	elgg_register_plugin_hook_handler('route', 'register', 'elgg_social_register_index_system_hook');
	
	// Events
	elgg_register_event_handler('login', 'user', 'elgg_social_login_login_user_event');
	
	// Extend Views
	elgg_extend_view('forms/login'   , 'elgg_social_login/login' );
	elgg_extend_view('forms/register', 'elgg_social_login/login');
	elgg_extend_view('css/elgg', 'elgg_social_login/css');
	if (elgg_is_active_plugin('theme_professionalelgg18')) {
		elgg_extend_view('forms/login_lb_contents/extend', 'elgg_social_login/login');
	}
	
}

function elgg_social_login_index_system_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'index');
	$check_type = ($type == 'system');
	$is_logged_in = elgg_is_logged_in();
	
    if ($check_hook && $check_type && !$is_logged_in) {
		$friend_guid = get_input('friend_guid', false);
		$invitecode = get_input('invitecode', false);
        
        $project_guid = get_input('project_guid', false);

        if ($project_guid) {
            $invite_type = get_input('invite_type');
            $_SESSION['project_guid'] = $project_guid;
            $_SESSION['invite_type'] = $invite_type;
        }
		
		if ($friend_guid && $invitecode) {
			$friend = get_entity($friend_guid);
			
			if (elgg_instanceof($friend, 'user')) {
				if ($invitecode == generate_invite_code($friend->username)) {
					$_SESSION['friend_guid'] = $friend_guid;
					$_SESSION['invitecode'] = $invitecode;
				}
			}
		}
	}
	
	return $return;
	
}

function elgg_social_register_index_system_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'route');
	$check_type = ($type == 'register');
	$is_logged_in = elgg_is_logged_in();
	
    if ($check_hook && $check_type && !$is_logged_in) {
		
        $project_guid = get_input('project_guid', false);

        if ($project_guid) {
            $invite_type = get_input('invite_type');
            $_SESSION['project_guid'] = $project_guid;
            $_SESSION['invite_type'] = $invite_type;
        }
	}
	
	return $return;
	
}

function elgg_social_login_login_user_event($event, $type, $object) {
	
	$check_event = ($event == 'login');
	$check_type = ($type == 'user');
	$check_object = (elgg_instanceof($object, 'user'));
	
	if ($check_event && $check_type && $check_object) {
		$last_login = $object->last_login;
		if ($last_login == 0) {
			if (isset($_SESSION['friend_guid'], $_SESSION['invitecode'])) {
				$friend_guid = $_SESSION['friend_guid'];
				$invitecode = $_SESSION['invitecode'];
				
				$friend = get_entity($friend_guid);
				
				if (elgg_instanceof($friend, 'user')) {
					if ($invitecode == generate_invite_code($friend->username)) {
						$object->addFriend($friend_guid);
						$friend->addFriend($object->getGUID());
						
						// @todo Should this be in addFriend?
						add_to_river('river/relationship/friend/create', 'friend', $object->getGUID(), $friend_guid);
						add_to_river('river/relationship/friend/create', 'friend', $friend_guid, $object->getGUID());
					}
				}
			}
            if (isset($_SESSION['project_guid'], $_SESSION['invite_type'])) {
                $project_guid = $_SESSION['project_guid'];
                $invite_type = $_SESSION['invite_type'];
                
                if ($invite_type == ProjectSettings::REL_INVITED_COLLABORATORS) {
                    $relationship = ProjectSettings::REL_COLLABORATOR;
                } else {
                    $relationship = ProjectSettings::REL_VISITOR;
                }
                
                add_entity_relationship($object->getGUID(), $relationship, $project_guid);
                add_entity_relationship($object->getGUID(), 'member', $project_guid);
            }
		}
	}
	
}

//==============================================================================

/**
 * Social Import Contacts
 */
elgg_register_event_handler('init', 'system', 'social_import_contacts_init');

function social_import_contacts_init() {
	
	// Library
	elgg_register_library('social_import_contacts', elgg_get_plugins_path() . 'elgg_social_login/lib/social_import_contacts/main.php');
	elgg_load_library('social_import_contacts');
	
//	if (social_import_contacts_is_available()) {
		// Page Handler
		elgg_register_page_handler('social_import_contacts', 'social_import_contacts_page_handler');

		// Actions
		elgg_register_action('social_import_contacts/import', elgg_get_plugins_path() . 'elgg_social_login/actions/social_import_contacts/import.php');
		elgg_register_action('social_import_contacts/invite_contacts', elgg_get_plugins_path() . 'elgg_social_login/actions/social_import_contacts/invite_contacts.php');

		// Events
//		elgg_register_event_handler('login', 'user', 'social_import_contacts_login_user_event');

		// Hooks
		elgg_register_plugin_hook_handler('view', 'input/submit', 'social_import_contacts_view_input_submit_hook');
        
		// Menu
		$params = array(
			'name' => 'import_contacts',
			'text' => elgg_echo('social_import_contacts'),
			'href' => 'social_import_contacts',
			'contexts' => array('friends')
		);
		elgg_register_menu_item('page', $params);
		elgg_unregister_menu_item('page', 'invite');

		// Extend Views
		elgg_extend_view('css/elgg', 'social_import_contacts/css');
		elgg_extend_view('js/elgg', 'social_import_contacts/js');
		elgg_extend_view('page/elements/foot', 'social_import_contacts/import_lightbox');
		
		// Load
		elgg_load_css('lightbox');
		elgg_load_js('lightbox');
//	}
	
}

function social_import_contacts_page_handler($page) {
	
	// Set context Friends
	elgg_set_context('friends');
	
	// Get user logged in
	$user_logged_in = elgg_get_logged_in_user_guid();
	
	// Set page owner
    $project_guid = get_input('project_guid');
    $project = get_entity($project_guid);
    if ($project instanceof ProjectGroup) {
        elgg_set_page_owner_guid($project_guid);
        elgg_push_context('project_profile');
    }
    else {
        elgg_set_page_owner_guid($user_logged_in);
    }
	
	// Add submenu items collections
	collections_submenu_items();
	
	$pages = dirname(__FILE__) . '/pages/social_import_contacts';

	switch ($page[0]) {
		default:
			gatekeeper();
			include "$pages/index.php";
			break;
	}
	
	return true;
	
}

function social_import_contacts_login_user_event($event, $type, $object) {
	
	$check_event = ($event == 'login');
	$check_type = ($type == 'user');
	$check_object = (elgg_instanceof($object, 'user'));
	
	if ($check_event && $check_type && $check_object) {
		$last_login = $object->last_login;
		if ($last_login == 0) {
			$object->show_import_lightbox = true;
		}
	}
	
}

function social_import_contacts_view_input_submit_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'input/submit');
	$show_button_latter = (get_input('show_button_later', false));
	
	if ($check_hook && $check_type && $show_button_latter) {
		$return .= elgg_view('input/button', array('value' => elgg_echo("social_import_contacts:later"), 'class' => 'flRig', 'id' => 'later'));
	}
	
	return $return;
	
}