<?php

/**
 * Add a bridge between custom groups and default group module
 * This classes is a function library collection
 *
 * @author german
 */
class MultiGroupsSupport {

	public static function enableThemeSupport() {

		if (!elgg_is_active_plugin('theme_professionalelgg18')) {
			return FALSE;
		}

		self::registerProjectThemeHooks();
	}

	public static function registerProjectThemeHooks() {
		if (!is_callable('theme_get_use_widgets_profile_groups_as_tabs')) {
			return FALSE;
		}

		elgg_register_plugin_hook_handler('view', 'navigation/menu/default', 'mg_theme_projects_view_navigation_menu_default_hook');
		if (theme_get_use_widgets_profile_groups_as_tabs()) {
			elgg_register_plugin_hook_handler('view', 'projects/profile/widgets', 'mg_theme_projects_view_groups_profile_widgets_hook');
			elgg_register_plugin_hook_handler('view', 'page/components/module', 'mg_theme_projects_view_page_components_module_hook');
			elgg_register_plugin_hook_handler('view', 'projects/profile/module', 'mg_theme_projects_view_groups_profile_module_hook');
			elgg_register_plugin_hook_handler('view', 'discussion/project_module', 'mg_theme_projects_view_discussion_group_module_hook');
			elgg_register_plugin_hook_handler('forward', 'system', 'mg_theme_projects_forward_system_hook');
			elgg_register_plugin_hook_handler('action', 'project_discussion/save', 'mg_theme_projects_action_discussion_save_hook');
		}

		return TRUE;
	}

	public static function cleanGroupsTools($handler) {
		
		remove_group_tool_option('forum');
		
		
		switch ($handler) {
			case 'projects':
				remove_group_tool_option('activity');
				add_group_tool_option('forum', elgg_echo('projects:enableforum'), TRUE);
				
				if (elgg_is_active_plugin('blog')) {
					remove_group_tool_option('blog');
					add_group_tool_option('blog', elgg_echo('projects:enableblog'), TRUE);
				}
				
				if (elgg_is_active_plugin('file')) {
					remove_group_tool_option('file');
//					add_group_tool_option('file', elgg_echo('projects:enablefile'), TRUE);
				}
				if (elgg_is_active_plugin('pages')) {
					remove_group_tool_option('pages');
					add_group_tool_option('pages', elgg_echo('projects:enablepages'), TRUE);
				}
				break;

			default:
				remove_group_tool_option('project_activity');
				remove_group_tool_option('project_thewire');
				remove_group_tool_option('gdrive');
                remove_group_tool_option('gtask');
				add_group_tool_option('forum', elgg_echo('groups:enableforum'), TRUE);
				break;
		}
	}
	
	public static function unregisterPageOwnerMenues() {
		elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'multigroup_activity_owner_block_menu');
	}

}

