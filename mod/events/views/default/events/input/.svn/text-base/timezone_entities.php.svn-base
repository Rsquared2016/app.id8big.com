<?php

/**
 * Timezone
 */

$united_states = elgg_timezone_get_timezones(FALSE, TRUE);
$all_the_world = elgg_timezone_get_timezones(FALSE);

$value = elgg_extract('value', $vars);
$class = elgg_extract('class', $vars, 'elgg-input-dropdown');

$timezone_group = FALSE;
$entity = elgg_extract('entity', $vars, FALSE);
if ($entity instanceof ElggObject) {
    $timezone_group = $entity->timezone_group;
}

if (empty($timezone_group)) {
    if (array_key_exists($value, $united_states)) {
        $timezone_group = 'united_states';
    }
    elseif(array_key_exists($value, $all_the_world)) {
        $timezone_group = 'all_the_world';
    }
    else {
        $timezone_group = 'united_states';
    }
}

// Input timezon group
$input_timezone_group = elgg_view('input/dropdown', array(
    'name' => 'timezone_group',
    'id' => 'timezone_group',
    'options_values' => elgg_timezone_get_timezones_group(),
    'value' => $timezone_group,
    'class' => $class,
));
echo $input_timezone_group;

// Timezone
if ($timezone_group == 'united_states') {
    $vars['options_values'] =  elgg_timezone_get_timezones(FALSE, TRUE);
}
else {
    $vars['options_values'] = elgg_timezone_get_timezones(FALSE);
}
$vars['id'] = $vars['name'];

$input_timezone = elgg_view('input/dropdown', $vars);

echo $input_timezone;

//user_timezone
$input_united_states = elgg_view('input/dropdown', array(
    'id' => 'united_states',
    'options_values' => $united_states,
//    'value' => $value,
    'class' => 'hidden',
));
$input_all_the_world = elgg_view('input/dropdown', array(
    'id' => 'all_the_world',
    'options_values' => $all_the_world,
//    'value' => $value,
    'class' => 'hidden',
));
echo $input_united_states;
echo $input_all_the_world;