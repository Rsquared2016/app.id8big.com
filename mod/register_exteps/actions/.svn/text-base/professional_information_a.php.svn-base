<?php
/**
 * Save the DNI number
 */
$user = ProfileComplete::get_user_entity();

$success = FALSE;
$dni = get_input('dni');

//$dni = process_dni_number($dni);

if ($dni) {
	create_metadata($user->getGUID(), 'dni', $dni, '', $user->getGUID(), ACCESS_PRIVATE);
	$user->next_step = 'go_home';
//	system_message(elgg_echo('register:exteps:professional_information:success'));
} else {
//	register_error(elgg_echo('register:exteps:professional_information:error'));
	forward('activity');
}


forward(register_exteps_get_step_url());