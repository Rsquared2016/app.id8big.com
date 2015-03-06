<?php
/**
 * Elgg radio input
 * Displays a radio input field
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value'] The current value, if any
 * @uses $vars['js'] Any Javascript to enter into the input tag
 * @uses $vars['internalname'] The name of the input field
 * @uses $vars['options'] An array of strings representing the options for the radio field as "label" => option
 *
 */

$class = $vars['class'];
if (!$class) {
	$class = "input-radio";
}

foreach($vars['options'] as $label => $option) {
	if (strtolower($option) != strtolower($vars['value'])) {
		$selected = "";
	} else {
		$selected = "checked = \"checked\"";
	}

	// handle indexed array where label is not specified
	// @todo deprecate in Elgg 1.8
	if (is_integer($label)) {
		$label = $option;
	}
	
	if (isset($vars['id'])) {
		$id = "id=\"{$vars['id']}\"";
	}
	if ($vars['disabled']) {
		$disabled = ' disabled="yes" ';
	}
	echo "<label>
			<input type=\"radio\" $disabled {$vars['js']} name=\"{$vars['name']}\" $id value=\"".htmlentities($option, ENT_QUOTES, 'UTF-8')."\" {$selected} class=\"$class\" />
			<span class=\"theTxt\">{$label}</span>
			<span class=\"cThis\">{$label}</span>
		  </label>";
}