<?php
/**
* sparkfire
*
* Main Lib description here...
* 
* @author Emanuel Kling
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

/* [To delete] 
*  This is the main library
*/
function sparkfire_get_req_fields() {
	$required_fields = array('location', 'looking_for', 'how_i_can_help', 'what_i_have_done');
	return $required_fields;
}


function sparkfire_register_exteps_fields($hook, $type, $returnvalue, $params) {
	$allowed_fields = array('location', 'looking_for', 'how_i_can_help', 'what_i_have_done');

	$fields = $returnvalue;
	if(is_array($fields)) {
		foreach ($fields as $key => $type) {
			if(!in_array($key, $allowed_fields)) {
				unset($fields[$key]);
			}
		}
	}

	return $fields;
}

function sparkfire_register_exteps_req_fields($hook, $type, $returnvalue, $params) {
	$required_fields = sparkfire_get_req_fields();
	$returnvalue = array_merge($returnvalue, $required_fields);
	
	return $returnvalue;
}

function sparkfire_profile_edit_fields($hook, $type, $returnvalue, $params) {
	elgg_make_sticky_form('profile:edit');
	$required_fields = sparkfire_get_req_fields();
	
	$valid_hook = $hook == 'action';
	$valid_type = $type == 'profile/edit';
	
	if($valid_hook && $valid_type) {
		foreach ($required_fields as $shortname) {
			$value = get_input($shortname);

			if(empty($value)) {
				register_error(elgg_echo("profile:required:field", array(elgg_echo("profile:$shortname"))));
				$returnvalue = false;
				break;
			}
		}
	}
	
	return $returnvalue;
	
	
}

function sparkfire_get_page_owner_fields() {
	$fields = array('looking_for', 'how_i_can_help', 'what_i_have_done');
	$user = elgg_get_logged_in_user_entity();
	$result = array();
	
	foreach($fields as $key) {
		$result[$key] = $user->$key;
	}
	
	return $result;
	
}

function sparkfire_get_agenda($options = array()) {
    $result = array();
	
	$default = array(
		'start_time_date' => '',
		'end_time_date' => '',
		'container_guid' => ELGG_ENTITIES_ANY_VALUE,
		'my_calendar' => TRUE,

        'limit' => 50, //KTODO: Limit ?
        'offset' => 0,
        'key_sortable' => TRUE,
		'grouped_by_day' => FALSE,
	);
	
	if(!is_array($options)) {
		$options = array();
	}
	
	$options = array_merge($default, $options);

	//Get the beginig and the end of the date.
//	$start = $options['start_time_date'];
//	$end = $options['end_time_date'];
//
//	//KTODO: Debemos tener en cuenta el timezone aca ?
//	$start_date = get_day_start(date('d', $start), date('m', $start), date('Y', $start));
//	$start_date = date('Y-m-d H:i:s', $start_date);
//	$end_date = get_day_end(date('d', $end), date('m', $end), date('Y', $end));
//	$end_date = date('Y-m-d H:i:s', $end_date);
//    
//	$options['start_time_date'] = $start_date;
//	$options['end_time_date'] = $end_date;
	
	//Search for events
    $result = array();
    if (is_callable('event_search_events')) {
        $options_events = $options;
        $events = event_search_events($options_events);
        $result = array_merge($result, $events);
    }
	
	//Search for gtasks @diego
	if(class_exists('GtaskHandler')) {
		$gtask_handler = new GtaskHandler();
		$tasks = $gtask_handler->get_filter_entities($options);
		$result = array_merge($result, $tasks);
	}
	//Search for bbb meetings: @mingo
    if(class_exists('MeetingHandler')) {
		$meeting_handler = new MeetingHandler();
        $meetings = $meeting_handler->get_filter_entities($options);
        $result = array_merge($result, $meetings);
	}
	
    // Search for Google Calendar: @chespi
    if(class_exists('GCalendarIntegration')) {
        $gci = new GCalendarIntegration();
        $gcalendars = $gci->getEventsForCalendar($options);
        $result = array_merge($result, $gcalendars);
    }
    
	//Order by date: Keys must be timestamp_guid
	if($result) {
		ksort($result);
	}
	
	if($options['grouped_by_day']) {
		$new_entities = array();
		if($result) {
			foreach ($result as $key => $entity) {
				$timestamp = explode('_', $key);
				$timestamp = $timestamp[0];
				
				$current_day = date('d', $timestamp);
				$today = date('d');
				$tomorrow = date('d', strtotime('tomorrow'));
				
				switch($current_day) {
					case ($today):
						$timestamp_text = 'Today';
						break;
					case ($tomorrow):
						$timestamp_text = 'Tomorrow';
						break;
					default:
						$timestamp_text = date('l d', $timestamp);
						break;
				}
				
				$new_entities[$timestamp_text][] = $entity;
			}
			$result = $new_entities;
		}
	}
	
	return $result;
}


function sparkfire_agenda_get_date($options = array()) {
	
	$default = array(
		'filter_date' => '',
	);
	
	$options = array_merge($default, $options);
	
	$options_date = array();
	switch ($options['filter_date']) {
		//KTODO: Tener en cuenta que quizas es conveniente pasar dias en vez de dias y horas.
		//Por la conversion a 
		case 'this_week':
			//$start_date = mktime(0, 0, 0, date('n'), date('j')-6, date('Y')) - ((date('N'))*3600*24);     
			//Today
			$start_date = get_day_start(date('d', time()), date('m', time()), date('Y', time()));
			$start_date = date('Y-m-d H:i:s', $start_date);

			//Sunday this week.
			//$end_date = mktime(23, 59, 59, date('n'), date('j'), date('Y')) - ((date('N'))*3600*24); 
			$end_date = mktime(23, 59, 59, date('m'), date('d')-date('N')+7, date('Y'));
			$end_date = date('Y-m-d H:i:s', $end_date);

			$options_date['start_time_date'] = $start_date;
			$options_date['start_time_date_end'] = $end_date;

			break;

		case 'next_week':
			//Today
			$start_date = mktime(0, 0, 0, date('m'), date('d')-date('N')+1+7, date('Y'));
			$start_date = date('Y-m-d H:i:s', $start_date);

			//Sunday this week.
			$end_date = mktime(23, 59, 59, date('m'), date('d')-date('N')+14, date('Y'));
			$end_date = date('Y-m-d H:i:s', $end_date);

			$options_date['start_time_date'] = $start_date;
			$options_date['start_time_date_end'] = $end_date;

			break;
		
		case 'all_time':
			//Today
			$start_date = get_day_start(date('d', time()), date('m', time()), date('Y', time()));
			$start_date = date('Y-m-d H:i:s', $start_date);

			$options_date['start_time_date'] = $start_date;

			break;

		default:
		case 'today':
			$start_date = get_day_start(date('d', time()), date('m', time()), date('Y', time()));
			$start_date = date('Y-m-d H:i:s', $start_date);
			$end_date = get_day_end(date('d', time()), date('m', time()), date('Y', time()));
			$end_date = date('Y-m-d H:i:s', $end_date);

			$options_date['start_time_date'] = $start_date;
			$options_date['start_time_date_end'] = $end_date;
			break;
	}
	
	return $options_date;
}