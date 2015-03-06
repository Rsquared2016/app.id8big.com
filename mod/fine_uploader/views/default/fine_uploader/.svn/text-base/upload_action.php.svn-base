<?php

$return = array();
$return['success'] = TRUE;
$return['error'] = '';
$return['result'] = '';

$input_name = 'upload';

if (!empty($_FILES[$input_name]['name']) && $_FILES['upload']['error'] != 0) {
	$return['error'] = elgg_echo('file:cannotload');
	$return['success'] = FALSE;
}

if (empty($_FILES[$input_name]['name'])) {
	$return['error'] = elgg_echo('file:nofile');
	$return['success'] = FALSE;
}

$tmp_folder = elgg_get_data_path() . 'file_tmp/';
if (FALSE === is_dir($tmp_folder)) {
	mkdir($tmp_folder, 0777);
}

$file_uploaded = elgg_extract('upload', $_FILES);

$tmp_name = elgg_extract('tmp_name', $file_uploaded);
$real_name = elgg_extract('name', $file_uploaded);
if (file_exists($tmp_name)) {
	$unique_name = uniqid('f');
	$new_tmp_name = $tmp_folder . $unique_name;

//	$uploaded_file = get_uploaded_file($input_name);
//	file_put_contents($new_tmp_name, $uploaded_file);
	move_uploaded_file($tmp_name, $new_tmp_name);
//	copy($tmp_name, $new_tmp_name);
	chmod($new_tmp_name, 0777);

	$return['result'] = "{$unique_name},{$real_name}";
} else {
	$return['error'] = elgg_echo('file:nofile');
	$return['success'] = FALSE;
}


echo json_encode($return);
