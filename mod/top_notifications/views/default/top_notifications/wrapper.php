<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($vars['notifications'])) {
	return false;
}
$notifications = $vars['notifications'];

$content = '<div class="notificationWrapper">';

if ($notifications) {
	foreach($notifications as $notif) {
		$content .= elgg_view($notif->view, array('notification' => $notif));
	}
}
else {
	$content .= "<p>". elgg_echo('top_notifications:activity:empty') . "</p>";
}
$content .= '</div>';

echo $content;