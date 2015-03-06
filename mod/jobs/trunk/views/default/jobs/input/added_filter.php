<?php

$vars['options_values'] = array(
    'last_1_day' => elgg_echo('jobs:filter:add_filter:option:last_1_day'),
    'last_7_days' => elgg_echo('jobs:filter:add_filter:option:last_7_days'),
    'last_30_days' => elgg_echo('jobs:filter:add_filter:option:last_30_days'),
    'all_along' => elgg_echo('jobs:filter:add_filter:option:all_along'),
);

//RadioButtons Integration
$vars['options'] = array_flip($vars['options_values']);
unset($vars['options_values']);
echo elgg_view('input/radio', $vars);
//End of that

//echo elgg_view('input/dropdown', $vars);
