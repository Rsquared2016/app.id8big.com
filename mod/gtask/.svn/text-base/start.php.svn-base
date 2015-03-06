<?php

/**
 * gtask
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

define('Gtask_ENABLE_DEMO', FALSE);

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/gtask_lib.php');
require_once(dirname(__FILE__) . '/lib/main.php');

function gtask_init() {
    global $CONFIG;
	
	// Initializate the plugin
	//gtask_initializateplugin();
	
	// Page Handler
	elgg_register_page_handler('gtask', 'gtask_page_handler');
	elgg_register_entity_url_handler('object', 'gtask', 'gtask_url');

	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'gtask_page_menu');
//	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'gtask_owner_block_menu');

	// JS
	elgg_register_js('form.placeholder.js', 'mod/gtask/vendors/placeholder/jquery.placeholder.min.js');
	
	// Menu
//	$listing_item = new ElggMenuItem('gtask', elgg_echo('gtask:plugin:menu:title'), 'gtask');
//	elgg_register_menu_item('site', $listing_item);
	
	// Widgets
//	elgg_register_widget_type('gtask', elgg_echo('gtask'), elgg_echo('gtask:widget:description'));
	
	// Groups
	if (elgg_get_plugin_setting('group_support', 'gtask') == 'yes') {
		add_group_tool_option('gtask', elgg_echo('gtask:enablegtask'), TRUE);
		elgg_extend_view('groups/tool_latest', 'gtask/group_module');
	}
	
    $graphics_mod = $CONFIG->url.'mod/gtask/graphics/';
	
	define('GTASKS_GRAPHICS',$graphics_mod);
    
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'gtask_menu_entity');
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'gtask_permissions_check_object_hook');
	elgg_register_plugin_hook_handler('register', 'menu:filter', 'gtask_register_menu_filter_hook');
}

/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost Gtask post entity
 * @return string Gtask post URL
 */
function gtask_url($entity) {

	global $CONFIG;
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
	return $CONFIG->url . "gtask/view/" . $entity->getGUID() . "/" . $title;
	
}

/**
 *  All gtask:			gtask/all
 *  User's gtask:		gtask/owner/<username>
 *  Friends' gtask:		gtask/friends/<username>
 *  View gtask:			gtask/view/<guid>/<title>
 *  New gtask:			gtask/add/<guid> (container: user, group, parent)
 *  Edit gtask:			gtask/edit/<guid>
 *  Group gtask:			gtask/group/<guid>/owner
 */
function gtask_page_handler($page) {
	
	global $CONFIG;
	
//	$page_owner = elgg_get_page_owner_entity();
//	if (!($page_owner instanceof ProjectGroup)) {
//		forward();
//	}
    
//    if ($page_owner instanceof ProjectGroup) {
//        $is_collaborator = $page_owner->isCollaborator(elgg_get_logged_in_user_entity());
//        if (!($is_collaborator || elgg_is_admin_logged_in())) {
//            forward($page_owner->getURL());
//        }
//    }
	
	switch ($page[0]) {
		case 'add':
			!@include_once(dirname(__FILE__) . "/pages/gtask/edit_p.php");
			return true;

			break;

		case 'edit':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gtask/edit_p.php");
			return true;

			break;

		case 'owner':
			set_input('username', $page[1]);
			set_input('entity_owner_filter', 'mine');

			!@include_once(dirname(__FILE__) . "/pages/gtask/list_p.php");
			return true;

			break;
//		case 'friends':
//			set_input('entity_owner_filter', 'friends');
//			!@include_once(dirname(__FILE__) . "/pages/gtask/list_p.php");
//			return true;
//
//			break;

		case 'view':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/gtask/profile_p.php");
			return true;
			break;
		case 'group':
			set_input('guid', $page[1]);
			set_input('entity_owner_filter', 'mine');
			!@include_once(dirname(__FILE__) . "/pages/gtask/list_p.php");
			return true;
			break;

		default:
			if (is_numeric($page[1])) {
				set_input('guid', $page[1]);
				!@include_once(dirname(__FILE__) . "/pages/gtask/profile_p.php");
				return true;
			} else {
				set_input('entity_owner_filter', 'mine');
				!@include_once(dirname(__FILE__) . "/pages/gtask/list_p.php");
				return true;
			}

			break;
	}
}

function gtask_page_menu($hook, $type, $return, $params) {
	
	$entity = elgg_extract('entity', $params);
	$view_type = elgg_extract('view_type', $params);

	if (elgg_instanceof($entity, 'object', 'gtask') && $view_type == 'listing') {
		
		$extra_fields = GtaskBaseMain::ktform_get_extra_listing_fields('gtask');

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
						 'name' => "gtask:listing:title:{$internalname}",
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
function gtask_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "gtask/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('pages', elgg_echo('gtask'), $url);
		$return[] = $item;
	}
	else {
		if (elgg_get_plugin_setting('group_support', 'gtask') == 'yes' && $params['entity']->gtask_enable != "no") {
			$url = "gtask/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('pages', elgg_echo('gtask:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
	
}

function gtask_menu_entity($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params);
	
	if (elgg_instanceof($entity, 'object', 'gtask')) {
//        $return = array();
        $menu_items = $return;
        $delete_menus = array('likes','access','gtask:listing:title:responsive');
        
        foreach ($menu_items as $key => $menu_item) {
//            $menu_item instanceof ElggMenuItem;
            if (in_array($menu_item->getName(), $delete_menus)) {
                
                unset($return[$key]);
            }
        }
//        $options = array(
//            'name' => 'blog_to_news',
//            'text' => elgg_view('blog_to_news/listing_buttons', array('entity' => $entity)),
//            'href' => false,
//            'priority' => 1000,
//        );
//        $return[] = ElggMenuItem::factory($options);
		
	}
    
    return $return;
}

function gtask_permissions_check_object_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'permissions_check');
	$check_type = ($type == 'object');
	
	if ($check_hook && $check_type) {
		$entity = $params['entity'];
		$user = $params['user'];
		
		if ($entity instanceof Gtask && $user instanceof ElggUser) {
			$container = $entity->getContainerEntity();
			
			if ($container instanceof ProjectGroup) {
				$is_collaborator = $container->isCollaborator($user);
				
				if ($is_collaborator || elgg_is_admin_logged_in()) {
					$return = true;
				}
			}
		}
	}
	
	return $return;
	
}

function gtask_register_menu_filter_hook($hook, $type, $return, $params) {

    $check_hook = ($hook == 'register');
    $check_type = ($type == 'menu:filter');
    $check_context = (elgg_in_context('gtask'));

    if ($check_hook && $check_type && $check_context) {
        $page_owner = elgg_get_page_owner_entity();
        
        if ($page_owner instanceof ElggUser) {
            foreach($return as $key => $menu_item) {
                $name = $menu_item->getName();
                
                switch ($name) {
                    case 'all':
                    case 'friend':
                        unset($return[$key]);
                        break;
                }
            }
        }
    }

    return $return;

}

elgg_register_event_handler('init', 'system', 'gtask_init');