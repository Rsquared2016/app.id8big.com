<?php

/*
 * Ajax Action
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

$callback = get_input('callback', 0);
$friend_id = get_input('friend_id', 0);
$circle_id = get_input('circle_id', 0);

$json_data = array();

// check it exists and we can edit
if (!can_edit_access_collection($circle_id) || !elgg_is_logged_in()) {
	$json_data['error'] = elgg_echo('circles:error:add:friend');
	echo json_encode($json_data);
	exit;
}

$cur_friends = get_members_of_access_collection($circle_id, true);
$friends = array_diff($cur_friends, array($friend_id));

if (update_access_collection($circle_id, $friends)) {
	$json_data['count_friends'] = count($friends);
	$json_data['error'] = false;
	$json_data['success_msg'] = elgg_echo('circles:success:delete:friend');
} else {
	$json_data['error'] = elgg_echo('circles:error:delete:friend');
}

echo json_encode($json_data);
exit;