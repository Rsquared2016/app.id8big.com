<?php

/**
 * BigBlueButton Integration
 */

if (!isset($vars['name'])) {
    $vars['name'] = 'time';
}

$vars['options_values'] = meeting_get_time_options();

echo elgg_view('input/dropdown', $vars);
echo '&nbsp;';
echo elgg_echo('meeting:hours');