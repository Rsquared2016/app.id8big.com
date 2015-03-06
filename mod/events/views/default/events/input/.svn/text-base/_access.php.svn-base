<?php

/**
 * Elgg access level input
 * Displays a dropdown input field
 *
 * @uses $vars['value']          The current value, if any
 * @uses $vars['options_values'] Array of value => label pairs (overrides default)
 * @uses $vars['name']           The name of the input field
 * @uses $vars['entity']         Optional. The entity for this access control (uses access_id)
 * @uses $vars['class']          Additional CSS class
 */

if (defined('EVENTS_ACCESS_CUSTOM') && EVENTS_ACCESS_CUSTOM) {
	$event = $vars['entity'];
	
	if (elgg_instanceof($event, '', '', 'Events')) {
		$vars['value'] = events_access_get_access_to_form($event);
	}
}

echo elgg_view('input/access', $vars);