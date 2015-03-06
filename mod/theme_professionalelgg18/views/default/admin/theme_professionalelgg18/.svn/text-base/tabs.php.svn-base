<?php
/**
 * External pages menu
 *
 * @uses $vars['type']
 */

$tab = elgg_extract('tab', $vars);

//set the url
$url = elgg_get_site_url() . "admin/appearance/theme_professional?tab=";
 
$pages = ThemeSettings::getConfigPages();
$tabs = array();
foreach ($pages as $page) {
	$tabs[] = array(
		'title' => elgg_echo("admin:appearance:theme:tabs:$page"),
		'url' => $url . $page,
		'selected' => $page == $tab,
	);
}

echo elgg_view('navigation/tabs', array('tabs' => $tabs, 'class' => 'elgg-form-settings'));
