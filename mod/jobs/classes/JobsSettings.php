<?php

/*
 * This class is used to set the settings of Jobs
 */

class JobsSettings {
	public function __construct() {
	}
	
	public static function getConfigPages() {
		$defined_pages = array('settings', 'categories', 'regions');
		
		return $defined_pages;
	}
	
	public static function getUsersTypesToPost() {
		$users_types = array(
			'Users' => 'user',
		);
		
		if(elgg_is_active_plugin('companies')) {
			$users_types['Companies'] = 'company';
		}
		
		//KTODO: Should trigger a hook of users to post.
		
		return $users_types;
	}
	
	public static function getUsersTypesCanPost() {
		$users_types = elgg_get_plugin_setting('users_types_can_post', 'jobs');
		
		if($users_types) {
			$users_types = unserialize($users_types);
		}
		
		return $users_types;
	}

	public static function userCanPostJob(ElggUser $user) {
		
		if(!elgg_instanceof($user, 'user')) {
			return false;
		}
		
		$allowed = false;
		
		$subtype = $user->getSubtype();
		if(!$subtype) {
			//No subtype means normal user.
			$subtype = $user->type;
		}
		
		$users_allowed = JobsSettings::getUsersTypesCanPost();
		
		if (is_array($users_allowed)) {
		    if(in_array($subtype, $users_allowed)) {
		    	$allowed = true;
		    }
		}
		
		if(elgg_is_admin_logged_in()) {
			$allowed = true;
		}
		
		
		return $allowed;
	}
	
	/**
	 * This function returns an array, with the options of the type.
	 * @param string $data_type The type of the simpletype to get the options.
	 * @param mixed $value The value that you want to filter.
	 * @param boolean $add_select_first If you want to show a select first option.
	 * @return array
	 */
	public static function getCategories($options = array(), $data_type = 'jobs_categories') {
		$default = array(
			'data_type' => $data_type, 
			'value' => null,
			'select_first' => FALSE, 
			'sort' => FALSE			
		);
		
		$options = array_merge($default, $options);
		extract($options);
		
		//$type_name = "{$data_type}_types";
		$type_name = "$data_type";
		
		$type_options = elgg_get_plugin_setting($type_name, 'jobs');
		
		$return_array = array();
		if($type_options) {
			$type_options = explode("\n", $type_options);
			foreach($type_options as $option) {
				$key = elgg_get_friendly_title($option);
				//$key = str_replace('-', '_', $key);
				$option_value = elgg_echo(trim($option));
				$return_array[$key] = $option_value;
			}
			
			if($sort) {
				//Sort elements
				asort($return_array);
			}
		}
		
		if (!is_null($value)) {
			if (is_array($value)) {
				$other_array = false;
				foreach ($value as $val) {
					if(isset($return_array[$val])) {
						$other_array[] = $return_array[$val];
					}
				}
			} else {
				if (isset($return_array[$value])) {
					$other_array = $return_array[$value];
				}
			}
			if ($other_array) {
				$return_array = $other_array; 
			}
		}
		
		
		if($select_first) {
			if(is_bool($select_first)) {
				$return_array = array('' => elgg_echo('jobs:simpletypes:select:one:'.$type_name)) + $return_array;
			} else {
				$return_array = array('' => $select_first) + $return_array;
			}
		}
		
		return $return_array;		
	}
	public static function getCategoriesRaw() {
		$categories = elgg_get_plugin_setting('jobs_categories', 'jobs');
		
		return $categories;
	}

	public static function getRegionsRaw() {
		$regions = elgg_get_plugin_setting('jobs_regions', 'jobs');
		
		return $regions;
	}	
}