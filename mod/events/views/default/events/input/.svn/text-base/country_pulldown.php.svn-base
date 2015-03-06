<?php

$pulldown_options = array(
	 'camelize_values' => TRUE,
	 'is_pulldown' => TRUE,
	 );

$vars['options_values'] = EventsBaseMain::ktform_get_country_values($pulldown_options);

if (!isset($vars['internalid'])) {
    $vars['internalid'] = 'select_country_pulldown';
}    

echo elgg_view('input/pulldown', $vars);