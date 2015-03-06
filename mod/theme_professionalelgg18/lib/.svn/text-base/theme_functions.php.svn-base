<?php

/**
 * Return if we have 3 columns support in theme
 * @return string 
 */
function theme_get_three_columns_support() {
	return (elgg_get_plugin_setting('three_column_support', THEME_NAME) == 'yes');
}

function theme_get_full_width_support() {
	return (elgg_get_plugin_setting('full_width_support', THEME_NAME) == 'yes');
}

function theme_get_responsive_support() {
	return (elgg_get_plugin_setting('responsive_support', THEME_NAME) == 'yes');
}

/**
 * Return if the slideshow is enabled
 * @return string 
 */
function theme_slideshow_enabled() {
	return THEME_SLIDESHOW_ENABLED;
}

/**
 * Return a list of how many users are currently online, rendered as a view.
 *
 * @return string
 */
function theme_get_online_users() {
	$offset = get_input('offset', 0);
	$count = find_active_users(600, 10, $offset, true);
	$objects = find_active_users(600, 10, $offset);

	if ($objects) {
		return elgg_view_entity_list($objects, array(
						'count' => $count,
						'offset' => $offset,
						'limit' => 10,
						'class' => 'membersListItem',
				  ));
	}
}

/**
 * Unregister menu items from topbar, because we dont need them in this theme
 */

function theme_exclude_topbar_items() {
	$exclude_items = array(
		 'administration',
		 'usersettings',
		 'logout',
		 'elgg_logo',
		 'profile',
	);
	
	foreach($exclude_items as $item_name) {	
		elgg_unregister_menu_item('topbar', $item_name);
	}
	
}


function theme_get_use_dynamic_menu() {
	return (elgg_get_plugin_setting('use_dynamic_menu', THEME_NAME) == 'yes');
}

/**
 * Get use widgets profile groups as tabs
 * 
 * Default: yes
 */
function theme_get_use_widgets_profile_groups_as_tabs() {
	
	$use_widgets_profile_groups_as_tabs = elgg_get_plugin_setting('use_widgets_profile_groups_as_tabs', THEME_NAME);
	
	if ($use_widgets_profile_groups_as_tabs == 'no') {
		return false;
	}
	
	return true;
}

/**
 * Get profile_groups_show_more_tab
 * 
 * Default: yes
 */
function theme_get_profile_groups_show_more_tab() {
	
	$profile_groups_show_more_tab = elgg_get_plugin_setting('profile_groups_show_more_tab', THEME_NAME);
	
	if (empty($profile_groups_show_more_tab)) {
		$profile_groups_show_more_tab = 0;
	}
	
	return $profile_groups_show_more_tab;
}

/**
 * Get profile_groups_show_more_tab
 * 
 * Default: yes
 */
function theme_get_show_content_comment_activity() {
	
	$show_content_comment_activity = elgg_get_plugin_setting('show_content_comment_activity', THEME_NAME);
	
	if ($show_content_comment_activity == 'yes') {
		$show_content_comment_activity = true;
	}
	else {
		$show_content_comment_activity = false;
	}
	
	return $show_content_comment_activity;
}