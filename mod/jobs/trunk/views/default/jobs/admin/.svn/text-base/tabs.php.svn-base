<?php
/**
 * External pages menu
 *
 * @uses $vars['type']
 */

$tab = $vars['tab'];

//set the url
$url = elgg_get_site_url() . "admin/settings/jobs?tab=";
 
$pages = JobsSettings::getConfigPages();
$tabs = array();
foreach ($pages as $page) {
	$tabs[] = array(
		'title' => elgg_echo("jobs:admin:tabs:$page"),
		'url' => $url . $page,
		'selected' => $page == $tab,
	);
}

echo elgg_view('navigation/tabs', array('tabs' => $tabs, 'class' => 'elgg-form-settings'));
