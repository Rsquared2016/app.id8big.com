<?php
/**
* top_notifications
*
* @author German Scarel
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_top_notifications;

function top_notifications_initializateplugin() {
	$ASKQUESTION_top_notifications = false;
	
	//Print the plugin version
	elgg_extend_view('metatags', 'top_notifications/version');

	if (isadminloggedin()) {
		if (!datalist_get('top_notifications_qfp')) {
			elgg_extend_view('page_elements/header_contents', 'top_notifications/admin/question/content');
		}
		elgg_extend_view('settings/top_notifications/edit', 'top_notifications/admin/question/doit');
	}
}

function top_notifications_qfp() {
	global $ASKQUESTION_top_notifications;
	$ASKQUESTION_top_notifications = true;
}
    
    function top_notifications_get_version($humanreadable = false){
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