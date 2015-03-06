<?php

/**
 * BigBlueButton Integration
 */

if (!isset($vars['name'])) {
    $vars['name'] = 'duration';
}

$vars['options_values'] = meeting_get_duration_options();

echo elgg_view('input/dropdown', $vars);
echo '&nbsp;';
echo elgg_echo('meeting:hours');