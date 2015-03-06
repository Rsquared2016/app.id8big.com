<?php

$provincias = kt_generate_provincias_pulldown();
$value = 0;

if (isset($vars['value']) && !empty($vars['value'])) {
	$value = $vars['value'];
}

if (isset($provincias[$value])) {
	$vars['value'] = $provincias[$value];
	echo elgg_view('output/text', $vars);
} else {
	return FALSE;
}
