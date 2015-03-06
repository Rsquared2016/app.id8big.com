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

//If set to true, will display text instead of links
$vars['show_text_only'] = TRUE;

echo elgg_view('news/output/tags',$vars);