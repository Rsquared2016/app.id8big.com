<?php

/**
 * help
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

define('Help_ENABLE_DEMO', false);

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/help_lib.php');
require_once(dirname(__FILE__) . '/lib/main.php');

function help_init() {
	
	// Initializate the plugin
	//help_initializateplugin();
	
	// Page Handler
	elgg_register_page_handler('help', 'help_page_handler');
	elgg_register_entity_url_handler('object', 'help', 'help_url');

	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'help_page_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'help_owner_block_menu');
	elgg_register_plugin_hook_handler('register', 'menu:page', 'help_menu_page');
	elgg_register_plugin_hook_handler('register', 'menu:filter', 'help_menu_filter');

	// JS
	elgg_register_js('form.placeholder.js', 'mod/help/vendors/placeholder/jquery.placeholder.min.js');
	
	// Menu
	$listing_item = new ElggMenuItem('help', elgg_echo('help:plugin:menu:title'), 'help');
	elgg_register_menu_item('site', $listing_item);
	
	// Widgets
	elgg_register_widget_type('help', elgg_echo('help'), elgg_echo('help:widget:description'));
	
	// Groups
	if (elgg_get_plugin_setting('group_support', 'help') == 'yes') {
		add_group_tool_option('help', elgg_echo('help:enablehelp'), TRUE);
		elgg_extend_view('groups/tool_latest', 'help/group_module');
	}
	
	elgg_register_js('help', 'js/help.js', 'footer');
	
}

function help_menu_filter($hook, $type, $return, $params) {
	
	$context = elgg_get_context();
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:filter');
	$check_context = ($context == 'help');
	
	if ($check_hook && $check_type && $check_context) {
		// Remove friend tab
		foreach($return as $item_key => $item) {
			if($item->getName() == 'friend') {
				unset($return[$item_key]);
			}
		}
		
	}
	
	return $return;
	
}

/**
 * Add a page menu menu.
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function help_menu_page($hook, $type, $return, $params) {
	if (elgg_is_admin_logged_in()) {
		// only show bookmarklet in bookmark pages
		if (elgg_in_context('help')) {
			$title = elgg_echo('help:admin_page:title');
			$return[] = new ElggMenuItem('help_admin_page', $title, 'help/list_admin/');
			
			$title = elgg_echo('help:users_page:title');
			$return[] = new ElggMenuItem('help_users_page', $title, 'help/');
		}
	}

	return $return;
}

/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost Help post entity
 * @return string Help post URL
 */
function help_url($entity) {

	global $CONFIG;
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
	$public_help = get_input('public_help', FALSE);
	
	if($public_help) {
		return $CONFIG->url . "pg/help/" . $entity->getGUID() . "/" . $title;
	} else {
		return $CONFIG->url . "pg/help/view/" . $entity->getGUID() . "/" . $title;
	}
}

/**
 *  All help:			help/all
 *  User's help:		help/owner/<username>
 *  Friends' help:		help/friends/<username>
 *  View help:			help/view/<guid>/<title>
 *  New help:			help/add/<guid> (container: user, group, parent)
 *  Edit help:			help/edit/<guid>
 *  Group help:			help/group/<guid>/owner
 */
function help_page_handler($page) {
	
	global $CONFIG;
	
	elgg_load_js('help');
	
	switch ($page[0]) {
		case 'add':
			admin_gatekeeper();
			!@include_once(dirname(__FILE__) . "/pages/help/edit_p.php");
			return true;

			break;

		case 'edit':
			admin_gatekeeper();
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/help/edit_p.php");
			return true;

			break;

		case 'list_admin':
			admin_gatekeeper();
			if(isset ($page[2])) {
				switch ($page[2]) {
					case 'owner':
						set_input('username', $page[2]);
						set_input('entity_owner_filter', 'mine');

						!@include_once(dirname(__FILE__) . "/pages/help/list_p.php");
						return true;

						break;
					
					case 'friends':
						set_input('entity_owner_filter', 'friends');
						!@include_once(dirname(__FILE__) . "/pages/help/list_p.php");
						return true;

						break;
				}
			}
			
			set_input('entity_owner_filter', 'all');
			!@include_once(dirname(__FILE__) . "/pages/help/list_p.php");
			return true;
			
			break;
		
		
		case 'owner':
			admin_gatekeeper();
			set_input('username', $page[1]);
			set_input('entity_owner_filter', 'mine');

			!@include_once(dirname(__FILE__) . "/pages/help/list_p.php");
			return true;

			break;
		/*case 'friends':
			set_input('entity_owner_filter', 'friends');
			!@include_once(dirname(__FILE__) . "/pages/help/list_p.php");
			return true;

			break;*/

		case 'view':
			admin_gatekeeper();
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/help/profile_p.php");
			return true;
			break;
		/*case 'group':
			set_input('guid', $page[1]);
			set_input('entity_owner_filter', 'mine');
			!@include_once(dirname(__FILE__) . "/pages/help/list_p.php");
			return true;
			break;*/

		default:
			if (is_numeric($page[0])) {
				set_input('guid', $page[0]);
				!@include_once(dirname(__FILE__) . "/pages/help/list_public_p.php");
				return true;
			} else {
				set_input('entity_owner_filter', 'all');
				!@include_once(dirname(__FILE__) . "/pages/help/list_public_p.php");
				return true;
			}

			break;
	}
}

function help_page_menu($hook, $type, $return, $params) {
	
	$entity = elgg_extract('entity', $params);
	$view_type = elgg_extract('view_type', $params);

	if (elgg_instanceof($entity, 'object', 'help') && $view_type == 'listing') {
		
		$extra_fields = HelpBaseMain::ktform_get_extra_listing_fields('help');

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
						 'name' => "help:listing:title:{$internalname}",
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
function help_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "help/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('pages', elgg_echo('help'), $url);
		$return[] = $item;
	}
	else {
		if (elgg_get_plugin_setting('group_support', 'help') == 'yes' && $params['entity']->help_enable != "no") {
			$url = "help/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('pages', elgg_echo('help:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
	
}

elgg_register_event_handler('init', 'system', 'help_init');