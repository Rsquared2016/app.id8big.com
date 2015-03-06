<?php

$sex_types = kt_get_sex_types();
if (isset($vars['value']) && !empty($vars['value'])) {
	$value = $vars['value'];
	if (isset($sex_types[$value])) {
		$vars['value'] = $sex_types[$value];
		echo elgg_view('output/text',$vars );
	}
} else {
	return FALSE;
}