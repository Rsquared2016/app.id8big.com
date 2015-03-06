<?php
/**
 * Elgg user owner_block
 * @uses $vars['entity'] The user entity
 */

echo elgg_view('profile/owner_block_no_profile_manager', $vars);

//if (elgg_is_active_plugin('profile_manager')) {
////	elgg_set_view_location('profile/owner_block', elgg_get_plugins_path().'profile_manager/views/');
////	echo elgg_view('profile/owner_block', $vars);
//	echo elgg_view('profile/profile_manager/owner_block', $vars);
//} else {
//	echo elgg_view('profile/owner_block_no_profile_manager', $vars);
//}