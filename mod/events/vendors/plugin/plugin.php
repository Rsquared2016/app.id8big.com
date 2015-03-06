<?php
/**
* events
*
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_events;

function events_initializateplugin() {
	$ASKQUESTION_events = false;
	
	//Print the plugin version
	elgg_extend_view('page/elements/head', 'kt_news/version');

	if (elgg_is_admin_logged_in()) {
		if (!datalist_get('events_qfp')) {
			elgg_extend_view('page_elements/header_contents', 'events/admin/question/content');
		}
		elgg_extend_view('settings/events/edit', 'events/admin/question/doit');
	}
}

function events_qfp() {
	global $ASKQUESTION_events;
	$ASKQUESTION_events = true;
}
    
    function events_get_version($humanreadable = false){
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