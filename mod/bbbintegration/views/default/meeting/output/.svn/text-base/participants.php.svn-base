<?php

/**
 * BigBlueButton Integration
 */

$options = meeting_get_participants_options();

$value = $vars['value'];
if (isset($options[$value])) {
    $vars['value'] = $options[$value];
}

echo elgg_view('output/text', $vars);