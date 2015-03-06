<?php

/**
 * Displays breadcrumbs.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['breadcrumbs'] (Optional) Array of arrays with keys 'title' and 'link'
 * @uses $vars['class']
 *
 * @see elgg_push_breadcrumb
 */
if (isset($vars['breadcrumbs'])) {
	$breadcrumbs = $vars['breadcrumbs'];
} else {
	$breadcrumbs = elgg_get_breadcrumbs();
}

$class = 'elgg-menu elgg-breadcrumbs';
$additional_class = elgg_extract('class', $vars, '');
if ($additional_class) {
	$class = "$class $additional_class";
}


$owner_block = elgg_view('page/elements/owner_block', $vars);
$owner_block_class = 'elgg-breadcrumbs-ownerblock';

if (!empty($owner_block)) {
	$class = $class .' hasAvatar';
}

if (is_array($breadcrumbs) && count($breadcrumbs) > 0) {
	echo "<ul class=\"$class\">";
	
	if (!empty($owner_block)) {
		echo "<li class='{$owner_block_class}'>{$owner_block}</li>";
	}
	
	foreach ($breadcrumbs as $breadcrumb) {
		if (!empty($breadcrumb['link'])) {
			$crumb = elgg_view('output/url', array(
				 'href' => $breadcrumb['link'],
				 'text' => $breadcrumb['title'],
				 'is_trusted' => true,
					  ));
		} else {
			$crumb = $breadcrumb['title'];
		}
		echo "<li>$crumb</li>";
	}
	echo '</ul>';
} else {

	if (!empty($owner_block)) {
		echo "<ul class=\"$class\">";
		echo "<li class='{$owner_block_class}'>{$owner_block}</li>";
		echo '</ul>';
	}
}
