<?php
/**
* register_exteps
*
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_register_exteps;

function register_exteps_initializateplugin() {
	$ASKQUESTION_register_exteps = false;
	
	//Print the plugin version
	elgg_extend_view('metatags', 'register_exteps/version');

	if (elgg_is_admin_logged_in()) {
		if (!datalist_get('register_exteps_qfp')) {
			elgg_extend_view('page_elements/header_contents', 'register_exteps/admin/question/content');
		}
		elgg_extend_view('settings/register_exteps/edit', 'register_exteps/admin/question/doit');
	}
}

function register_exteps_qfp() {
	global $ASKQUESTION_register_exteps;
	$ASKQUESTION_register_exteps = true;
}
    
    function register_exteps_get_version($humanreadable = false){
    if (include(dirname(dirname(dirname(__FILE__))) . "/version.php")) {
		return (!$humanreadable) ? $version : $release;
	}
	return FALSE;
    }
    
//Generate url for accept action on elgg 1.7
if(!is_callable('url_compatible_mode')) {
    function url_compatible_mode($hook = '?') {
    	$now = time();
		$query[] = "__elgg_ts=" . $now;
		$query[] = "__elgg_token=" . generate_action_token($now);
		$query_string = implode("&", $query);
		return $hook . $query_string;
    }
}