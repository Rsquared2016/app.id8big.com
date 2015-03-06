<?php

/*
 * Check for new notifications
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/engine/start.php');

global $CONFIG;

$user_loggedin = elgg_get_logged_in_user_entity();

if ($user_loggedin) {
	$data = array();
	
	$count_news_notifications = top_notifications_get_notifications(array('unread' => TRUE, 'count' => TRUE));
	$data['count'] = $count_news_notifications;
	
	if ($count_news_notifications) {		
		$notifications = top_notifications_get_notifications(array('limit' => 5));
		if ($notifications) {
			$content = '';
			foreach ($notifications as $notif) {
				$content .= elgg_view($notif->view, array('notification' => $notif));
			}
			
			$data['notifications'] = $content;
		}
	}
	
	echo json_encode($data);
	return;
}