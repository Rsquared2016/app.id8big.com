<?php

	$admin_areas = array(
		'list',
		'categories',
//		'preview',
//		'settings',
	);
	
	$tab = get_input('tab', 'list');
	$op = get_input('op', 'list');
		
	if (!in_array($tab, $admin_areas)) {
		$tab = 'categories';
	}
	
	if(!get_input('tab')) {
		set_input('tab', $tab);
	}
	
	ob_start();
	
	
	include_once(elgg_get_plugins_path() . "keetup_categories/admin/$tab.php");
	$body .= ob_get_contents(); 
	ob_end_clean();
	
	$body = elgg_view('keetup_categories/admin/layout', array(
		'admin_areas' => $admin_areas,
		'current_area' => $tab,
		'body' => $body,
	));
	
	$title = elgg_echo('keetup_categories:admin:title');
	
	echo $body;