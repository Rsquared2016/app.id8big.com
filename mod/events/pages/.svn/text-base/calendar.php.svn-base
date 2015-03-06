<?php

gatekeeper();

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();

if ($page_owner === false || is_null($page_owner)) {
    set_page_owner(get_loggedin_userid());

    //$page_owner = page_owner_entity();
}

//If we got owned events of user or group.
$container_guid = ELGG_ENTITIES_ANY_VALUE;
if ($page_owner) {
    $container_guid = $page_owner->guid;
}

$title = elgg_echo('events:calendar');
//$elgg_title = elgg_view_title($title);
$area2 = '';
$area2 .= elgg_view('events/calendar/view', array('container_guid' => $container_guid));


//$area2 = $elgg_title . $area2;

$vars = array(
    'title' => $title,
    'content' => $area2,
    'filter_override' => '',
);

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);