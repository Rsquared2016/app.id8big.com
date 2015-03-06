<?php

if (isset($vars['value']) && !empty($vars['value'])) {
	$value = $vars['value'];
	
	$tmp_date = $value;
	
	$vars['value'] = strftime('%d/%m/%Y', $tmp_date);
} else {
	return FALSE;
}

echo elgg_view('output/text', $vars);