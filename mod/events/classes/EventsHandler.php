<?php

class EventsHandler extends EventsBaseHandler {
	
	public function __construct() {
		$type = 'object';
		$subtype = 'event'; //If empty add: ELGG_ENTITIES_ANY_VALUE
		$plugin_name = 'events';
		
		
		parent::__construct($type, $subtype, $plugin_name);
	}
	
	/**
	 * Get the entities filtered using default events_ktform filters.
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