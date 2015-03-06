<?php
if(!elgg_is_active_plugin('meetups')) {
	return false;
}

$intervaltimes = meetup_get_intervaltimes();
$internalname = $vars['internalname'];
if (!$internalname) {
	$internalname = "time_hour_min";
}

$options = array(
	'internalid' => $internalname, 
	'internalname' => $internalname,
	'options_values' => $intervaltimes,
);

$options = array_merge($vars, $options);

echo elgg_view('input/pulldown', $options);
