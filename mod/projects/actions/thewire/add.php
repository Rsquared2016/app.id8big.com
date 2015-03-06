<?php

/**
 * Action for adding a wire post
 * 
 */
// don't filter since we strip and filter escapes some characters
$body = get_input('body', '', false);

$access_id = ACCESS_PUBLIC;
$method = 'site';
$parent_guid = (int) get_input('parent_guid');

// make sure the post isn't blank
if (empty($body)) {
	register_error(elgg_echo("thewire:blank"));
	forward(REFERER);
}

$container_guid = get_input('container_guid');
$container = get_entity($container_guid);
if (!elgg_instanceof($container, 'group', 'project')) {
	$parent = get_entity($parent_guid);

	if (elgg_instanceof($parent, 'object', 'thewire')) {
		$container = $parent->getContainerEntity();
	}
}

if (elgg_instanceof($container, 'group', 'project')) {
	$container_guid = $container->getGUID();

	$group_acl = $container->group_acl;
	$group_access_id = $container->access_id;

//	if ($group_acl == $group_access_id) {
		$access_id = $group_acl;
//	} else {
//		$access_id = PROJECTS_DEFAULT_VISIBLE_ACCESS;
//	}

	$guid = project_thewire_save_post($body, elgg_get_logged_in_user_guid(), $container_guid, $access_id, $parent_guid, $method);
} else {
	$guid = thewire_save_post($body, elgg_get_logged_in_user_guid(), $access_id, $parent_guid, $method);
}
if (!$guid) {
	register_error(elgg_echo("thewire:error"));
	forward(REFERER);
}

// Send response to original poster if not already registered to receive notification
if ($parent_guid) {
	thewire_send_response_notification($guid, $parent_guid, $user);
	$parent = get_entity($parent_guid);
	forward("thewire/thread/$parent->wire_thread");
}

system_message(elgg_echo("thewire:posted"));
forward(REFERER);
