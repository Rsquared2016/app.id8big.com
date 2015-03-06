<?php

/**
 * Import
 */

if (!elgg_is_xhr()) {
    forward();
}

if (!elgg_is_logged_in()) {
    echo '';
    exit;
}

// Google Calendar
$gc = new GCalendarIntegration();
$gc->authenticate();

$calendar_list = $gc->getCalendarList();

// Content
$form_vars = array();
$body_vars = array(
    'calendar_list' => $calendar_list,
);
$content = elgg_view_form('gcalendar/import', $form_vars, $body_vars);

echo $content;

exit;