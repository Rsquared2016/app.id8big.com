<?php
/**
 * Elgg display long text
 * Displays a large amount of text, with new lines converted to line breaks
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value'] The text to display
 * @uses $vars['parse_urls'] Whether to turn urls into links. Default is true.
 * @uses $vars['excerpt'] The ammount of characters to excerpt the text
 */

$parse_urls = isset($vars['parse_urls']) ? $vars['parse_urls'] : TRUE;

$excerpt = FALSE;
if (array_key_exists('excerpt', $vars)) {
	if (!empty($vars['excerpt']) && is_numeric($vars['excerpt'])) {
		$excerpt = $vars['excerpt'];
	}
}

$filter_tags = TRUE;
if (array_key_exists('filter_tags', $vars)) {
	$filter_tags = $vars['filter_tags'];
}

$text = $vars['value'];
if ($excerpt) {
	$text = elgg_get_excerpt($text, $excerpt);
}

if ($filter_tags) {
	$text = filter_tags($text);
}

if ($parse_urls) {
	$text = parse_urls($text);
}

$text = autop($text);

echo $text;
