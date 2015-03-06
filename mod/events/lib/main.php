<?php

/**
 * events
 *
 * Main Lib description here...
 * 
 * @author Bortoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
/*
 *  This is the main library
 */

function events_get_hours_options() {
	$init_hour = 0;
	$division_time = 48;
	$time_mult = 1800; //30min

	$time_results = array();
	for ($i = $init_hour; $i < $division_time; $i++) {
		$seconds = $i * $time_mult;
		$time_results[$seconds] = elgg_timezone_sec_to_time($seconds, TRUE);
	}

	return $time_results;
}

function events_get_default_time() {
		$default_hour = date('H');
		
		$default_time = "{$default_hour}:00:00";
		
		$default_startime = elgg_timezone_time_to_sec($default_time);
		
		switch($default_hour) {
			case ($default_hour <= 22):
				$default_startime = $default_startime+3600;
			break;
		}
		
		return $default_startime;
}


/**
 *	This function return the time for the logged in user from a time of server
 * @param type $server_time 
 */
function events_get_user_time($server_time){
	$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	
	
	$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
	
	if (!$user_timezone) {
		$user_timezone = $server_timezone;
	}

	$offset_time = elgg_timezone_get_timezone_offset($server_timezone, $user_timezone);
	
	$return_time = $server_time + $offset_time;
	
	return $return_time;
	
}


function events_get_user_time_start($event, $with_format = FALSE){
	$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	
	
	$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
	
	if (!$user_timezone) {
		$user_timezone = $server_timezone;
	}

	$offset_time = elgg_timezone_get_timezone_offset($event->timezone, $user_timezone);
	
	
	$star_date = $event->start_date;
	$start_time = elgg_timezone_sec_to_time($event->start_time);
	
    // OLD
//	$star_date_time = strtotime($star_date. ' ' . $start_time);
//	$return_time = $star_date_time + $offset_time;
    
    // NEW
    $default_timezone = date_default_timezone_get();
    date_default_timezone_set($user_timezone);
	$star_date_time = strtotime($star_date. ' ' . $start_time);
	$return_time = $star_date_time + $offset_time;
    if ($with_format) {
        $return_time = date($with_format, $return_time);
    }
    date_default_timezone_set($default_timezone);
	
	return $return_time;
	
}


function events_get_user_time_end($event, $with_format = FALSE){
	$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	
	
	$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
	
	if (!$user_timezone) {
		$user_timezone = $server_timezone;
	}

	$offset_time = elgg_timezone_get_timezone_offset($event->timezone, $user_timezone);
	
	
	$end_date = $event->end_date;
	$end_time = elgg_timezone_sec_to_time($event->end_time);
	
    // OLD
//	$end_date_time = strtotime($end_date. ' ' . $end_time);
//	$return_time = $end_date_time + $offset_time;
    
    // NEW
    $default_timezone = date_default_timezone_get();
    date_default_timezone_set($user_timezone);
	$end_date_time = strtotime($end_date. ' ' . $end_time);
	$return_time = $end_date_time + $offset_time;
    if ($with_format) {
        $return_time = date($with_format, $return_time);
    }
    date_default_timezone_set($default_timezone);
	
	return $return_time;
	
}

function events_get_attend_options(){
	$attend_options = array(
		'yes' => elgg_echo('events:attend:yes'),
		'maybe' => elgg_echo('events:attend:maybe'),
		'not_replied' => elgg_echo('events:attend:not_replied'),
		'no' => elgg_echo('events:attend:no'),
	);
	return $attend_options;
}

function event_get_attend_options_color_label($option){
	$attend_options = array(
		'yes' => '#000000',
		'maybe' => '#000000',
		'not_replied' => '#000000',
		'no' => '#FFFFFF',
	);

	if(array_key_exists($option, $attend_options)) {
		$attend_options = $attend_options[$option];
	}

	return $attend_options;
}

function event_get_attend_options_color($option){
	$attend_options = array(
		'yes' => EVENT_ATTEND_COLOR_YES,
		'maybe' => EVENT_ATTEND_COLOR_MAYBE,
		'not_replied' => EVENT_ATTEND_COLOR_NOT_REPLIED,
		'no' => EVENT_ATTEND_COLOR_NO,
	);

	if(array_key_exists($option, $attend_options)) {
		$attend_options = $attend_options[$option];
	}

	return $attend_options;
}

/**
 * This function is used to search meetups.
 * Is used into the calendar search.
 * 
 * @param Array $options Here you should add elgg entities params.
 * 
 * @return Array | FALSE
 */
function event_search_events($options = array()) {
	global $CONFIG;
	
	$current_timezone = date_default_timezone_get();
	
	$user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');	

	$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');

	if (!$user_timezone) {
		$user_timezone = $server_timezone;
	}

	$offset_time = elgg_timezone_get_timezone_offset($user_timezone, $server_timezone);
	
	date_default_timezone_set($server_timezone);
	
	//Default start time.
	$default_start = mktime(0, 0, 0, date('m'), 1, date('Y')); //First day of current month.
	$default_end = mktime(23, 59, 59, date('m')+1, 0, date('Y')); //Last day of current month.
	
	if (isset($options['start_time_date'])) {
		$from_time = strtotime($options['start_time_date']);
	} else {
		$from_time = $default_start;	
	}
	
	if (isset($options['start_time_date_end'])) {
		$from_time_end = strtotime($options['start_time_date_end']);
	}

	
	if (isset($options['end_time_date'])) {
		$to_time = strtotime($options['end_time_date']);
	} else {
		//$to_time = $default_end;
	}
	
	if($from_time) {
		$from_time += $offset_time;
	}
	
	if($from_time_end) {
		$from_time_end += $offset_time;
	}
	
	if($to_time) {
		$to_time += $offset_time;
	}
	
	date_default_timezone_set($current_timezone);
	
//	date_default_timezone_set($server_timezone);
//	$from_time = mktime(0, 0, 0, date('m'), 1, date('Y'));;
//	$from_time += $offset_time;
//	date_default_timezone_set($current_timezone);
//	
//	date_default_timezone_set($server_timezone);
//	$to_time = mktime(23, 59, 59, date('m')+1, 0, date('Y'));
//	$to_time += $offset_time;
//	date_default_timezone_set($current_timezone);
	
	$attend_options_default = events_get_attend_options();
	$attend_options_default = array_keys($attend_options_default);
	
	$default = array(
		//Meetups params
//		'container_guid' => ELGG_ENTITIES_ANY_VALUE,
//		'start_time_date' => $default_start,
//		'end_time_date' => $default_end,
//		'attend_options' => $attend_options_default,
//		'attend_user_guid' => '',
		
		
		//Entities Params.
		'types' => 'object',
		'subtypes' => 'event',
		'metadata_name_value_pairs' => array(),
        'metadata_name_value_pairs_operator' => 'OR',
//		'selects' => array(),
//		'joins' => array(),
//		'wheres' => array(),
		'limit' => 50, //KTODO: Limit ?
		'offset' => 0,
	);
	
	if(!is_array($options)) {
		$options = array($options);
	}
	
//	$options = array_merge($default, $options);
	$options = array_merge($default, $options);

//	if($options['start_time_date']) {
//		$options['metadata_name_value_pairs'][] = array(
//				'name' => 'start_time_date',
//				'value' => $start,
//				'operand' => '>=',
//			);
//		unset ($options['start_time_date']);
//	}
	if($from_time) {
		$options['metadata_name_value_pairs'][] = array(
					'name' => 'star_event_date_time',
					'value' => $from_time,
					'operand' => '>=',
					);
	}
	if($from_time_end) {
		$options['metadata_name_value_pairs'][] = array(
					'name' => 'star_event_date_time',
					'value' => $from_time_end,
					'operand' => '<=',
					);
	}
	if($to_time) {	
		$options['metadata_name_value_pairs'][] = array(
					'name' => 'end_event_date_time',
					'value' => $to_time,
					'operand' => '<=',
					);
	}
//	if($options['end_time_date']) {
//		$options['metadata_name_value_pairs'][] = array(
//				'name' => 'end_time_date',
//				'value' => $end,
//				'operand' => '<=',
//			);
//		unset ($options['end_time_date']);
//	}
	
	//KTODO: Meetups search: Should we call to specific elgg functions to get this joins ?
//	$attend_user_guid = sanitise_int($options['attend_user_guid']);
//	if(is_array($options['attend_options']) && $attend_user_guid) {
//		$sanitised_values = array();
//		foreach ($options['attend_options'] as $value) {
//			// normalize to 0
//			if (!$value) {
//				$value = 0;
//			}
//			$sanitised_values[] = '\'' . sanitise_string($value) . '\'';
//		}
//
//		$attend_options = implode(',', $sanitised_values);
//		unset($options['attend_options']);
//		
//		if($attend_options) {
//			$suffix = '_attend';
//			//LEFT JOIN ... 
//			$options['joins'] = array(
//				"JOIN {$CONFIG->dbprefix}annotations n_table{$suffix} on e.guid = n_table{$suffix}.entity_guid", // AND n_table{$suffix}.owner_guid = {$attend_user_guid}",
//				"JOIN {$CONFIG->dbprefix}metastrings msn{$suffix} on n_table{$suffix}.name_id = msn{$suffix}.id", // AND (msn{$suffix}.string = '".EVENT_ATTEND_ANNOTATION_NAME."')",
//				"JOIN {$CONFIG->dbprefix}metastrings msv{$suffix} on n_table{$suffix}.value_id = msv{$suffix}.id", // AND (msv{$suffix}.string in (" . $attend_options . "))",
//			);
//			
//			$options['wheres'] = array(
//				"(msn{$suffix}.string = '".EVENT_ATTEND_ANNOTATION_NAME."')",
//				"(msv{$suffix}.string in (" . $attend_options . "))",
//				"(n_table{$suffix}.owner_guid = {$attend_user_guid})",
//			);
//		}
//
//	}
    
    // Esto funciona bien, obtiene eventos en donde el usuario logueado indico
    // qeu asistira o tal vez o es dueño
//    $attend_user_guid = elgg_extract('attend_user_guid', $options);
//    $user = get_entity($attend_user_guid);
//    if (elgg_instanceof($user, 'user')) {
//        $dbprefix = elgg_get_config('dbprefix');
//        $options['joins'][] = "LEFT JOIN {$dbprefix}annotations n_attend ON n_attend.entity_guid = e.guid";
//        $options['joins'][] = "LEFT JOIN {$dbprefix}metastrings n_attend_msn ON n_attend_msn.id = n_attend.name_id";
//        $options['joins'][] = "LEFT JOIN {$dbprefix}metastrings n_attend_msv ON n_attend_msv.id = n_attend.value_id";
//        $options['wheres'][] = "((n_attend.owner_guid = {$attend_user_guid} AND n_attend_msn.string = '".EVENTS_ATTEND_ANNOTATION_NAME."' AND n_attend_msv.string IN ('".EVENTS_ATTEND_YES."', '".EVENTS_ATTEND_MAYBE."')) OR (e.owner_guid = {$attend_user_guid}))";
//    }
    
	$entities = elgg_get_entities_from_metadata($options);
    
    $return = array();
    if (isset($options['key_sortable']) && $options['key_sortable'] == TRUE) {
        foreach ($entities as $entity) {
            $event = get_entity($entity->guid);
            
            // Remove event not attending
            if (elgg_instanceof($event, 'object', 'event')) {
                $user_attend = $event->getUserAttend();
                if ($user_attend == EVENTS_ATTEND_NO) {
                    continue;
                }
            }
            
            $return["{$event->star_event_date_time}_{$event->guid}"] = $event;
        }
    } else {
        $return = $entities;
    }
	
	return $return;
}