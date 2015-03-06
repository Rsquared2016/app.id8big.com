<?php

/**
 * Dummies integrations with theme
 */
elgg_register_event_handler('init', 'system', 'theme_dummies_init');

/**
 * Initialize dummies init
 */
function theme_dummies_init() {

    //Add dummies examples on profile
    elgg_register_plugin_hook_handler('profile:fields', 'profile', 'theme_dummies_profile_custom');

    register_translations(dirname(dirname(__FILE__)) . '/languages_dummies/');
}

/**
 * Overrides the custom profile fields to add dummies fields
 * 
 * @param string $hook
 * @param string $type
 * @param mix $return
 * @param mix $params
 */
function theme_dummies_profile_custom($hook, $type, $return, $params) {
    $profile_fields = array(
	'description' => 'longtext',
	'briefdescription' => 'text',
	'location' => 'location',
	'interests' => 'tags',
	'skills' => 'tags',
	'contactemail' => 'email',
	'website' => 'url',
	
	'plain_description' => 'dummies/plaintext',
	'custom_date' => 'date',
	
	'checkboxes_v' => 'dummies/checkboxes_v',
	'checkboxes_h' => 'dummies/checkboxes_h',
	
	'pulldown' => 'dummies/pulldown_single',
	'pulldown_double' => 'dummies/pulldown_double',
	
	'radio_v' => 'dummies/radio_v',
	'radio_h' => 'dummies/radio_h',
	
	'autocomplete' => 'dummies/autocomplete',
	
	'two_texts' => 'dummies/two_texts',
	'birthdate' => 'dummies/birthdate',
	'dummy_file' => 'file',
	
	   
    );

    return $profile_fields;
}