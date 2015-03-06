<?php
/**
 * Elgg text output
 * Displays some text that was input using a standard text field
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['text'] The text to display
 *
 */

$vars['value'] = (float) $vars['value'];
if (empty($vars['value'])) {
	$vars['value'] = 0;
}

echo "{$vars['value']} %";