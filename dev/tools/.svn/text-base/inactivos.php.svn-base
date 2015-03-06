<?php

	/**
	 * Elgg index page for web-based applications
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.org/
	 */

	/**
	 * Start the Elgg engine
	 */
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
		
		//admin_gatekeeper();
		define('externalpage',true);
		
		
		global $CONFIG;
		
		$guid = get_input('guid');
		
		$obj = get_entity($guid);
			if ( ($obj instanceof ElggUser) && ($obj->canEdit()))
		{
			if ($obj->delete())
				echo "Borrado";
			exit;
		}
		
		//$result = get_entities_from_metadata('validated',0,'user');
		
		if (!$result) {
			$result = get_data("SELECT e.*,u.* from {$CONFIG->dbprefix}entities e, {$CONFIG->dbprefix}users_entity u where type='user' and e.guid=u.guid and e.enabled='no'");			
		}
		
		$dbversion = (int) datalist_get('version');
		
		foreach($result as $user)
		{
			//if($dbversion >= 2010040201) { //1.7.1
			if($dbversion >= 2010030101) { //1.7
			   	$link = $CONFIG->site->url . "pg/uservalidationbyemail/confirm/?u=$user->guid&c=" . uservalidationbyemail_generate_code($user->guid, $user->email);
			   	$link = elgg_add_action_tokens_to_url($link);
			} else {
				$link = $CONFIG->site->url . "action/email/confirm?u=$user->guid&c=" . uservalidationbyemail_generate_code($user->guid, $user->email);
			}
		 
		   echo "{$user->name} - {$user->email} - <a href='{$link}'>$link</a><br />";  
		}
		
		exit;
		


?>