<?php

/**
 * Elgg pulldown display
 * Displays a value that was entered into the system via a pulldown
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['text'] The text to display
 * @uses $vars['options_values'] an array of options values to associate
 *
 */

if (isset($vars['options_values']) && isset($vars['options_values'][$vars['value']])) {
	$vars['value'] = $vars['options_values'][$vars['value']];
}

echo htmlentities($vars['value'], ENT_QUOTES, 'UTF-8'); //$vars['value'];