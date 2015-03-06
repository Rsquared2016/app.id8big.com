<?php

class GtaskHandler extends GtaskBaseHandler {
	
	public function __construct() {
		$type = 'object';
		$subtype = 'gtask'; //If empty add: ELGG_ENTITIES_ANY_VALUE
		$plugin_name = 'gtask';
		
		
		parent::__construct($type, $subtype, $plugin_name);
	}
	
	/**
	 * Get the entities filtered using default gtask_ktform filters.
	 * 
	 * @global type $CONFIG
	 * @param array $options
	 * @return entiites 
	 */
	public function get_filter_entities($options = array(), $filter_values_options = array()) {
		$default = array(
			'start_time_date' => '',//Y-m-d H:i:s
			'end_time_date' => '', //Y-m-d H:i:s
			'start_time_date_end' => '',
			'end_time_date_end' => '',
			'container_guid' => ELGG_ENTITIES_ANY_VALUE, 
			'my_calendar' => FALSE,			
			'metadata_name_value_pairs' => array(),
			'key_sortable' => FALSE,
		);
		
		$options = array_merge($default, $options);
		
		if($options['start_time_date']) {
			$options['metadata_name_value_pairs'][] = array(
						'name' => 'calendar_end',
						'value' => date('Y-m-d', strtotime($options['start_time_date'])),
						'operand' => '>=',
						);

		} 
		unset($options['start_time_date']);
		if($options['start_time_date_end']) {
			$options['metadata_name_value_pairs'][] = array(
						'name' => 'calendar_end',
						'value' => date('Y-m-d', strtotime($options['start_time_date_end'])),
						'operand' => '<=',
						);
		} 
		unset($options['start_time_date_end']);
		
		if($options['my_calendar']) {
			$options['metadata_name_value_pairs'][] = array(
					'name' => 'responsive',
					'value' => elgg_get_logged_in_user_guid(),
			);
		} 
		unset($options['my_calendar']);
		$results = parent::get_filter_entities($options, $filter_values_options);
		
		$new_result = array();
		if($results && $options['key_sortable']) {
			foreach($results as $key => $entity) {
				$new_key = sprintf('%s_%s', strtotime($entity->calendar_end), $entity->guid);
				$new_result[$new_key] = $entity;
			}
		} else {
			$new_result = $results;
		}
		
		return $new_result;
	}
	
}