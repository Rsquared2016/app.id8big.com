<?php

gatekeeper();

$has_file = FALSE;
$has_input_file = FALSE;
$icon_file = FALSE;

$guid = elgg_get_logged_in_user_guid();
$tmp_user = get_entity($guid);
set_input('guid', $guid);

$user = FALSE;

//$is_editing_profile = TRUE;

if ($tmp_user) {
	if ($tmp_user->canEdit()) {
		$user = $tmp_user;
	}
}

$user = ProfileComplete::get_user_entity();

$next_step = 'personal_information';
$url = elgg_get_config('url') . 'register';
$url = elgg_http_add_url_query_elements($url, array('tab' => $next_step));



if ($user) {
	set_input('guid', $user->getGUID());

	if ($user->icontime) {
		$has_file = TRUE;
	}
}

//We set the page owner so the iconupload can process it, usefull when admin wants to change the other profiles icons
set_page_owner($user->getGUID());

if (isset($_FILES['avatar'])) {
	$icon_file = $_FILES['avatar'];
}

if (is_array($icon_file) && !empty($icon_file['name']) && !empty($icon_file['size'])) {
	$has_input_file = TRUE;
}



if ($has_file == FALSE && $has_input_file == FALSE) {
//	register_error(elgg_echo('register:exteps:profile_icon:error'));
	forward($url);
	die;
}

set_input('kt_skeep_forward', TRUE);

if ($has_input_file) {
	$editicon_action = elgg_get_root_path() . 'actions/avatar/upload.php';

	require_once($editicon_action);
}

if (empty($is_editing_profile)) {
	set_input('kt_skeep_forward', FALSE);
}



$user->next_step = $next_step;
forward(register_exteps_get_step_url());