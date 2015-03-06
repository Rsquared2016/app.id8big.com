<?php

class KtJobHandler extends KtJobBaseHandler {
	
	public function __construct() {
		$type = 'object';
		$subtype = 'job'; //If empty add: ELGG_ENTITIES_ANY_VALUE
		$plugin_name = 'jobs';
		
		
		parent::__construct($type, $subtype, $plugin_name);
	}
	
	/**
	 * Get the entities filtered using default jobs_ktform filters.
	 * 
	 * @global type $CONFIG
	 * @param array $options
	 * @return entiites 
	 */
	public function get_filter_entities($options = array(), $filter_values_options = array()) {
		global $CONFIG;
		
		//Check additiona filters
		if($options['filters']) {
			$options['metadata_name_value_pairs'] = array();
			foreach ($options['filters'] as $key => $val) {
				$options['metadata_name_value_pairs'][] = array(
					'name' => $key,
					'value' => $val,
				);
			}
			
			unset($options['filters']);
		}
		
		if($options['added']) {
			switch($options['added']) {
				case 'last_30_days': //Jobs between the last 30 days.
					//$start_time = mktime () - 30 * 3600 * 24;

					//Start:	"2012-09-11 00:00:00"
					//End:		"2012-10-11 00:56:28"						
					$start_time = mktime(0, 0, 0, date('m'), date('d')-30, date('Y')); 
					$end_time = time();

					$options['created_time_lower'] = $start_time;
					$options['created_time_upper'] = $end_time;

					break;
				case 'last_7_days': //Jobs between the last 30 days.
					//$start_time = mktime () - 30 * 3600 * 24;

					//Start:	"2012-09-11 00:00:00"
					//End:		"2012-10-11 00:56:28"						
					$start_time = mktime(0, 0, 0, date('m'), date('d')-7, date('Y')); 
					$end_time = time();

					$options['created_time_lower'] = $start_time;
					$options['created_time_upper'] = $end_time;

					break;
				case 'last_1_day': //Jobs between the last 30 days.
					//$start_time = mktime () - 30 * 3600 * 24;

					//Start:	"2012-09-11 00:00:00"
					//End:		"2012-10-11 00:56:28"						
					$start_time = mktime(0, 0, 0, date('m'), date('d')-1, date('Y')); 
					$end_time = time();

					$options['created_time_lower'] = $start_time;
					$options['created_time_upper'] = $end_time;

					break;
			}
			unset($options['added']);
		}
		
		return parent::get_filter_entities($options, $filter_values_options);
	}
	
}