<?php

/**
 * Elgg blog: edit post action
 * 
 * @package ElggBlog
 */
// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get input data
$guid = (int) get_input('guid');

$new_meeting = true;

$form = new MeetingForm;
if ($guid) {
	$form->setObject($guid);
	
	$new_meeting = false;
}

// Get start date, start time and timezone
$start_date = get_input('start_date', '');
$start_time = get_input('start_time', '');
$timezone = get_input('timezone', '');

// Get site timezone
if (is_callable('elgg_timezone_get_timezone_site')) {
    // Function added into this module
    $site_timezone = elgg_timezone_get_timezone_site();
}
else {
    $site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
}

// Get offset timezone
$offset_timezone = elgg_timezone_get_timezone_offset($timezone, $site_timezone);

// Get current timezone
$current_timezone = date_default_timezone_get();

// Set meeting timezone
date_default_timezone_set($timezone);

// Get start datetime
$start_datetime = strtotime($start_date . ' ' . $start_time);

// Set site timezone
date_default_timezone_set($site_timezone);

// Get site start datetime
$site_start_datetime = strtotime($start_date . ' ' . $start_time);
$site_start_datetime = $site_start_datetime + $offset_timezone;

// Get now
$now = time();

// Set current timezone
date_default_timezone_set($current_timezone);

// Validate meeting date
if ($site_start_datetime < $now) {
    register_error(elgg_echo('meeting:error:greater:start_date'));
    forward(REFERER);
}

// Validate start_time
/*$form_fields = $form->getFormFields();
if (array_key_exists('start_time', $form_fields)) {
    $start_time = $form_fields['start_time'];
    if (array_key_exists('options', $start_time)) {
        $options = $start_time['options'];
        if (array_key_exists('value', $options)) {
            $value = $options['value'];
            if ($value == '0') {
                $start_time['validators']['required'] = false;
                $form_fields['start_time'] = $start_time;
                $form->setFields($form_fields);
            }
        }
    }
}*/

//$tags = get_input('tags', array());
//$tags = string_to_tag_array($tags);
//$success = $form->save(TRUE, array('metadata' => array('tags' => $tags))); //Change how is saved a metadata.
//$success = $form->save(TRUE, array('guid' => $some_guid)); //Save with specific guid.
//$success = $form->save(TRUE, array('entity_options' => array('container_guid' => $container_guid))); //Change some entity options.
//$success = $form->save(TRUE, array('entity_options' => array('create_river' => FALSE))); //Do not create river.

if (elgg_get_plugin_setting('enable_rivers_items', 'bbbintegration') == 'yes') {
	$success = $form->save(TRUE);
}else {
	$success = $form->save(TRUE, array('entity_options' => array('create_river' => FALSE))); //Do not create river.
}


if ($success) {
	$entity = get_entity($success);
	
	if ($entity) {
        // Set start datetime
        $entity->start_datetime = $start_datetime;
        
        // Set site start datetime
        $entity->site_start_datetime = $site_start_datetime;
        
        // Get duration
        $duration = get_input('duration', 0);
        if (empty($duration)) {
            $duration = 1440; // 24 Hours = 1440 Minutes
        }
        
        // Set end datetime
        $end_datetime = strtotime('+' . $duration . ' Minutes', $start_datetime);
        $entity->end_datetime = $end_datetime;
        
        // Set site end datetime
        $site_end_datetime = strtotime('+' . $duration . ' Minutes', $site_start_datetime);
        $entity->site_end_datetime = $site_end_datetime;
        
        // Set timezone group
        $entity->timezone_group = get_input('timezone_group');
		
		if ($new_meeting) {
			elgg_trigger_event('gcalendar', 'create', $entity);
		}
        
        // Get subtype
		$subtype = $entity->getSubtype();
		
		// Success message
		system_message(sprintf(elgg_echo("meeting_ktform:save:entity:saved"), elgg_echo('item:object:'.$subtype)));
		
		forward($entity->getUrl());
		die;
	}
}

/**
 * 	$errors = $form->getErrors();

  foreach($errors as $error) {

  register_error($error);

  }
 */
forward(REFERER);