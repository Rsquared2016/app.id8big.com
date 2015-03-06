<?php

class MeetingHandler extends MeetingBaseHandler {
	
	public function __construct() {
		$type = 'object';
		$subtype = 'meeting'; //If empty add: ELGG_ENTITIES_ANY_VALUE
		$plugin_name = 'meeting';
		
		
		parent::__construct($type, $subtype, $plugin_name);
	}
	
	/**
	 * Get the entities filtered using default meeting_ktform filters.
	 * 
	 * @global type $CONFIG
	 * @param array $options
	 * @return entiites 
	 */
	public function get_filter_entities($options = array(), $filter_values_options = array()) {
		global $CONFIG;
        $user = elgg_get_logged_in_user_entity();
        $current_timezone = date_default_timezone_get();

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

        $offset_time = elgg_timezone_get_timezone_offset($user_timezone, $server_timezone);

        date_default_timezone_set($server_timezone);

        //Default start time.
        //Default start time.
        $default_start = mktime(0, 0, 0, date('m'), 1, date('Y')); //First day of current month.
        $default_end = mktime(23, 59, 59, date('m')+1, 0, date('Y')); //Last day of current month.

        if (isset($options['start_time_date'])) {
            $from_time = strtotime($options['start_time_date']);
        } else {
            $from_time = $default_start;	
        }

        if (isset($options['end_time_date'])) {
            $to_time = strtotime($options['end_time_date']);
        } else {
            //$to_time = $default_end;
        }

		if (isset($options['start_time_date_end'])) {
			$from_time_end = strtotime($options['start_time_date_end']);
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
        
        $default = array(
            //Entities Params.
            'types' => 'object',
            'subtypes' => 'meeting',
            'metadata_name_value_pairs' => array(),
            'metadata_name_value_pairs_operator' => 'AND',
            'limit' => 50, //KTODO: Limit ?
            'offset' => 0,
        );
        
        if(!is_array($options)) {
            $options = array($options);
        }
    	$options = array_merge($default, $options);
//        $options = $default;
        if($from_time) {
            $options['metadata_name_value_pairs'][] = array(
                        'name' => 'site_start_datetime',
                        'value' => $from_time,
                        'operand' => '>=',
                        );
        }
		if($from_time_end) {
			$options['metadata_name_value_pairs'][] = array(
						'name' => 'site_start_datetime',
						'value' => $from_time_end,
						'operand' => '<=',
						);
		}
		
        if($to_time) {
            $options['metadata_name_value_pairs'][] = array(
                        'name' => 'site_end_datetime',
                        'value' => $to_time,
                        'operand' => '<=',
                        );
        }
        
        $entities = parent::get_filter_entities($options, $filter_values_options);
        
        $return = array();
        if (isset($options['key_sortable']) && $options['key_sortable'] == TRUE) {
            foreach ($entities as $entity) {
                $meeting = get_entity($entity->guid);
                $return["{$meeting->site_start_datetime}_{$entity->guid}"] = $meeting;
            }
        } else {
            $return = $entities;
        }
        
		return $return;
	}
	
}