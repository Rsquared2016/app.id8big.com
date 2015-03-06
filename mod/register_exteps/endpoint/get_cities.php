<?php

/**
 * Get cities
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/engine/start.php');

$dbprefix = elgg_get_config('dbprefix');

//$valid_tokens = validate_action_token();

$output = '';
$province = get_input('state', false);

if (!elgg_is_logged_in() || empty($province)) {
	echo $output;
	return TRUE;
	die;
}

$options_values = kt_generate_city_dropdown($province);
	
echo elgg_view('input/dropdown', array('name' => 'city', 'options_values' => $options_values));
return TRUE;