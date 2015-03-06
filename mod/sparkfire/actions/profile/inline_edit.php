<?php

/**
 * Profile inline edit fields.
 */

//Inputs
$req_fields = sparkfire_get_req_fields();
$field_name = get_input('field_name');
$field_val = get_input($field_name);

$looking_for = get_input('looking_for');
$how_i_can_help = get_input('how_i_can_help');
$what_i_have_done = get_input('what_i_have_done');
$show_success = true;
$user = elgg_get_logged_in_user_entity();

try {
	if(in_array($field_name, $req_fields) && empty($field_val)) {
		throw new DataFormatException(elgg_echo("profile:required:field", array(elgg_echo("profile:$field_name"))));
	}
	
	//Save some data.
	if ($looking_for) {
		$user->looking_for = $looking_for;
	}

	if ($how_i_can_help) {
		$user->how_i_can_help = $how_i_can_help;
	}

	if ($what_i_have_done) {
		$user->what_i_have_done = $what_i_have_done;
	}
	
	//KTODO: Should we need to save the user ?
	/*if ($user->save()) {
	} else {
		throw new DataFormatException(elgg_echo('sparkfire:profile:inline:error:save'));
	}*/
	if($show_success) {
		system_message(elgg_echo('sparkfire:profile:inline:success:save'));
	}
} catch (Exception $e) {
	$msg = $e->getMessage();
	register_error($msg);
	
	//Return the current value.
	echo $user->$field_name;
}

forward(REFERER);