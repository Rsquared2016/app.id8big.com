<?php

/**
 * Import
 */

// Get calendar id
$calendar_id = get_input('calendar_id', '');
if (empty($calendar_id)) {
    register_error(elgg_echo('gcalendar:import:error'));
    forward();
}

// Get logged in user
$user_logged_in = elgg_get_logged_in_user_entity();
if (!elgg_instanceof($user_logged_in, 'user')) {
    register_error(elgg_echo('gcalendar:import:error'));
    forward();
}

// GCalendarIntegration
$gci = new GCalendarIntegration();
$gci->authenticate();
$calendar = $gci->getCalendar($calendar_id);

// Exists entity?
$entity = $gci->getGCalendarByCalendarId($calendar_id);
if (elgg_instanceof($entity, 'object', 'gcalendar')) {
    if (!$entity->canEdit()) {
        register_error(elgg_echo('gcalendar:import:error'));
        forward();
    }
}
else {
    // New entity
    $entity = new GCalendar();
}

// Get google calendar
if (!($calendar instanceof Google_Calendar)) {
    register_error(elgg_echo('gcalendar:import:error'));
    forward();
}

// Save data
$entity->title = $calendar->getSummary();
$entity->description = $calendar->getDescription();
$entity->access_id = ACCESS_PRIVATE;
$entity->calendar_id = $calendar->getId();
$entity->timezone = $calendar->getTimeZone();
$entity->location = $calendar->getLocation();
$entity->etag = $calendar->getEtag();
$entity->kind = $calendar->getKind();

$success = $entity->save();

if ($success) {
    system_message(elgg_echo('gcalendar:import:success'));
    $gcalendars = $gci->getGCalendars();
    
    echo elgg_view('gcalendar/list', array(
        'gcalendars' => $gcalendars,
    ));
}
else {
    register_error(elgg_echo('gcalendar:import:error'));
}
forward();