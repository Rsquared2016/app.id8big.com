<?php
/**
* kt_polls
*
* Main Lib description here...
* 
* @author Bortoli German
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

function kt_get_poll_types($value = FALSE) {
   $types = array(
	   '0' => elgg_echo('kt_polls:poll_types:choose_value'),
	   'poll' => elgg_echo('kt_polls:poll_types:poll'),
	   'quiz' => elgg_echo('kt_polls:poll_types:quiz'),
   );
   
   if ($value) {
	   if (in_array($value, $types)) {
		   return $value;
	   }
   }
   
   return $types;
}


function polls_generate_keys_for_array($array = array()) {
	if (empty($array)) {
		return array();
	}
	
	$to_return = array();
	
	foreach($array as $value) {
		$tmp_key = elgg_get_friendly_title($value);
		if (empty($tmp_key)) {
			$tmp_key = 'empty';
		}
		
		$to_return[$tmp_key] = $value;
	}
	
	return $to_return;
}
function polls_generate_keys_for_array_keys($array = array()) {
	if (empty($array)) {
		return array();
	}
	
	$to_return = array();
	
	foreach($array as $key => $value) {
		$tmp_key = elgg_get_friendly_title($key);
		if (empty($tmp_key)) {
			$tmp_key = 'empty';
		}
		
		$to_return[$tmp_key] = $value;
	}
	
	return $to_return;
}