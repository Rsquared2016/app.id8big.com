<?php

$return = '';
if (isset($vars['entity'])) { 
	$start_date = $vars['entity']->start_date;
	if ($start_date) {
//		$start_time = elgg_timezone_sec_to_time($vars['entity']->start_time);
//		$start_date_time = strtotime($start_date. ' ' . $start_time);
		
		$user_star_time = events_get_user_time_start($vars['entity'], EVENT_DATE_FORMAT);
	
        $return .= $user_star_time;
//		$return .= elgg_echo('events:'.date("F", $user_star_time)) . ' ' . date("j - G:i", $user_star_time). ' hs';
	}
	
	$end_date = $vars['entity']->end_date;
	if ($end_date) {
//		$end_time = elgg_timezone_sec_to_time($vars['entity']->end_time);
//		$end_date_time = strtotime($end_date. ' ' . $end_time);
		$user_end_time = events_get_user_time_end($vars['entity'], EVENT_DATE_FORMAT);
        $return .= ' a ' . $user_end_time;
//		$return .= ' a ' . elgg_echo('events:'.date("F", $user_end_time)) . ' ' . date("j - G:i", $user_end_time). ' hs';
	}
}


echo $return;
