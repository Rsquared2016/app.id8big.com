<?php

/**
 * gdrive
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

// Require
//$vendors = elgg_get_plugins_path() . 'gdrive/vendors/';
//require_once($vendors . 'google/Google_Client.php');
//require_once($vendors . 'google/contrib/Google_Oauth2Service.php');
//require_once($vendors . 'google/contrib/Google_DriveService.php');

define('GDrive_ENABLE_DEMO', FALSE);
define('GDRIVE_PERMISSION_ID', 'gdrive_permission_id');
define('GDRIVE_UPLOADED_BY_USER', 'gdrive_uploaded_by_user');
define('GDRIVE_SYNC_PERMISSION', 'gdrive_sync_permission');

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/gdrive_lib.php');

function gdrive_init() {
    
//    $opt = array(
//        'guid' => 793,
//        'annotation_names' => GDRIVE_SYNC_PERMISSION,
//    );
//    echo '<pre>';
//    var_dump(elgg_get_annotations($opt));
//    echo '</pre>';
    
	// Library
	$vendors = elgg_get_plugins_path() . 'gdrive/vendors/';
	elgg_register_library('google:client', $vendors . 'google/Google_Client.php');
	elgg_register_library('google:oauth2service', $vendors . 'google/contrib/Google_Oauth2Service.php');
	elgg_register_library('google:driveservice', $vendors . 'google/contrib/Google_DriveService.php');
	elgg_load_library('google:client');
	elgg_load_library('google:oauth2service');
	elgg_load_library('google:driveservice');
	
	// Initializate the plugin
	//gdrive_initializateplugin();
	
	// Page Handler
	elgg_register_page_handler('gdrive', 'gdrive_page_handler');
	elgg_register_entity_url_handler('object', 'gdrive', 'gdrive_url');

	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'gdrive_page_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'gdrive_owner_block_menu');
	elgg_register_plugin_hook_handler('register', 'menu:page', 'gdrive_register_menu_page_hook');
	elgg_register_plugin_hook_handler('register', 'menu:title', 'gdrive_register_menu_title_hook');
	elgg_register_plugin_hook_handler('entity:profile:output:fields:extend', 'object', 'gdrive_entity_profile_output_fields_extend_object_hook');
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'gdrive_register_menu_project_profile_menu_hook');

	// JS
	elgg_register_js('form.placeholder.js', 'mod/gdrive/vendors/placeholder/jquery.placeholder.min.js');
	
	// Menu
//	$listing_item = new ElggMenuItem('gdrive', elgg_echo('gdrive:plugin:menu:title'), 'gdrive');
//	elgg_register_menu_item('site', $listing_item);
	
	// Widgets
	elgg_register_widget_type('gdrive', elgg_echo('gdrive'), elgg_echo('gdrive:widget:description'));
	
	// Groups
	if (elgg_get_plugin_setting('group_support', 'gdrive') == 'yes') {
		add_group_tool_option('gdrive', elgg_echo('gdrive:enablegdrive'), TRUE);
		elgg_extend_view('groups/tool_latest', 'gdrive/group_module');
	}
	
	// Events
	elgg_register_event_handler('create', 'collaborator', 'gdrive_create_collaborator_visitor_event');
	elgg_register_event_handler('delete', 'collaborator', 'gdrive_delete_collaborator_visitor_event');
	elgg_register_event_handler('create', 'visitor', 'gdrive_create_collaborator_visitor_event');
	elgg_register_event_handler('delete', 'visitor', 'gdrive_delete_collaborator_visitor_event');
    elgg_register_event_handler('delete', 'object', 'gdrive_delete_object_event');
	
}

/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost GDrive post entity
 * @return string GDrive post URL
 */
function gdrive_url($entity) {
    
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
    $default_url = elgg_get_site_url() . 'gdrive/view/' . $entity->getGUID() . '/' . $title;
    if (!empty($entity->alternative_link)) {
        $default_url = elgg_get_site_url() . 'gdrive/document/' . $entity->getGUID() . '/' . $title;
    }
    
    return $default_url;
	
}

/**
 *  All gdrive:			gdrive/all
 *  User's gdrive:		gdrive/owner/<username>
 *  Friends' gdrive:		gdrive/friends/<username>
 *  View gdrive:			gdrive/view/<guid>/<title>
 *  New gdrive:			gdrive/add/<guid> (container: user, group, parent)
 *  Edit gdrive:			gdrive/edit/<guid>
 *  Group gdrive:			gdrive/group/<guid>/owner
 */
function gdrive_page_handler($page) {
	
	global $CONFIG;
	
	switch ($page[0]) {
		case 'add':
            if (isset($page[2])) {
                set_input('google', $page[2]);
                !@include_once(dirname(__FILE__) . "/pages/gdrive/google/add_p.php");
            }
            else {
                !@include_once(dirname(__FILE__) . "/pages/gdrive/edit_p.php");
            }
			return true;

			break;

		case 'edit':
//            if (isset($page[2])) {
//                set_input('guid', $page[1]);
//                set_input('google', $page[2]);
//                !@include_once(dirname(__FILE__) . "/pages/gdrive/google/edit_p.php");
//            }
//            else {
                set_input('guid', $page[1]);
                !@include_once(dirname(__FILE__) . "/pages/gdrive/edit_p.php");
//            }
			return true;

			break;

		case 'owner':
			forward();
			set_input('username', $page[1]);
			set_input('entity_owner_filter', 'mine');

			!@include_once(dirname(__FILE__) . "/pages/gdrive/list_p.php");
			return true;

			break;
		case 'friends':
			forward();
			set_input('entity_owner_filter', 'friends');
			!@include_once(dirname(__FILE__) . "/pages/gdrive/list_p.php");
			return true;

			break;

		case 'view':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gdrive/profile_p.php");
			return true;
			break;
        
        case 'document':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gdrive/google/document_p.php");
			return true;
			break;
        
        case 'import':
            set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gdrive/google/import_p.php");
			return true;
            break;
        case 'importgoogle':
            set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gdrive/google/importgoogle_p.php");
			return true;
            break;
        case 'loaddocuments':
            set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gdrive/google/loaddocuments_p.php");
			return true;
            break;
        
		case 'group':
			set_input('guid', $page[1]);
			set_input('entity_owner_filter', 'mine');
			!@include_once(dirname(__FILE__) . "/pages/gdrive/list_p.php");
			return true;
			break;
		
		case 'sync':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gdrive/sync_p.php");
			return true;
			break;
		
		case 'authenticate':
			!@include_once(dirname(__FILE__) . "/pages/gdrive/authenticate_p.php");
			return true;
			break;

		default:
			if (is_numeric($page[1])) {
				set_input('guid', $page[1]);
				!@include_once(dirname(__FILE__) . "/pages/gdrive/profile_p.php");
				return true;
			} else {
				forward();
				set_input('entity_owner_filter', 'all');
				!@include_once(dirname(__FILE__) . "/pages/gdrive/list_p.php");
				return true;
			}

			break;
	}
}

function gdrive_page_menu($hook, $type, $return, $params) {
	
	$entity = elgg_extract('entity', $params);
	$view_type = elgg_extract('view_type', $params);

	if (elgg_instanceof($entity, 'object', 'gdrive') && $view_type == 'listing') {
		
		$extra_fields = GDriveBaseMain::ktform_get_extra_listing_fields('gdrive');

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
						 'name' => "gdrive:listing:title:{$internalname}",
						 'text' => "<span>$value</span>",
						 'href' => false,
						 'priority' => 2,
					);
						 
					$return[] = ElggMenuItem::factory($options);
				}
			}
			
			return $return;
		}
        
        // Cambio el link de edit para los archivos de google
        foreach($return as $key => $menu_item) {
            $name = $menu_item->getName();

            switch ($name) {
                case 'edit';
                    if (!empty($entity->file_id)) {
                        $href = $entity->getURL();
                        $menu_item->setHref($href);
                        $menu_item->setLinkClass('gdrive-auth gdrive-google');
                    }
                    break;
                case 'delete':
                    $menu_item->setConfirmText('');
                    if (!empty($entity->file_id)) {
                        $menu_item->setLinkClass('gdrive-auth gdrive-google gdrive-delete gdrive-requires-confirmation');
                    }
                    else {
                        $menu_item->setLinkClass('gdrive-delete gdrive-delete-yes gdrive-requires-confirmation');
                    }
                    break;
            }
        }
	}
	
}

/**
 * Add a menu item to the user ownerblock
 */
function gdrive_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "gdrive/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('pages', elgg_echo('gdrive'), $url);
		$return[] = $item;
	}
	else {
		if (elgg_get_plugin_setting('group_support', 'gdrive') == 'yes' && $params['entity']->gdrive_enable != "no") {
			$url = "gdrive/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('gdrive', elgg_echo('gdrive:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
	
}

function gdrive_register_menu_page_hook($hook, $type, $return, $params) {
	
	$page = get_input('page');
	$page_array = explode('/', $page);
	$is_list = false;
	if (isset($page_array[0], $page_array[2])) {
		if ($page_array['0'] == 'group' && $page_array[2] == 'all') {
			$is_list = true;
		}
	}

	$page_owner = elgg_get_page_owner_entity();
	if (elgg_get_plugin_setting('group_support', 'gdrive') == 'yes' && $page_owner instanceof ProjectGroup && elgg_in_context('gdrive') && $is_list) {
		if ($page_owner->gdrive_enable != "no") {
			// Sync
			if ($page_owner->canWriteToContainer()) {
				$url = "gdrive/sync/{$page_owner->guid}";
				$item = new ElggMenuItem('gcalendar_sync', elgg_echo('gdrive:group:sync'), $url);
				$item->setLinkClass('gdrive-auth gdrive-sync');//elgg-button elgg-button-action 
				$return[] = $item;
			}
		}
	}

	return $return;
	
}

function gdrive_register_menu_title_hook($hook, $type, $return, $params) {

    $check_hook = ($hook == 'register');
    $check_type = ($type == 'menu:title');
    $check_context = (elgg_in_context('gdrive'));
    
    if ($check_hook && $check_type && $check_context) {
        $page_owner = elgg_get_page_owner_entity();
        
        if (elgg_instanceof($page_owner, 'group', 'project') && $page_owner->canWriteToContainer()) {
            $page = get_input('page');
            $check_page = ($page == 'group/'.$page_owner->getGUID().'/all');
            
            if ($check_page) {
                $return = array();

                // Create new
                $name = 'create_new';

                $options_values = array();

                $gdrive_integration = new GDriveIntegration();
                $document_types = $gdrive_integration->getDocumentTypesToCreate();
                if (is_array($document_types)) {
                    foreach ($document_types as $dt) {
                        $options_values[] = elgg_view('output/url', array(
                            'text' => elgg_echo('gdrive:menu:title:google:'.$dt),
                            'href' => elgg_get_site_url() . 'gdrive/add/' . $page_owner->getGUID() . '/' . $dt,
                            'class' => 'gdrive-auth gdrive-google gdrive-'.$dt,
                        ));
                    }
                }

                $text = elgg_view('input/button_dropdown', array(
                    'text' => elgg_echo('gdrive:menu:title:create_new'),
                    'options_values' => $options_values,
                    'link_class' => 'elgg-button elgg-button-submit',
                ));
                $href = FALSE;
                $menu_item = new ElggMenuItem($name, $text, $href);
                $menu_item->setLinkClass('elgg-button');
                $return[] = $menu_item;

                // Import
                $name = 'import';
                $text = elgg_echo('gdrive:menu:title:import');
                $href = elgg_get_site_url() . 'gdrive/import/' . $page_owner->getGUID();
                $menu_item = new ElggMenuItem($name, $text, $href);
                $menu_item->setLinkClass('elgg-button elgg-button-submit');
                $return[] = $menu_item;
            }
        }
    }

    return $return;

}

/**
 * GDrive: Create Collaborator Visitor Event
 */
function gdrive_create_collaborator_visitor_event($event, $type, $object) {
	
	$check_event = ($event == 'create');
	$check_type = ($type == 'collaborator' || $type == 'visitor');
	$check_object = ($object instanceof ElggRelationship);
	
	if ($check_event && $check_type && $check_object) {
		$user = get_entity($object->guid_one);
		$project = get_entity($object->guid_two);
		
		if ($user instanceof ElggUser && $project instanceof ProjectGroup) {
			// Get files
            $users_to_notify = array();
			$options = array(
				'type' => 'object',
				'subtype' => 'gdrive',
				'container_guid' => $project->getGUID(),
				'offset' => 0,
				'limit' => null,
			);
			$files = elgg_get_entities($options);
			
			if ($files) {
				// Creo una anotacion sobre el archivo indicando que debo
				// sincronizar los permisos entre el archivo y el dueño de la anotacion
				foreach($files as $f) {
                    if (empty($f->file_id)) {
                        continue;
                    }
                    $opt_annot = array(
                        'guid' => $f->getGUID(),
                        'annotation_names' => GDRIVE_SYNC_PERMISSION,
                        'annotation_owner_guids' => $user->getGUID(),
                    );
                    $annot_user = elgg_get_annotations($opt_annot);
                    if (empty($annot_user)) {
                        create_annotation(
                                $f->getGUID(),
                                GDRIVE_SYNC_PERMISSION,
                                time(),
                                '',
                                $user->getGUID(),
                                ACCESS_LOGGED_IN);
                    }
                    
                    // Si el dueño del archivo no esta en el arreglo de usaurios
                    // a notificar, lo agrego
                    if (!in_array($f->getOwnerGUID(), $users_to_notify)) {
                        $users_to_notify[] = $f->getOwnerGUID();
                    }
				}
			}
            
            // Notifico a los dueños de archivos que un collaborator/visitor
            // fue agregado al proyecto y debe sincronizar los permisso
            if (!empty($users_to_notify)) {
                foreach($users_to_notify as $user_guid) {
                    // Notify
//                    $to = $project->getOwnerGUID();
                    $to = $user_guid;
                    $from = elgg_get_site_entity()->getGUID();
                    $subject = elgg_echo('gdrive:new:collaborator:visitor:notify:subject', array($project->name));
                    $url = $project->getURL();
                    $message = elgg_echo('gdrive:new:collaborator:visitor:notify:body', array($project->name, $url));
                    notify_user($to, $from, $subject, $message);
                }
            }
		}
	}
	
	return true;
	
}

/**
 * GDrive: Delete Collaborator Visitor Event
 */
function gdrive_delete_collaborator_visitor_event($event, $type, $object) {
	
	$check_event = ($event == 'delete');
	$check_type = ($type == 'collaborator' || $type == 'visitor');
	$check_object = ($object instanceof stdClass);
	
	if ($check_event && $check_type && $check_object) {
		$user = get_entity($object->guid_one);
		$project = get_entity($object->guid_two);
		
		if ($user instanceof ElggUser && $project instanceof ProjectGroup) {
			// Get files
            $users_to_notify = array();
			$options = array(
				'type' => 'object',
				'subtype' => 'gdrive',
				'container_guid' => $project->getGUID(),
				'offset' => 0,
				'limit' => null,
			);
			$files = elgg_get_entities($options);
			
			if ($files) {
				// Creo una anotacion sobre el archivo indicando que debo
				// sincronizar los permisos entre el archivo y el dueño de la anotacion
				foreach($files as $f) {
                    if (empty($f->file_id)) {
                        continue;
                    }
                    
                    $opt_annot = array(
                        'guid' => $f->getGUID(),
                        'annotation_names' => GDRIVE_SYNC_PERMISSION,
                        'annotation_owner_guids' => $user->getGUID(),
                    );
                    $annot_user = elgg_get_annotations($opt_annot);
                    if (empty($annot_user)) {
                        create_annotation(
                                $f->getGUID(),
                                GDRIVE_SYNC_PERMISSION,
                                time(),
                                '',
                                $user->getGUID(),
                                ACCESS_LOGGED_IN);
                    }
					
                    // Si el dueño del archivo no esta en el arreglo de usaurios
                    // a notificar, lo agrego
                    if (!in_array($f->getOwnerGUID(), $users_to_notify)) {
                        $users_to_notify[] = $f->getOwnerGUID();
                    }
				}
                
                // Notifico a los dueños de archivos que un collaborator/visitor
                // fue agregado al proyecto y debe sincronizar los permisso
                if (!empty($users_to_notify)) {
                    foreach($users_to_notify as $user_guid) {
                        // Notify
//                        $to = $project->getOwnerGUID();
                        $to = $user_guid;
                        $from = elgg_get_site_entity()->getGUID();
                        $subject = elgg_echo('gdrive:delete:collaborator:visitor:notify:subject', array($project->name));
                        $url = $project->getURL();
                        $message = elgg_echo('gdrive:delete:collaborator:visitor:notify:body', array($project->name, $url));
                        notify_user($to, $from, $subject, $message);
                    }
                }
			}
		}
	}
	
	return true;
	
}

function gdrive_entity_profile_output_fields_extend_object_hook($hook, $type, $return, $params) {


	$check_hook = ($hook == 'entity:profile:output:fields:extend');
	$check_type = ($type == 'object');

	if ($check_hook && $check_type) {
		$return_aux = array();
		
		$entity = $params['entity'];
		
		if (is_array($return) && elgg_instanceof($entity, 'object', 'gdrive')) {
			// Alternative link
			$container = $entity->getContainerEntity();
			
			if ($container instanceof ProjectGroup) {
				if ($container->isMember()) {
                    if (!empty($entity->alternative_link)) {
                        $return['file'] = array(
                            'label' => elgg_echo('gdrive:gdrive:label:file'),
                            'value' => elgg_view('output/url', array(
                                'text' => elgg_echo('gdrive:link'),
                                'href' => $entity->alternative_link,
                                'target' => '_blank',
                            )),
                        );
                    }
				}
			}
		}
	}
	
	return $return;
	
}

function gdrive_register_menu_project_profile_menu_hook($hook, $type, $return, $params) {
	
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
			if ($page_owner->gdrive_enable == 'yes' && $project_gatekeeper) {
				$options = array(
					'name' => 'gdrive',
					'text' => elgg_echo('groups:tabs:gdrive'),
					'href' => "gdrive/group/" . $page_owner->guid . "/all",
					'priority' => 650,
					'selected' => elgg_in_context('gdrive'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}

function gdrive_delete_object_event($event, $object_type, $object) {

    $check_event = ($event == 'delete');
    $check_object_type = ($object_type == 'object');
    $check_object = (elgg_instanceof($object, 'object', 'gdrive'));
    
    $success = TRUE;
    
    if ($check_event && $check_object_type && $check_object) {
        // is a google document?
        $file_id = $object->file_id;
        if (!empty($file_id)) {
            $annotations = $object->getAnnotations(GDRIVE_PERMISSION_ID, null);
            if ($annotations) {
                // Google Drive
                $gdi = new GDriveIntegration();
                $gdi->authenticate();
                foreach($annotations as $annot) {
                    $permission_id = $annot->value;
                    
                    if (!empty($permission_id)) {
                        $gdi->deletePermission($file_id, $permission_id);
                        
//                        if (empty($success)) {
//                            break;
//                        }
                    }
                }
            }
        }
    }
    
    return $success;

}

elgg_register_event_handler('init', 'system', 'gdrive_init');