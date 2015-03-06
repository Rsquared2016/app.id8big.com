<?php

/**
 * Sets the timezone, it gets from the plugin settings, as site timezone or if
 * the user have the timezone configured on tools.
 * 
 * @return bool 
 */

function elgg_timezone_setter() {
    $timezone = FALSE;
    
    $site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
    $user_timezone = elgg_get_plugin_user_setting('user_timezone', 0, 'events');
    
    if (empty($user_timezone) && !empty($site_timezone)) {
        $timezone = $site_timezone;
    } else {
        if ($user_timezone) {
            $timezone = $user_timezone;
        }
    }
   
    if (empty($timezone) || !in_array($timezone, array_keys(elgg_timezone_get_timezones()))) {
        return FALSE;
    }
    
   $success = date_default_timezone_set($timezone);
	if ($success) {
		return $timezone;
	}
	
	return FALSE;
    
}

function elgg_timezone_get_timezones_group() {
    
    $options = array(
        'united_states' => elgg_echo('events:united_states'),
        'all_the_world' => elgg_echo('events:all_the_world'),
    );
    
    return $options;
    
}

/**
 * Returns an array of the PHP timezones, this function requires PHP 1.5.2++
 * 
 * @param type $is_pulldown
 * @return array
 *  
 */
function elgg_timezone_get_timezones($is_pulldown = FALSE, $united_states = FALSE) {
    
    $list = DateTimeZone::listAbbreviations();
    $idents = DateTimeZone::listIdentifiers();
    
    if ($united_states) {
        $options = array(
            'Pacific/Honolulu' => 'Hawai',
            'America/Anchorage' => 'Alaska',
            'America/Los_Angeles' => 'Pacific Time',
            'America/Denver' => 'Mountain Time',
            'America/Phoenix' => 'Mountain Time (Arizona)',
            'America/Chicago' => 'Central Time',
            'America/New_York' => 'East Time',
        );
        $added = array();
        foreach ($list as $abbr => $info) {
            foreach ($info as $zone) {
                if (!empty($zone['timezone_id']) &&
                    in_array($zone['timezone_id'], $idents) &&
                    array_key_exists($zone['timezone_id'], $options) &&
                    !in_array($zone['timezone_id'], $added)) {
                    $z = new DateTimeZone($zone['timezone_id']);
                    $c = new DateTime(null, $z);
                    $time = $c->format('H:i a');
                    $options[$zone['timezone_id']] = $time . ' - ' . $options[$zone['timezone_id']];
                    $added[] = $zone['timezone_id'];
                }
            }
        }
    }
    else {
        $data = $offset = $added = array();
        foreach ($list as $abbr => $info) {
            foreach ($info as $zone) {
                if (!empty($zone['timezone_id']) && !in_array($zone['timezone_id'], $added) && in_array($zone['timezone_id'], $idents)) {
                    $z = new DateTimeZone($zone['timezone_id']);
                    $c = new DateTime(null, $z);
                    $zone['time'] = $c->format('H:i a');
                    $data[] = $zone;
                    $offset[] = $z->getOffset($c);
                    $added[] = $zone['timezone_id'];
                }
            }
        }

        array_multisort($offset, SORT_ASC, $data);
        $options = array();
        foreach ($data as $key => $row) {
            $options[$row['timezone_id']] = $row['time'] . ' - '
    //                . elgg_timezone_format_offset($row['offset'])
                    . ' ' . $row['timezone_id'];
        }
    }
    
    if ($is_pulldown) {
        $options = array('0' => elgg_echo('events:timezone:pulldown:label')) + $options;
    }
	
    return $options;
}

/**
 * Formats the offset of the array
 * 
 * @param int $offset
 * @return string 
 */

function elgg_timezone_format_offset($offset) {
    $hours = $offset / 3600;
    $remainder = $offset % 3600;
    $sign = $hours > 0 ? '+' : '-';
    $hour = (int) abs($hours);
    $minutes = (int) abs($remainder / 60);

    if ($hour == 0 && $minutes == 0) {
        $sign = ' ';
    }
    return 'GMT' . $sign . str_pad($hour, 2, '0', STR_PAD_LEFT)
            . ':' . str_pad($minutes, 2, '0');
}

/**
 * Validates if an input has a correct timezone format
 * 
 * @param string $timezone
 * @return boolean 
 */
function elgg_timezone_validate_input($timezone) {
	if (in_array($timezone, array_keys(elgg_timezone_get_timezones()))) { 
		return TRUE;
	}
	
	return FALSE;
}


/**
 * Save the timezone for one specific user
 * 
 * @param ElggUser $user
 * @param string $timezone
 * @return boolean 
 */
function elgg_timezone_set_timezone_user(ElggUser $user, $timezone = '') {
	$return_value = FALSE;
	$valid_timezone = elgg_timezone_validate_input($timezone);
	
	$valid_user = elgg_instanceof($user, 'user');
	
	if ($valid_user && $valid_timezone) {
		$user_guid = $user->getGUID();
		$return_value = elgg_set_plugin_user_setting('user_timezone', $timezone, $user_guid, 'events');
        elgg_set_plugin_user_setting('user_timezone_group', get_input('user_timezone_group'), $user_guid, 'events');
	}
	
	return $return_value;
}

/**
 * Get a specific timezone for one user
 * 
 * @param ElggUser $user
 * @return boolean 
 */
function elgg_timezone_get_timezone_user(ElggUser $user) {
	if (elgg_instanceof($user, 'user')) { 
		$value = elgg_get_plugin_user_setting('user_timezone', $user->getGUID(), 'events');
		return $value;
	}
	
	return FALSE;
}

function elgg_timezone_get_timezone_user_group(ElggUser $user) {
    $utg = FALSE;
	if (elgg_instanceof($user, 'user')) { 
		$utg = elgg_get_plugin_user_setting('user_timezone_group', $user->getGUID(), 'events');
	}
    
    if (empty($utg)) {
        $utg = 'united_states';
    }
	
	return $utg;
}

/**
 * Convert a specific time to seconds
 * 
 * @param time $time
 * @return int 
 */
function elgg_timezone_time_to_sec($time) { 
    $hours = substr($time, 0, -6); 
    $minutes = substr($time, -5, 2); 
    $seconds = substr($time, -2); 

    return $hours * 3600 + $minutes * 60 + $seconds; 
} 


/**
 * Convert seconds to time
 * 
 * @param int $seconds
 * @return time 
 */
function elgg_timezone_sec_to_time($seconds, $format_am_pm = FALSE) { 
    $hours = floor($seconds / 3600); 
    $minutes = floor($seconds % 3600 / 60); 
    $seconds = $seconds % 60; 
    
    if ($format_am_pm) {
        $t = 'AM';
        if ((int)$hours === 0) { // 0 hs
            $hours = $hours + 12;
        }
        elseif ((int)$hours === 12) {
            $t = 'PM';
        }
        elseif ((int)$hours > 11 && (int)$hours !== 12) {
            $hours = $hours - 12;
            $t = 'PM';
        }
        $return = sprintf("%d:%02d", $hours, $minutes) . ' ' . $t;
    }
    else {
        $return = sprintf("%d:%02d", $hours, $minutes);
    }
    
    return $return;
}


/**
 * Returns the offset from the origin timezone to the remote timezone, in seconds.
 * @param string $remote_tz
 * @param string $origin_tz; If null the servers current timezone is used as the origin.
 * @return int 
 */
function elgg_timezone_get_timezone_offset($remote_timezone, $origin_timezone = null) {
    if($origin_timezone === null) {
        if(!is_string($origin_tz = date_default_timezone_get())) {
            return false; // A UTC timestamp was returned -- bail out!
        }
    }
    $origin_dtz = new DateTimeZone($origin_timezone);
    $remote_dtz = new DateTimeZone($remote_timezone);
    $origin_dt = new DateTime("now", $origin_dtz);
    $remote_dt = new DateTime("now", $remote_dtz);
    $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
    return $offset;
}
