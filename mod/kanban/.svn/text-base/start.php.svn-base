<?php

/**
 * @package LeanCanvasBoard
 * 
 * @author Bortoli German for Keetup Development <info@keetup.com>
 */

define('KANBAN_PATH', dirname(__FILE__).'/');
define('KANBAN_URL', elgg_normalize_url('mod/kanban/'));
define('KANBAN_GRAPHICS', KANBAN_URL.'graphics/');

elgg_register_event_handler('init', 'system', 'kanban_init');

/**
 * Lean Canvas Board: Init
 */
function kanban_init() {
	// Group Support
	elgg_extend_view('groups/tool_latest', 'kanban/main_wrapper');

	// Page Handler
	elgg_register_page_handler('kanban', 'kanban_page_handler');

	//CSS
	elgg_register_css('elgg.kanban', elgg_get_simplecache_url('css', 'kanban'));
	elgg_register_simplecache_view('css/kanban');
	
	//JS
	elgg_register_js('elgg.kanban', elgg_get_simplecache_url('js', 'kanban'));
	elgg_register_simplecache_view('js/kanban');
	elgg_register_js('elgg.highlight', 'mod/kanban/vendors/highlight.js');
	
	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'kanban_register_menu_profile_groups_tabs_hook');
	elgg_register_plugin_hook_handler('register', 'menu:title', 'kanban_register_menu_title_hook');
	
	// Actions
	elgg_register_action('kanban/save_max_tasks', dirname(__FILE__) . '/actions/kanban/save_max_tasks_a.php');
}

/**
 * Kanabn: Page Handler
 */
function kanban_page_handler($page) {

	// Base path
	$base_path = dirname(__FILE__) . '/pages/kanban/';
	$controller = elgg_extract('0', $page);

	switch ($controller) {
		case 'view':
			$page_owner = elgg_extract('1', $page);
			elgg_set_page_owner_guid($page_owner);
			require_once $base_path . '/group_board.php';
			break;
	}

	return true;
}

/**
 * Kanban: Register Menu Profile Groups Tabs Hook
 */
function kanban_register_menu_profile_groups_tabs_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:project_profile_menu');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project')) {
			$project_gatekeeper = false;
			if (is_callable('project_gatekeeper')) {
				$project_gatekeeper = project_gatekeeper(false);
				
//				if ($project_gatekeeper) {
//					// Is visitor?
//					$is_visitor = $page_owner->isVisitor();
//					if ($is_visitor) {
//						$project_gatekeeper = false;
//					}
//				}
			}
			
			$gtasks_support = false;
			if (elgg_is_active_plugin('gtask') && $page_owner->gtask_enable == 'yes') {
				$gtasks_support = true;
			}
		
			// Menu item
			if ($project_gatekeeper && $gtasks_support) {
				$selected = false;
				if (elgg_in_context('kanban') || elgg_in_context('gtask')) {
					$selected = true;
				}
				
				$name = 'kanban';
				$text = elgg_echo('kanban:tabs:kanban:title');
				$href = elgg_get_site_url(). 'kanban/view/' . $page_owner->getGUID();
				$menu_item = new ElggMenuItem($name, $text, $href);
				$menu_item->setPriority(535);
				$menu_item->setSelected($selected);
				$return[] = $menu_item;
			}
		}
	}
	
	return $return;
	
}

function kanban_register_menu_title_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:title');
	
	if ($check_hook && $check_type) {
		foreach($return as $key => $menu_item) {
			$name = $menu_item->getName();
			
			switch ($name) {
				case 'add':
					$link_class = $menu_item->getLinkClass();
					$link_class .= ' js_kanban_task_add';
					$menu_item->setLinkClass($link_class);
					break;
			}
		}
	}
	
	return $return;
	
}