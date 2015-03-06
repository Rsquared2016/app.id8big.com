<?php
/**
* jobs_ktform
*
* @author BOrtoli German and German Bortoli
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_jobs_ktform;

function jobs_ktform_initializateplugin() {
	$ASKQUESTION_jobs_ktform = false;
	
	//Print the plugin version
	elgg_extend_view('page/elements/head', 'jobs_ktform/version');

	if (elgg_is_admin_logged_in()) {
		if (!datalist_get('jobs_ktform_qfp')) {
			elgg_extend_view('page_elements/header_contents', 'jobs_ktform/admin/question/content');
		}
		elgg_extend_view('settings/jobs_ktform/edit', 'jobs_ktform/admin/question/doit');
	}
}

function jobs_ktform_qfp() {
	global $ASKQUESTION_jobs_ktform;
	$ASKQUESTION_jobs_ktform = true;
}
    
    function jobs_ktform_get_version($humanreadable = false){
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