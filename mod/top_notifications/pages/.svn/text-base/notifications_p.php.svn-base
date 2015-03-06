<?php

/*
 * List notifications
 */

// Set page owner
//$page_owner = elgg_get_page_owner_entity();
//if ($page_owner === false || is_null($page_owner)) {
//	set_page_owner(elgg_get_logged_in_user_guid());
//}

$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

// Get notifications
$count_notifications = top_notifications_get_notifications(array('count' => TRUE));
$notifications = top_notifications_get_notifications(array('offset' => $offset, 'limit' => $limit));

//Main Title section
$title = elgg_echo("top_notifications:activity:title");

$body = '';
//$body .= elgg_view('top_notifications/main_title', array('title' => $title));

// List notifications
$body .= elgg_view('top_notifications/wrapper', array('notifications' => $notifications));

// Pagination
$body .= elgg_view('navigation/pagination', array('offset' => $offset, 'limit' => $limit, 'count' => $count_notifications));

$vars = array(
	'title' => $title,
	'content' => $body,
	'sidebar' => '',
	'filter_override' => '',
);

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);