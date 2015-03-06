<?php
$value = elgg_extract('value', $vars);

if (!is_array($value)) {
    $value = explode(',', $value);
    $vars['value'] = $value;
}

$options = array(
    'Checkbox 1' => 1,
    'Checkbox 2' => 2,
    'Checkbox 3' => 3,
    'Checkbox 4' => 4,
);

$vars['options'] = $options;
$vars['align'] = 'horizontal';

echo elgg_view('input/checkboxes', $vars);