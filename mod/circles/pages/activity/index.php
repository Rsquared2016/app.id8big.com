<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$is_xhr = elgg_is_xhr();
if (!$is_xhr) {
	forward();
}

$user = elgg_get_logged_in_user_entity();

// Active activity share?
$active_activity_share = elgg_is_active_plugin('activity_share');

$options = array();

$page_type = preg_replace('[\W]', '', get_input('page_type', 'all'));
$type = preg_replace('[\W]', '', get_input('type', 'all'));
$subtype = preg_replace('[\W]', '', get_input('subtype', ''));
$circle_id = preg_replace('[\W]', '', get_input('circle_id', ''));
if ($subtype) {
	$selector = "type=$type&subtype=$subtype";
} else {
	$selector = "type=$type";
}

if ($type != 'all') {
	$options['type'] = $type;
	if ($subtype) {
		$options['subtype'] = $subtype;
	}
}

switch ($page_type) {
	case 'mine':
		$title = elgg_echo('river:mine');
		$page_filter = 'mine';
		$options['subject_guid'] = elgg_get_logged_in_user_guid();
		break;
	case 'friends':
		$title = elgg_echo('river:friends');
		$page_filter = 'friends';
		$options['relationship_guid'] = elgg_get_logged_in_user_guid();
		$options['relationship'] = 'friend';
		break;
	case 'circles':
		$subject_guid = get_members_of_access_collection($circle_id, true);
		if (!$subject_guid) {
			$subject_guid = 0;
		}
		$options['subject_guid'] = $subject_guid;
		break;
	default:
		$title = elgg_echo('river:all');
		$page_filter = 'all';
		break;
}

// Pagination?
if ($active_activity_share) {
	$options['pagination'] = FALSE;
}

$activity = elgg_list_river($options);

$show_more_activity = TRUE;

if (!$activity) {
	$show_more_activity = FALSE;
	$activity = elgg_echo('river:none');
}

$content = elgg_view('page/layouts/content/header', array('title' => elgg_echo('circles:riverdashboard:title')));

if ($active_activity_share) {
	$content .= elgg_view('activity_share/activity_post', array('entity' => $user));
}

$content .= elgg_view('core/river/filter');
$content .= $activity;

if ($active_activity_share && $show_more_activity) {
	$content .= elgg_view('activity_share/more_activities/ajax_loader');
}

echo '<div class="bgWhiteAndShadow clearfix">';
echo $content;
echo '</div>';

return;