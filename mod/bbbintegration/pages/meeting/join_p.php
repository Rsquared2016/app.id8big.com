<?php

/**
 * BigBlueButton
 */

// Get meeting
$guid = get_input('guid');
$meeting = get_entity($guid);

if (!elgg_instanceof($meeting, 'object', 'meeting')) {
    register_error(elgg_echo('meeting:error:join'));
    forward(REFERER);
}

// Can join?
$can_join = $meeting->canJoin();
if (!$can_join) {
    $status = $meeting->getStatus();
    register_error(elgg_echo('meeting:status:' . $status));
    forward(REFERER);
}

// Are complete number participants?
$are_complete = $meeting->areCompleteNumberParticipants();
if ($are_complete) {
    register_error(elgg_echo('meeting:error:join:participants'));
    forward(REFERER);
}

// Get page owner
$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
    $container = $meeting->getContainerEntity();
    if ($container instanceof ElggGroup) {
        $page_owner = $container;
    }
    else {
        $page_owner = elgg_get_logged_in_user_entity();
    }
//    if ($container instanceof ElggGroup) {
//        elgg_set_page_owner_guid($container->getGUID());
//    }
//    else {
//	   elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
//    }
}
//$page_owner = elgg_get_page_owner_entity();

// Is member?
if (elgg_instanceof($page_owner, 'group')) {
    $is_member = $page_owner->isMember();
    if (!$is_member) {
        register_error(elgg_echo('meeting:join:member:not'));
        forward(REFERER);
    }
}

// Get title
$title = $meeting->title;

// Breadcrumb
elgg_push_breadcrumb(elgg_echo('meeting'), 'meeting/all');
if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($page_owner->name, "meeting/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($page_owner->name, "meeting/owner/$page_owner->username");
}
elgg_push_breadcrumb($title);

// Get content
$content = elgg_view('output/url', array(
    'text' => elgg_echo('meeting:meeting:exit'),
    'href' => $meeting->getURL(),
    'class' => 'elgg-button elgg-button-action flRig close-talk',
));
$content .= elgg_view('bbbintegration/wrapper', array(
    'entity' => $meeting,
));

$params = array(
	'title' => $title,
	'content' => $content,
    'filter_override' => '',
    'class' => 'elgg-layout-talk',
);
//$body = elgg_view_layout('content', $params);
$body = elgg_view_layout('one_column', $params);

echo elgg_view_page($title, $body);