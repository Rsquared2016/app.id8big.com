<?php

$value = '';
if($vars['value']) {
	$value = $vars['value'];
	$value = explode('_', $value);
}

//Month
$options_values = array();

$start = 1;
$end = 12;
for($i = 1; $i <= $end; $i++) {
	$options_values[] = $i;
}

$custom_internalname = 'date';
if (!empty($vars['custom_internalname'])) {
	$custom_internalname = $vars['custom_internalname'];
}

$vars['options'] = $options_values;
$vars['internalid'] = $custom_internalname.'_month';
$vars['internalname'] = $custom_internalname.'_month';

if($value) {
	$vars['value'] = $value[0];
} else {
	$vars['value'] = date('m');
}

echo elgg_view('input/pulldown', $vars);

//Year
$options_values = array();

$year_type = 'past';
if (isset($vars['year_type'])) {
	$year_type = $vars['year_type'];
}

switch($year_type) {
	case 'past':
		$end =  date('Y');
		$start = $end - 60;
		break;
	case 'future':
		$start = date('Y');
		$end = $start + 25;
	break;
}

for($i = $end; $i >= $start; $i--) {
	$options_values[] = $i;
}

$vars['options'] = $options_values;
$vars['internalid'] = $custom_internalname.'_year';
$vars['internalname'] = $custom_internalname.'_year';

if($value) {
	$vars['value'] = $value[1];
} else {
	$vars['value'] = date('Y');
}

echo elgg_view('input/pulldown', $vars);