<?php

/*
 * OpenTok
 */

if (!elgg_in_context('meeting_widgets_user_online')) {
    return false;
}

$user = $vars['entity'];
if (!elgg_instanceof($user, 'user')) {
    return false;
}

$action_url = elgg_get_site_url() . 'action/meeting/request_talk?user_guid=' . $user->getGUID();
$action_url = elgg_add_action_tokens_to_url($action_url);

echo elgg_view('output/url', array(
//    'href' => $vars['url'] . 'meeting/talk/' . $user->getGUID(),
	'href' => $action_url,
    'text' => elgg_echo('meeting:widgets:online:users:talk'),
    'class' => 'elgg-button btn-mini request-talk',
	'rel' => $user->getGUID(),
	'target' => '_blank',
));