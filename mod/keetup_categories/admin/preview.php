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
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

	elgg_set_context('admin');
	admin_gatekeeper();
	
	$title = elgg_echo('keetup_categories:test:category');
	
	$preview = elgg_view('keetup_categories/admin/preview_input');
	//$preview = elgg_view('input/keetup_categories', array('category_value' => $category, 'subcategory_value' => $subcategory));
	
	echo $preview;
	
	//$body = elgg_view_layout('two_column_left_sidebar', '', elgg_view_title($title) . $body);
	
	//page_draw($title, $body);