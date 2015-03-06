<?php

$options = array(
    'Checkbox 1' => 1,
    'Checkbox 2' => 2,
    'Checkbox 3' => 3,
    'Checkbox 4' => 4,
);

$vars['options'] = $options;
$vars['align'] = 'horizontal';

echo elgg_view('output/checkboxes', $vars);