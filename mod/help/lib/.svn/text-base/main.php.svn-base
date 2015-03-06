<?php
/**
* help
*
* Main Lib description here...
* 
* @author BOrtoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

/* 
*  This is the main library
*/
/*
 * Other functions.
 */

function help_get_user_types_content($checkboxes = TRUE, $select_first = FALSE) {
	
	$user_subtypes = elgg_trigger_plugin_hook('user_subtypes_get', 'user', array(), false);
	if(is_array($user_subtypes) && !empty($user_subtypes)) {
		if($checkboxes) {
			$user_subtypes = array_flip($user_subtypes);
		}
		
		if($select_first) {
			$select_first_str = elgg_echo("help:select:first");
			$user_subtypes = array('' => $select_first_str) + $user_subtypes;
		}
	}
	
	return $user_subtypes;
}

function help_get_logged_in_user_subtype() {
	
	$user_subtypes = elgg_trigger_plugin_hook('user_subtypes_get_logged_in_type', 'user', array(), false);
	if(is_array($user_subtypes) && !empty($user_subtypes)) {
		if($checkboxes) {
			$user_subtypes = array_flip($user_subtypes);
		}
		
		if($select_first) {
			$select_first_str = elgg_echo("help:select:first");
			$user_subtypes = array('' => $select_first_str) + $user_subtypes;
		}
	}
	
	return $user_subtypes;
}