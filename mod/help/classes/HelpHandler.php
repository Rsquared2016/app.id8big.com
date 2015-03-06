<?php

class HelpHandler extends HelpBaseHandler {
	
	public function __construct() {
		$type = 'object';
		$subtype = 'help'; //If empty add: ELGG_ENTITIES_ANY_VALUE
		$plugin_name = 'help';
		
		
		parent::__construct($type, $subtype, $plugin_name);
	}
	
	/**
	 * Get the entities filtered using default help_ktform filters.
	 * 
	 * @global type $CONFIG
	 * @param array $options
	 * @return entiites 
	 */
	public function get_filter_entities($options = array(), $filter_values_options = array()) {
		
		//Modify this lines and enter the code, you want to filter.
		$default = array(
			'filter_by_user_type' => FALSE,
		);
		
		$options = array_merge($default, $options);
		
		//Add filter by user type options.
		if($options['filter_by_user_type'] && is_callable('kt_get_user_subtype')) {
			$user_type = kt_get_user_subtype();
			$options['metadata_name_value_pairs'] = array(
				array(
					'name' => 'user_content_type',
					'value' => $user_type,
				),
			);

		}
		
		return parent::get_filter_entities($options, $filter_values_options);
	}
	
}