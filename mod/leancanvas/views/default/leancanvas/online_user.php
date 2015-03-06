<?php

/**
 * Online user
 */

// Get user logged in
$user_logged_in = elgg_get_logged_in_user_entity();
if (!$user_logged_in) {
	return true;
}

// Size
$size = 'tiny';

// Icon
$icon = elgg_view_entity_icon($user_logged_in, $size, $vars);

// Title
$title = elgg_view('output/url', array(
	'text' => $user_logged_in->name,
	'href' => $user_logged_in->getURL(),
));

$params = array(
	'entity' => $user_logged_in,
	'title' => $title,
);
$list_body = elgg_view('user/elements/summary', $params);

$vars['class'] = 'leancanvas-online-user';
$vars['id'] = 'leancanvas-online-user-' . $user_logged_in->getGUID();

echo elgg_view_image_block($icon, $list_body, $vars);