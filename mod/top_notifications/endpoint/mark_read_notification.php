<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/engine/start.php');

global $CONFIG;

$user_loggedin = elgg_get_logged_in_user_entity();

if ($user_loggedin) {
	$data = array();
	$data['error'] = FALSE;
	
	$result = top_notifications_mark_read_notifications();
	
	if (!$result) {
		$data['error'] = TRUE;
		//throw new Exception('Couldn\'t execute the statitics table setup: ' . $query);
	}
	
	echo json_encode($data);
	return;
}