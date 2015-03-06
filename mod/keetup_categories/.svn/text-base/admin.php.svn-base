<?php
	/**
	* keetup_categories
	*
	* @author Pedro Prez
	* @link http://community.elgg.org/profile/pedroprez
	* @copyright (c) Keetup 2010
	* @link http://www.keetup.com/
	* @license GNU General Public License (GPL) version 2
	*/

	// Get the Elgg engine
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	elgg_set_context('admin');
	admin_gatekeeper();
	
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
	include_once(dirname(__FILE__) . "/admin/$tab.php");
	$body .= ob_get_contents(); 
	ob_end_clean();
	
	$body = elgg_view('keetup_categories/admin/layout', array(
		'admin_areas' => $admin_areas,
		'current_area' => $tab,
		'body' => $body,
	));
	
	$title = elgg_echo('keetup_categories:admin:title');
	$body = elgg_view_layout('two_column_left_sidebar', '', elgg_view_title($title) . $body);
	page_draw($title, $body);
?>