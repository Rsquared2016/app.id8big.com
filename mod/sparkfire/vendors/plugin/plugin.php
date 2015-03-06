<?php
/**
* sparkfire
*
* @author Emanuel Kling
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_sparkfire;

function sparkfire_initializateplugin() {
	$ASKQUESTION_sparkfire = false;
	
	//Print the plugin version
	elgg_extend_view('metatags', 'sparkfire/version');

	if (isadminloggedin()) {
		if (!datalist_get('sparkfire_qfp')) {
			elgg_extend_view('page_elements/header_contents', 'sparkfire/admin/question/content');
		}
		elgg_extend_view('settings/sparkfire/edit', 'sparkfire/admin/question/doit');
	}
}

function sparkfire_qfp() {
	global $ASKQUESTION_sparkfire;
	$ASKQUESTION_sparkfire = true;
}
    
    function sparkfire_get_version($humanreadable = false){
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