<?php
/**
* gtask
*
* Main Lib description here...
* 
* @author BOrtoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

function gtask_get_responsive_options($group_guid) {
	$group = get_entity($group_guid);

	$responsables = array();
	if (!($group instanceof ElggGroup)) {
		$responsables[elgg_get_logged_in_user_guid()] = elgg_get_logged_in_user_entity()->name;
		return $responsables;
	}
	
	$members = $group->getMembers(100);
//	$owner = $group->getOwnerEntity();
	
	
//	$responsables[$owner->getGUID()] = $owner->name;
	foreach($members as $member) {
		$responsables[$member->getGUID()] = $member->name;
	}
	
	return $responsables;
}

function gtask_get_priority_options() {
	$priority = array(
		'3' => elgg_echo('gtask:priority:high'),
		'2' => elgg_echo('gtask:priority:medium'),
		'1' => elgg_echo('gtask:priority:low'),
	);
	
	return $priority;
}

function gtask_get_status_options() {
	$status = array(
		'active' => elgg_echo('gtask:status:active'),
		'in_progress' => elgg_echo('gtask:status:in_progress'),
		'for_testing' => elgg_echo('gtask:status:for_testing'),
		'finished' => elgg_echo('gtask:status:finished'),
		'onhold' => elgg_echo('gtask:status:onhold'),
//		'passed' => elgg_echo('gtask:status:passed'),
	);
	
	return $status;
}

function gtask_camelize_string($str, $capitalizeFirst = true, $allowed = 'A-Za-z0-9') {
	return preg_replace(
			array(
		'/([A-Z][a-z])/e', // all occurances of caps followed by lowers
		'/([a-zA-Z])([a-zA-Z]*)/e', // all occurances of words w/ first char captured separately
		'/[^' . $allowed . ']+/e', // all non allowed chars (non alpha numerics, by default)
		'/^([a-zA-Z])/e' // first alpha char
			), array(
		'" ".$1', // add spaces
		'strtoupper("$1").strtolower("$2")', // capitalize first, lower the rest
		'', // delete undesired chars
		'strto' . ($capitalizeFirst ? 'upper' : 'lower') . '("$1")' // force first char to upper or lower
			), $str
	);
}

function gtask_get_default_dates($timestamp = FALSE) {

	if ($timestamp == FALSE) {
		$timestamp = time();
	}

	$current_date = getdate($timestamp);

	$defaults = array(
		//This annotations are from Elgg calendar / entity / event functions.
		'calendar_start' => get_day_start($current_date['mday'], $current_date['mon'], $current_date['year']),
		'calendar_end' => get_day_end($current_date['mday'], $current_date['mon'], $current_date['year']),
	);

	return $defaults;
}

function gtask_get_user_time_start($task, $with_format = FALSE){
	$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	
	
	$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
	
	if (!$user_timezone) {
		$user_timezone = $server_timezone;
	}

    $default_timezone = date_default_timezone_get();
    date_default_timezone_set($user_timezone);
    
    $end_date = get_day_start(date('d', strtotime($task->calendar_end)), date('m', strtotime($task->calendar_end)), date('Y', strtotime($task->calendar_end)));
    
    $return_time = $end_date;
    
    if ($with_format) {
        $return_time = date($with_format, $return_time);
    }
    
    date_default_timezone_set($default_timezone);
	
	return $return_time;
	
}

function gtask_get_user_time_end($task, $with_format = FALSE){
	$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	
	
	$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
	
	if (!$user_timezone) {
		$user_timezone = $server_timezone;
	}

    $default_timezone = date_default_timezone_get();
    date_default_timezone_set($user_timezone);
    
    $end_date = get_day_end(date('d', strtotime($task->calendar_end)), date('m', strtotime($task->calendar_end)), date('Y', strtotime($task->calendar_end)));
    
    $return_time = $end_date;
    
    if ($with_format) {
        $return_time = date($with_format, $return_time);
    }
    
    date_default_timezone_set($default_timezone);
	
	return $return_time;
	
}