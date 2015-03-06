<?php

/*
 * Some calendar constants and functions.
 */

//Calendar color scheme.
define('EVENT_ATTEND_COLOR_YES', '#f4d501');
define('EVENT_ATTEND_COLOR_MAYBE', '#72d4ff');
define('EVENT_ATTEND_COLOR_NOT_REPLIED', '#d2ff00');
define('EVENT_ATTEND_COLOR_NO', '#000');


define('EVENTS_CALENDAR_TITILE_MAX_CHARS', 10); //1 line: 14 chars
define('EVENTS_CALENDAR_DESC_MAX_CHARS', 300);
define('EVENTS_CALENDAR_MONTH_VIEW_MAX_EVENTS_PER_DAY', 1);

function event_calendar_add_event_day($start_time_date, $end_time_date, $event_days = array()) {
	if(!is_array($event_days)) {
		$event_days = array();
	}
	
	if(!$start_time_date || !$end_time_date) {
		return $event_days;
	}
	
	//Get day difference.
	$days_diff = event_calendar_get_time_diff($end_time_date, $start_time_date, array('day'), FALSE);
	
	$ymd = array();
	if(isset($days_diff['day']) && $days_diff['day'] > 0) {
		//Is an event more of one day.
		$days_diff_val = (int) $days_diff['day'];
		//Now save each day.
		for($iday = 0; $iday < $days_diff_val; $iday++) {
			$ymd[] = date('Ymd', strtotime("+{$iday} days", $start_time_date));
		}
	} else {
		//Is an event of one day.
		$ymd[] = date('Ymd', $start_time_date);
	}
	
	foreach($ymd as $ymd_val) {
		if(!$ymd_val) {
			continue;
		}
		
		if(array_key_exists($ymd_val, $event_days)) {
			$event_days[$ymd_val] += 1; 
		} else {
			$event_days[$ymd_val] = 1; 
		}
	}	
	
	return $event_days;
	
	
}

function event_calendar_get_time_diff($from, $to = null, $display_units = array(), $formated = TRUE) {
	$to = (($to === null) ? (time()) : ($to));
	$to = ((is_int($to)) ? ($to) : (strtotime($to)));
	$from = ((is_int($from)) ? ($from) : (strtotime($from)));

	$units = array (
		"year"   => 29030400, // seconds in a year   (12 months)
		"month"  => 2419200,  // seconds in a month  (4 weeks)
		"week"   => 604800,   // seconds in a week   (7 days)
		"day"    => 86400,    // seconds in a day    (24 hours)
		"hour"   => 3600,     // seconds in an hour  (60 minutes)
		"minute" => 60,       // seconds in a minute (60 seconds)
		"second" => 1         // 1 second
	);
	  
	if(count($display_units)) {
		$new_units = array();
		foreach($display_units as $val) {
			if(array_key_exists($val, $units)) {
				$new_units[$val] = $units[$val];
			}
		}
		if(count($new_units)) {
			$units = $new_units;
		}
	}
	
	$diff = abs($from - $to);
	$suffix = (($from > $to) ? ("from now") : ("ago"));
	
	if($formated) {
		$output = '';
	} else {
		$output = array();
	}

	foreach($units as $unit => $mult) {
		if($diff >= $mult) {
			$unit_diff = intval($diff / $mult);
			if($formated) {
				$unit_str = elgg_echo($unit);
				$and = (($mult != 1) ? ("") : ("and "));
				$output .= ", ".$and.$unit_diff." ".$unit_str.(($unit_diff == 1) ? ("") : ("s"));

			} else {
				$output[$unit] = $unit_diff;
			}
			$diff -= intval($diff / $mult) * $mult;
		}
		if($formated) {
			$output .= " ".$suffix;
			//$output = substr($output, strlen(", "));
		}
	}

	return $output;
}