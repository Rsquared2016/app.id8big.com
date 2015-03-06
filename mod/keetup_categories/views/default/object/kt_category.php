<?php
/**
 * Rm Question display
 * 
 */

if(get_input('ktform_integration', FALSE)) {
	//Ktform integration.
	echo elgg_view('object/ktform', $vars);
	
} else {
	if ($vars['full']) {
		echo elgg_view("keetup_categories/kt_category_full",$vars);
	} else {
		if (get_input('search_viewtype') == "gallery") {
			echo elgg_view('keetup_categories/kt_category_gallery',$vars); 				
		} else {
			echo elgg_view("keetup_categories/kt_category_list",$vars);
		}
	}
}

	
	