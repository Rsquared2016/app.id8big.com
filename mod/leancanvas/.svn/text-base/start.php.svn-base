<?php

/**
 * @package LeanCanvasBoard
 * 
 * @author Bortoli German for Keetup Development <info@keetup.com>
 */

define('LEANCANVAS_PATH', dirname(__FILE__).'/');
define('LEANCANVAS_URL', elgg_normalize_url('mod/leancanvas/'));
define('LEANCANVAS_GRAPHICS', LEANCANVAS_URL.'graphics/');

elgg_register_event_handler('init', 'system', 'leancanvas_init');

/**
 * Lean Canvas Board: Init
 */
function leancanvas_init() {
	
	// Subtype
	add_subtype('object', 'lean_objective', 'leanObjective');
	
	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'leancanvas_register_menu_profile_groups_tabs_hook');
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'leancanvas_permissions_check_hook');
	elgg_register_plugin_hook_handler('view', 'annotation/default', 'leancanvas_view_annotation_default_hook');
	elgg_register_plugin_hook_handler('register', 'menu:annotation', 'leancanvas_register_menu_annotation_hook');
	
	//Actions
	elgg_register_action('leancanvas/add_objective', LEANCANVAS_PATH.'actions/lean_objective/edit_a.php');
	elgg_register_action('leancanvas/delete_objective', LEANCANVAS_PATH.'actions/lean_objective/delete_a.php');
	elgg_register_action('leancanvas/add_comment', LEANCANVAS_PATH.'actions/comments/add_a.php');
	elgg_register_action('leancanvas/delete_comment', LEANCANVAS_PATH.'actions/comments/delete_a.php');
	
	// Page Handler
	elgg_register_page_handler('leancanvas', 'leancanvas_page_handler');

	//CSS
	elgg_register_css('elgg.leancanvas', elgg_get_simplecache_url('css', 'leancanvas'));
	elgg_register_simplecache_view('css/leancanvas');
	
	//JS
	elgg_register_js('elgg.leancanvas', elgg_get_simplecache_url('js', 'leancanvas'));
	elgg_register_simplecache_view('js/leancanvas');
	elgg_register_js('socket.io', 'mod/leancanvas/vendors/socket.io/socket.io.js');
    elgg_register_js('leancanvas.client', 'mod/leancanvas/js/client.js', 'footer');
    elgg_register_js('block_ui', 'mod/leancanvas/js/block_ui.js');
	
	// Group Support
	elgg_extend_view('groups/tool_latest', 'leancanvas/main_wrapper');
	
	// Load
	elgg_load_css('lightbox');
	elgg_load_js('lightbox');

}

/**
 * Repository Viewer: Page Handler
 */
function leancanvas_page_handler($page) {

	// Base path
	$base_path = dirname(__FILE__) . '/pages/leancanvas/';
	$controller = elgg_extract('0', $page);

	switch ($controller) {
		case 'view':
			$page_owner = elgg_extract('1', $page);
			elgg_set_page_owner_guid($page_owner);
			require_once $base_path . '/group_board.php';
			break;
		case 'comments':
			$page_owner = elgg_extract('1', $page);
			elgg_set_page_owner_guid($page_owner);
			$section_id = elgg_extract('2', $page);
			set_input('section_id', $section_id);
			require_once $base_path . '/comments.php';
			break;
	}

	return true;
}


function leancanvas_permissions_check_hook($hook, $type, $return, $params) {
	$entity = elgg_extract('entity', $params);
	$user = elgg_extract('user', $params);
	
	if (($entity instanceof leanObjective) && ($user instanceof ElggUser)) {
		$user_guid = $user->getGUID();
		
		$container_entity = $entity->getContainerEntity();
		if ($container_entity instanceof ElggGroup) {
			
			if ($container_entity->canWriteToContainer($user_guid)) {
				return TRUE;
			}
			
		}
		
	}
	
	return $return;
}

/**
 * Lean Canvas: Register Menu Profile Groups Tabs Hook
 */
function leancanvas_register_menu_profile_groups_tabs_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:project_profile_menu');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project')) {
			$project_gatekeeper = false;
			if (is_callable('project_gatekeeper')) {
				$project_gatekeeper = project_gatekeeper(false);
			}
			
			$has_lean_canvas = $page_owner->hasLeanCanvas();
			
			// Tiene url github?
			if ($project_gatekeeper && $has_lean_canvas) {				
				$options = array(
					'name' => 'leancanvas',
					'text' => elgg_echo('leancanvas:tabs:leancanvas'),
					'href' => 'leancanvas/view/' . $page_owner->getGUID(),
					'priority' => 525,
					'selected' => elgg_in_context('leancanvas'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}

function leancanvas_view_annotation_default_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'annotation/default');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		$vars = $params['vars'];
		
		if ($page_owner instanceof ProjectGroup &&  $vars) {
			$annotation_names = elgg_extract('annotation_names', $vars, '');
			$section_id = elgg_extract('section_id', $vars, '');
			
			$lean_canvas = new leanCanvas($page_owner);
			$annot = $lean_canvas->getAnnotationNameOfCommentForSection($section_id);
			
			if ($annotation_names == $annot) {
				$return = elgg_view('annotation/generic_comment', $vars);
			}
		}
	}
	
	return $return;
	
}

function leancanvas_register_menu_annotation_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:annotation');
	
	if ($check_hook && $check_type) {
		$annotation = elgg_extract('annotation', $params, false);
		
		if ($annotation instanceof ElggAnnotation && $annotation->canEdit()) {
			$entity = get_entity($annotation->entity_guid);
			
			if ($entity instanceof ProjectGroup) {
				$lean_canvas = new leanCanvas($entity);
				
				$is_valid = $lean_canvas->isAnnotationNameOfCommentForSection($annotation->name);
				
				if ($is_valid) {
					$url = elgg_http_add_url_query_elements('action/leancanvas/delete_comment', array(
						'annotation_id' => $annotation->id,
					));

					$options = array(
						'name' => 'delete',
						'href' => $url,
						'text' => "<span class=\"elgg-icon elgg-icon-delete\"></span>",
						'rel' => elgg_echo('deleteconfirm'),
						'encode_text' => false,
						'class' => 'delete_comment',
					);
					$return[] = ElggMenuItem::factory($options);
				}
			}
		}
	}
	
	return $return;
	
}


function leancanvas_get_nodejs_url() {
	
	$plugin = elgg_get_plugin_from_id('leancanvas');
	
	if ($plugin instanceof ElggPlugin) {
		$host = $plugin->getSetting('host');
		
		if (empty($host)) {
			return "http://localhost:8080/";
		}
		
		return $host;
	}
}