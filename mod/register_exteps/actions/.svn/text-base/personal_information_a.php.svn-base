<?php

$user = elgg_get_logged_in_user_entity();
$user_guid = $user->getGUID();

elgg_make_sticky_form('personal_information');

$profile_form = new userProfileForm();
$success = $profile_form->save();
$profile_fields = $profile_form->renderFieldsToArray();


if ($success == TRUE) {

	foreach ($profile_fields as $field_name => $field_array) {
		$value = $field_array['value'];
		if (empty($value) && $field_array['required']) {

			if (isset($_SESSION['msg'])) {
				unset($_SESSION['msg']);
			}

			$user->next_step = 'personal_information';
			$user->save();

			register_error(elgg_echo("register_exteps:validate:exception", array('name' => elgg_echo("profile:{$field_name}"))));

			$next_url = elgg_get_site_url() . 'register/?tab=personal_information';
			forward($next_url);
		}

		if ($field_name == 'email') {
			try {

				$valid_email = validate_email_address($value);
				$is_registered = get_user_by_email($value);

				if ($is_registered) {
					if (isset($_SESSION['msg'])) {
						unset($_SESSION['msg']);
					}

					register_error(elgg_echo('registration:dupeemail'));
					forward(REFERER);
				}

				if ($valid_email) {
					$user->email = $value;
				}
			} catch (Exception $exc) {
				if (isset($_SESSION['msg'])) {
					unset($_SESSION['msg']);
				}

				register_error(elgg_echo('registration:emailnotvalid'));
				forward(REFERER);
			}
		}
	}
}

if (!$success) {


	$url = elgg_get_config('url') . 'register';
	$url = elgg_http_add_url_query_elements($url, array('tab' => 'personal_information'));

	forward($url);
}

elgg_clear_sticky_form('personal_information');

$user->next_step = 'go_home';
//$user->start_using = 'no';
$user->start_using = 'yes';
$user->save();

forward('activity');