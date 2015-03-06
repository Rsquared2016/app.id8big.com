<?php

class PollsHandler extends PollsBaseHandler {
	
	public function __construct() {
		$type = 'object';
		$subtype = 'kt_poll'; //If empty add: ELGG_ENTITIES_ANY_VALUE
		$plugin_name = 'kt_polls';
		
		
		parent::__construct($type, $subtype, $plugin_name);
	}
	
	/**
	 * Get the entities filtered using default kt_polls_ktform filters.
	 * 
	 * @global type $CONFIG
	 * @param array $options
	 * @return entiites 
	 */
	/*public function get_filter_entities($options = array(), $filter_values_options = array()) {
		global $CONFIG;
		
		//Modify this lines and enter the code, you want to filter.
		
		return parent::get_filter_entities($options, $filter_values_options);
	}*/
	
}