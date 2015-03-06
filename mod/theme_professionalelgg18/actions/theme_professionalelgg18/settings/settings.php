<?php

admin_gatekeeper();

// Get values
$three_column_support = get_input('three_column_support', 'no', FALSE);
$full_width_support = get_input('full_width_support', 'no', FALSE);
$responsive_support = get_input('responsive_support', 'no', FALSE);
//$use_dynamic_menu = get_input('use_dynamic_menu', 'yes', FALSE);
$use_widgets_profile_groups_as_tabs = get_input('use_widgets_profile_groups_as_tabs', 'yes', FALSE);
$profile_groups_show_more_tab = get_input('profile_groups_show_more_tab', 0, FALSE);
$show_content_comment_activity = get_input('show_content_comment_activity', 0, FALSE);

// Save them.
$success = elgg_set_plugin_setting('three_column_support', $three_column_support, THEME_NAME);
/*
if($success) {
	$success = elgg_set_plugin_setting('use_dynamic_menu', $use_dynamic_menu, THEME_NAME);
}
*/
if($success) {
	$success = elgg_set_plugin_setting('full_width_support', $full_width_support, THEME_NAME);
}
if($success) {
	$success = elgg_set_plugin_setting('responsive_support', $responsive_support, THEME_NAME);
}
if($success) {
	$success = elgg_set_plugin_setting('use_widgets_profile_groups_as_tabs', $use_widgets_profile_groups_as_tabs, THEME_NAME);
}
if($success) {
	$success = elgg_set_plugin_setting('profile_groups_show_more_tab', $profile_groups_show_more_tab, THEME_NAME);
}
if($success) {
	$success = elgg_set_plugin_setting('show_content_comment_activity', $show_content_comment_activity, THEME_NAME);
}

if($success) {
	system_message('Settings saved');
} else {
	register_error('There was an error saving, please try again');
}

forward(REFERER);