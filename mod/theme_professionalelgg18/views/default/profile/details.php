<?php
/**
 * Elgg user display (details)
 * @uses $vars['entity'] The user entity
 */

if (elgg_is_active_plugin('profile_manager')) {
//	elgg_set_view_location('profile/details', elgg_get_plugins_path().'profile_manager/views/');
//	echo elgg_view('profile/details', $vars);
	echo elgg_view('profile/profile_manager/details', $vars);
} else {
	echo elgg_view('profile/details_no_profile_manager', $vars);
}