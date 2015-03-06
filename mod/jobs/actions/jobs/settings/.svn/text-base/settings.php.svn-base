<?php


//Get settings
$users_types_can_post = get_input('users_types_can_post', '');

if($users_types_can_post) {
	$users_types_can_post = serialize($users_types_can_post);
}
$success = elgg_set_plugin_setting('users_types_can_post', $users_types_can_post, 'jobs');

if($success) {
	system_message(elgg_echo('jobs:settings:settings:saved'));
} else {
	register_error(elgg_echo('jobs:settings:settings:failed'));
}
forward(REFERER);