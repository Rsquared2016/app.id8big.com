<?php
/**
* circles
*
* @author German Scarel
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_circles;

function circles_initializateplugin() {
	$ASKQUESTION_circles = false;
	
	//Print the plugin version
	elgg_extend_view('page/elements/head', 'circles/version');

	if (isadminloggedin()) {
		if (!datalist_get('circles_qfp')) {
			elgg_extend_view('page_elements/header_contents', 'circles/admin/question/content');
		}
		elgg_extend_view('settings/circles/edit', 'circles/admin/question/doit');
	}
}

function circles_qfp() {
	global $ASKQUESTION_circles;
	$ASKQUESTION_circles = true;
}
    
    function circles_get_version($humanreadable = false){
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