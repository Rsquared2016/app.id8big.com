<?php

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	global $CONFIG;
	
	$callback = get_input("callback", '');
	
	$category_id = get_input('category_id', "");
	$subcategory_id = get_input('subcategory_id', "");
	$show_multiple_categories_link = get_input('show_multiple_categories_link', "");
	$allow_multiple_categories = get_input('allow_multiple_categories', "");
	$allow_delete = get_input('allow_delete', "");
	
	$contents = elgg_view('input/keetup_categories', array(
															'category_value' => $category_id, 
															'subcategory_value' => $subcategory_id, 
															'allow_multiple_categories' => $allow_multiple_categories,
															'show_multiple_categories_link' => $show_multiple_categories_link, 
															'allow_delete' => $allow_delete));
	
	
	if($callback) {
		echo $contents;	
	}
	else {
		$title = elgg_echo('keetup_categories:searchcategories');
		$body = elgg_view_title($title);
		$body .= $contents;
		$body = elgg_view_layout('two_column_left_sidebar', '', $body);
		
		// Finally draw the page
		page_draw($category_title, $body);
	}
	
	exit;	

?>