<?php

/**
 * BBBIntegration
 */

// Get user to talk
$guid = get_input('guid');
$user = get_entity($guid);

// Get user logged in
$user_logged_in = elgg_get_logged_in_user_entity();

// Check for error
if (!elgg_instanceof($user, 'user') || !elgg_instanceof($user_logged_in, 'user')) {
    register_error(elgg_echo('meeting:talk:error'));
    forward();
}

$dbprefix = elgg_get_config('dbprefix');
$options = array(
//    'guid' => array($user_logged_in->getGUID(), $user->getGUID()),
    'annotation_names' => MEETING_REQUEST_TALK_ANNOTATION,
//    'annotation_owner_guids' => array($user->getGUID(), $user_logged_in->getGUID()),
//	'annotation_values' => array(MEETING_REQUEST_TALK_STATUS_REQUEST),
	'joins' => array(
		"JOIN {$dbprefix}metastrings msv on n_table.value_id = msv.id"
	),
	'wheres' => array(
		"(
		   (n_table.entity_guid = {$user_logged_in->getGUID()} AND n_table.owner_guid = {$user->getGUID()} AND msv.string = '".MEETING_REQUEST_TALK_STATUS_REQUEST."') OR
		   (n_table.entity_guid = {$user->getGUID()} AND n_table.owner_guid = {$user_logged_in->getGUID()} AND msv.string NOT IN ('".MEETING_REQUEST_TALK_STATUS_REQUEST."', '".MEETING_REQUEST_TALK_STATUS_DECLINE."', '".MEETING_REQUEST_TALK_STATUS_COMPLETE."'))
		 )",
	),
);
$annotations = elgg_get_annotations($options);

if (empty($annotations)) {
//	register_error(elgg_echo('meeting:talk:error'));
	forward();
}

// KTODO: verificar si son amigos si corresopnde

elgg_push_context('bigbluebutton');

// Get title
$title = elgg_echo('meeting:talk:meeting:title', array($user->name));

// Get content
$content = elgg_view('output/url', array(
    'text' => elgg_echo('meeting:talk:exit'),
    'href' => elgg_get_site_url(),
    'class' => 'elgg-button elgg-button-action flRig close-talk',
));

$action_url = elgg_get_site_url() . 'action/meeting/talk?user_guid=' . $user->getGUID();
// 'request_talk' is used to indicate that it is accepting a request for talk
if (get_input('request_talk', false)) {
    $action_url .= '&request_talk=1';
}
$action_url = elgg_add_action_tokens_to_url($action_url);
$params = array(
    'action_url' => $action_url,
);
$content .= elgg_view('meeting/wrapper', $params);

$params = array(
    'content' => $content,
	'title' => $title,
	'filter_override' => '',
    'class' => 'elgg-layout-talk',
);
$body = elgg_view_layout('one_column', $params);

echo elgg_view_page($title, $body);