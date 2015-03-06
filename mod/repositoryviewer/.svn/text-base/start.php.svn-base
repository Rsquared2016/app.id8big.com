<?php

/**
 * Rerpository Viewer
 */

elgg_register_event_handler('init', 'system', 'repositoryviewer_init');

/**
 * Repository Viewer: Init
 */
function repositoryviewer_init() {
	
	// Page Handler
	elgg_register_page_handler('repositoryviewer', 'repositoryviewer_page_handler');
	
	// Extend views
	elgg_extend_view('css/elgg', 'repositoryviewer/css');
	
	// JS
	elgg_register_js('repo.js', 'mod/repositoryviewer/vendors/repojs/repo.js');
	elgg_load_js('repo.js');
	
	// Group Support
	elgg_extend_view('groups/tool_latest', 'repositoryviewer/group_module');
	
	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:profile_groups_tabs', 'repositoryviewer_register_menu_profile_groups_tabs_hook');
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'repositoryviewer_register_menu_profile_groups_tabs_hook');
	
}

/**
 * Repository Viewer: Page Handler
 */
function repositoryviewer_page_handler($page) {
	
	// Base path
	$base_path = elgg_get_plugins_path() . 'repositoryviewer/pages/respositoryviewer';
	
	switch($page[0]) {
		case 'view':
			$page_owner = elgg_extract('1', $page);
			elgg_set_page_owner_guid($page_owner);
			require_once $base_path . '/view.php';
			break;
		default:
			require_once $base_path . '/index.php';
			break;
	}
	
	return true;
	
}

/**
 * Repository Viewer: Get Info From Url
 */
function repositoryviewer_get_info_from_url($url) {
	
	$info = array();
	
	if (empty($url) || !is_string($url)) {
		return $info;
	}
	
	if (preg_match('/(http:\/\/)?(www\.)?(github.com\/)(.*)\/(.*)/', $url, $matches)) {
		if (!empty($matches) && is_array($matches)) {
			$count = count($matches);
			$info['repository_user'] = $matches[$count - 2];
			$info['repository_name'] = $matches[$count - 1];
		}
	}
	
	return $info;
	
}

/**
 * Repository Viewer: Register Menu Profile Groups Tabs Hook
 */
function repositoryviewer_register_menu_profile_groups_tabs_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:profile_groups_tabs' || $type == 'menu:project_profile_menu');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project')) {
			$project_gatekeeper = false;
			if (is_callable('project_gatekeeper')) {
				$project_gatekeeper = project_gatekeeper(false);
			}
			
			// Tiene url github?
			if (!empty($page_owner->source_url) && $project_gatekeeper) {
				$options = array(
					'name' => 'repositoryviewer',
					'text' => elgg_echo('repositoryviewer:tabs:repositoryviewer'),
					'href' => 'repositoryviewer/view/' . $page_owner->getGUID(),
					'priority' => 560,
					'selected' => elgg_in_context('repositoryviewer'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}