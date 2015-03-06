<?php

/**
 * BigBlueButton Integration
 */

// Get user
$user = elgg_get_page_owner_entity();
if (!($user instanceof ElggUser)) {
    return false;
}

// Get timezon user
$timezone = elgg_timezone_get_timezone_user($user);

// Get input
$title = elgg_echo('meeting:timezone:label');
$content = elgg_echo('meeting:timezone:pulldown:help:label');
$content .= elgg_view('meeting/input/timezone', array(
    'name' => 'user_timezone',
    'is_pulldown' => TRUE,
    'value' => $timezone,
));
echo elgg_view_module('info', $title, $content);