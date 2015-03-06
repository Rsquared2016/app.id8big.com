<?php

/**
 * BigBlueButton Integration
 */

$options = meeting_get_duration_options();

$value = $vars['value'];
if (isset($options[$value])) {
    $vars['value'] = $options[$value];
}

echo elgg_view('output/text', $vars);
echo '&nbsp;';
echo elgg_echo('meeting:hours');