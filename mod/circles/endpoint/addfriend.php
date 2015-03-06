<?php
/**
* circles
*
* Ajax Action description here...
* 
* @author German Scarel
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
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

// get the members of the circle
$cur_friends = get_members_of_access_collection($circle_id, true);

// check if the friend is a member of the circle
if (in_array($friend_id, $cur_friends)) {
	$json_data['error'] = elgg_echo('circles:error:member:yes');
	echo json_encode($json_data);
	exit;
}

// add friend to the circle
$cur_friends[] = $friend_id;
if (update_access_collection($circle_id, $cur_friends)) {
	$json_data['count_friends'] = count($cur_friends);
	$json_data['error'] = false;
	$json_data['success_msg'] = elgg_echo("circles:success:add:friend");
} else {
	$json_data['error'] = elgg_echo("circles:error:add:friend");
}

echo json_encode($json_data);
exit;