<?php

/**
* register_exteps
*
* Override of the current register module
* 
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/
kt_register_gatekeeper();

$form = new userSubtypesForm;
$valid = $form->validate();

$errors = array();
$error = FALSE;

if ($valid == FALSE) {
	$errors = $form->getErrors();
}

if (count($errors) > 0) {
	register_error(elgg_echo('register_ext:error:all_fields_are_required'));
	forward(REFERER);
	die;
}

$fields = $form->getFormFields();
$values = array();

foreach($fields as $field_name => $field) {
	$values[$field_name] = $field['options']['value'];
}

$user_type = get_input('user_type');

switch($user_type) {
	case US_BAR:
		case US_COMPANY:
			//We have nothing to do here yet
	break;
		
		default:
			if (isset($values['name']) && isset($values['lastname'])) {
				$values['name'] = $values['name'].' '.$values['lastname'];
				unset($values['lastname']);
			}
		break;
}
//We extract all the variables in values array to process the data
extract($values);


if (!$CONFIG->disable_registration && !$error) {
// For now, just try and register the user
	try {
		$guid = register_user_subtype($username, $password, $name, $email, false, $friend_guid, $invite_code);
		if (((trim($password) != "") && (strcmp($password, $password2) == 0)) && ($guid)) {
			$new_user = get_entity($guid);
			if (($guid) && ($admin)) {
				// Only admins can make someone an admin
				admin_gatekeeper();
				$new_user->admin = 'yes';
			}

			// Send user validation request on register only
			global $registering_admin;
			if (!$registering_admin) {
				request_user_validation($guid);
			}

			if (!$new_user->admin) {
				// Now disable if not an admin
				// Don't do a recursive disable.  Any entities owned by the user at this point
				// are products of plugins that hook into create user and might need
				// access to the entities.
				$new_user->disable('new_user', false);
			}

			system_message(sprintf(elgg_echo("registerok"), $CONFIG->sitename));
			$form->__clearSession();

			// Forward on success, assume everything else is an error...
			forward();
		} else {
			register_error(elgg_echo("registerbad"));
		}
	} catch (RegistrationException $r) {
		register_error($r->getMessage());
	}
} else {
	if (!$error) {
		register_error(elgg_echo('registerdisabled'));
	}
}



forward(REFERER);
