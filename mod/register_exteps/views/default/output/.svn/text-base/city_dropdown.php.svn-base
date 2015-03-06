<?php

$context = elgg_get_context();

if ($context == 'profile') {
	$page_owner = elgg_get_page_owner_entity();
	if (!$page_owner) {
		return false;
	}
	$province = (int)$page_owner->state;
}

$options_values = kt_generate_city_dropdown($province);

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