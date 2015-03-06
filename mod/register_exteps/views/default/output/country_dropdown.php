<?php

$options_values = kt_generate_country_dropdown();

$value = 0;

if (isset($vars['value']) && !empty($vars['value'])) {
	$value = $vars['value'];
}

if (isset($options_values[$value])) {
	$vars['value'] = $options_values[$value];
	echo elgg_view('output/text', $vars);
} else {
	return FALSE;
}