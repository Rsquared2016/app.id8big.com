<?php

if (elgg_is_active_plugin('keetup_categories')) {
    echo elgg_view('input/keetup_categories', $vars);
    return;
}

$input_type = elgg_extract('input_type',$vars, 'dropdown');

switch ($input_type) {
    case 'checkboxes':
	$categories = JobsSettings::getCategories(array('select_first' => FALSE));
	$vars['options'] = array_flip($categories);
	break;

    default:
	$categories = JobsSettings::getCategories(array('select_first' => TRUE));
	$vars['options_values'] = $categories;
	$input_type = 'dropdown';
	break;
}
echo elgg_view("input/{$input_type}", $vars);

