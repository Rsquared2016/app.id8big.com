<?php

/**
 * @package CompassBoard
 * 
 * @author Diego Gallardo for Keetup Development <info@keetup.com>
 */

define('COMPASS_PATH', dirname(__FILE__).'/');
define('COMPASS_URL', elgg_normalize_url('mod/compass/'));
define('COMPASS_GRAPHICS', COMPASS_URL.'graphics/');

elgg_register_event_handler('init', 'system', 'compass_init');

//Load some libs
require_once COMPASS_PATH . 'lib/functions.php';

/**
 * Lean Canvas Board: Init
 */
function compass_init() {
	// Group Support
	elgg_extend_view('groups/tool_latest', 'compass/main_wrapper');

	// Page Handler
	elgg_register_page_handler('compass', 'compass_page_handler');

	//CSS
	elgg_register_css('elgg.compass', elgg_get_simplecache_url('css', 'compass'));
	elgg_register_simplecache_view('css/compass');
	
	//JS
	elgg_register_js('elgg.compass', elgg_get_simplecache_url('js', 'compass'));
	elgg_register_simplecache_view('js/compass');
	elgg_register_js('elgg.highlight', 'mod/compass/vendors/highlight.js');
	
	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'compass_register_menu_profile_groups_tabs_hook');
	
	// Actions
	//elgg_register_action('compass/save_max_tasks', dirname(__FILE__) . '/actions/compass/save_max_tasks_a.php');
	elgg_register_action('compass/changestatus', dirname(__FILE__) . '/actions/compass/changestatus_a.php');
	elgg_register_action('compass/add_comment', dirname(__FILE__) . '/actions/compass/comments/add.php');
	elgg_register_action('compass/comments/delete', dirname(__FILE__) . '/actions/compass/comments/delete.php');
	elgg_register_plugin_hook_handler('register', 'menu:annotation', 'compass_annotation_menu_setup');
}

/**
 * Adds a delete link to "generic_comment" annotations
 * @access private
 */
function compass_annotation_menu_setup($hook, $type, $return, $params) {
	$annotation = $params['annotation'];

	$types = Compass::getCommentTypes();
	if (in_array($annotation->name, $types) && $annotation->canEdit()) {
		$url = elgg_http_add_url_query_elements('action/compass/comments/delete', array(
			'annotation_id' => $annotation->id,
		));

		$options = array(
			'name' => 'delete',
			'href' => $url,
			'text' => "<span class=\"elgg-icon elgg-icon-delete\"></span>",
			//'confirm' => elgg_echo('deleteconfirm'),
			'rel' => elgg_echo('deleteconfirm'),
			'class' => 'delete_compass_comment',
			'encode_text' => false
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}

/**
 * Kanabn: Page Handler
 */
function compass_page_handler($page) {

	// Base path
	$base_path = dirname(__FILE__) . '/pages/compass/';
	$controller = elgg_extract('0', $page);

	switch ($controller) {
		case 'view':
			$page_owner = elgg_extract('1', $page);
			elgg_set_page_owner_guid($page_owner);
			require_once $base_path . '/group_board.php';
			break;
		case 'note':
		case 'experiment':
        case 'riskiest_assumption':
        case 'expected_outcome':
        case 'key_metrics_measured':
        case 'task':
        case 'whats_the_next_step':
        case 'result':
			$page_owner = elgg_extract('1', $page);
			elgg_set_page_owner_guid($page_owner);
			
			$entity_guid = elgg_extract('2', $page);
			set_input('entity_guid', $entity_guid);
			set_input('comments_type', $controller);
			
			require_once $base_path . '/comments.php';
			break;
	}

	return true;
}

/**
 * Compass: Register Menu Profile Groups Tabs Hook
 */
function compass_register_menu_profile_groups_tabs_hook($hook, $type, $return, $params) {
	
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
			if (elgg_is_active_plugin('leancanvas') && $page_owner->leancanvas == 'yes') {
				$gtasks_support = true;
			}
		
			// Menu item
			if ($project_gatekeeper && $gtasks_support) {
				$selected = false;
				if (elgg_in_context('compass')) {
					$selected = true;
				}
				
				$name = 'compass';
				$text = elgg_echo('compass:tabs:compass:title');
				$href = elgg_get_site_url(). 'compass/view/' . $page_owner->getGUID();
				$menu_item = new ElggMenuItem($name, $text, $href);
				$menu_item->setPriority(530);
				$menu_item->setSelected($selected);
				$return[] = $menu_item;
			}
		}
	}
	
	return $return;
	
}