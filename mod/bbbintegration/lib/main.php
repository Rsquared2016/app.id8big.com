<?php
/**
* meeting
*
* Main Lib description here...
* 
* @author BOrtoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

function meeting_get_time_options($is_pulldown = TRUE) {

    $init_hour = 0;
    $division_time = 288;
    $time_mult = 300; // 5 min

    $options = array(
        '' => elgg_echo('meeting:time:select'),
    );
    for ($i = $init_hour; $i < $division_time; $i++) {
        $seconds = $i * $time_mult;
        
        $key = elgg_timezone_sec_to_time($seconds);
        $value = elgg_timezone_sec_to_time($seconds, TRUE);
        
        $options[$key] = $value;
    }

    return $options;
    
}

function meeting_get_duration_options($is_pulldown = TRUE) {
    
    $init_hour = 1;
    $end_hour = 13;
    $time_mult = 60; // 60 min = 1 hour

    $options = array(
        0 => elgg_echo('meeting:duration:select'),
    );
    for ($i = $init_hour; $i < $end_hour; $i++) {
        $minutes = $i * $time_mult;
        
        $options[$minutes] = $i;
    }

    return $options;
    
}

function meeting_get_participants_options($is_pulldown = TRUE) {
    
    // Default -1 asi BBB toma ilimitado numero de participantes
    $options = array(
        0 => elgg_echo('meeting:participants:select'),
    );
    
    for ($i = 1; $i < 21; $i++) {
        $options[$i] = $i;
    }

    if (!$is_pulldown) {
        unset($options['0']);
    }
    
    return $options;
    
}

function meeting_can_join_to_meeting ($user_guid, $meeting_guid) {
    $user = get_user($user_guid);
    $meeting = get_entity($meeting_guid);
    
    $return = FALSE;
    
    if ( ($user instanceof ElggUser) && ($meeting instanceof Meeting) ) {
        $can_join = $meeting->canJoin();
        if ($can_join) {
            $are_complete = $meeting->areCompleteNumberParticipants();
            if (!$are_complete) {
                $is_member = FALSE;
                $container = $meeting->getContainerEntity();
                if (elgg_instanceof($container, 'group')) {
                    $is_member = $container->isMember();
                }
                
                if ($is_member) {
                    $return = TRUE;
                } else {
                    $return = FALSE;
                }
            }
        }
        
    }
    
    return $return;
}

/**
 * Get online users
 * 
 * A function that returns a maximum of $limit users who have done something within the last
 * $seconds seconds or the total count of active users.
 * 
 * @param array $options An array of options
 *  - 'seconds' Number of seconds (default 300 = 10min)
 *  - 'limit'   Limit, default 10.
 *  - 'offset'  Offset, default 0.
 *  - 'count'   Count, default false.
 */
function meeting_get_online_users($options = array()) {

    global $CONFIG;

    $user_logged_in = elgg_get_logged_in_user_guid();
    if (!$user_logged_in) {
        return false;
    }
	
	if (!is_array($options)) {
        $options = array();
    }

	$seconds = 300;
	if (array_key_exists('seconds', $options)) {
		$seconds = $options['seconds'];
	}
	
    $time = time() - $seconds;

    $default = array(
        'type' => 'user',
        'limit' => 10,
        'offset' => 0,
        'count' => false,
        'joins' => array(
            "join {$CONFIG->dbprefix}users_entity u on e.guid = u.guid",
        ),
        'wheres' => array(
            "u.last_action >= {$time}",
            "e.guid != $user_logged_in",
        ),
        'order_by' => "u.last_action desc",
    );
    $options = array_merge($default, $options);
            
    if (defined('MEETING_FRIENDS_ONLINE_USERS') && MEETING_FRIENDS_ONLINE_USERS) {
        $friends = get_user_friends($user_logged_in, "", 999999, 0);
        if ($friends) {
            $friendguids = array();
            foreach ($friends as $friend) {
                $friendguids[] = $friend->getGUID();
            }
            $options['guid'] = $friendguids;
        } else {
            return false;
        }
    }
	
	if (array_key_exists('relationship', $options)) {
		$users = elgg_get_entities_from_relationship($options);
	}
	else {
		$users = elgg_get_entities($options);
	}
	
    return $users;
    
}

function meeting_get_user_time_start($meeting, $with_format = FALSE){
    $user = elgg_get_logged_in_user_entity();
    $user_timezone = elgg_timezone_get_timezone_user($user);	

    if (is_callable('elgg_timezone_get_timezone_site')) {
        // Function added into this module
        $server_timezone = elgg_timezone_get_timezone_site();
    }
    else {
        $server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
    }

    if (!$user_timezone) {
        $user_timezone = $server_timezone;
    }

    $offset_time = elgg_timezone_get_timezone_offset($meeting->timezone, $server_timezone);
	
	$star_date_time = $meeting->site_start_datetime;
	
	$return_time = $star_date_time + $offset_time;
    
    if ($with_format) {
        $default_timezone = date_default_timezone_get();
        date_default_timezone_set($user_timezone);
        $return_time = date($with_format, $return_time);
        date_default_timezone_set($default_timezone);
    }
	
	return $return_time;
	
}


function meeting_get_user_time_end($meeting, $with_format = FALSE){
	$user = elgg_get_logged_in_user_entity();
    $user_timezone = elgg_timezone_get_timezone_user($user);	

    if (is_callable('elgg_timezone_get_timezone_site')) {
        // Function added into this module
        $server_timezone = elgg_timezone_get_timezone_site();
    }
    else {
        $server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
    }

    if (!$user_timezone) {
        $user_timezone = $server_timezone;
    }

    $offset_time = elgg_timezone_get_timezone_offset($meeting->timezone, $server_timezone);
	
	$star_date_time = $meeting->site_end_datetime;
	
	$return_time = $star_date_time + $offset_time;
    
    if ($with_format) {
        $default_timezone = date_default_timezone_get();
        date_default_timezone_set($user_timezone);
        $return_time = date($with_format, $return_time);
        date_default_timezone_set($default_timezone);
    }
	
	return $return_time;
	
}