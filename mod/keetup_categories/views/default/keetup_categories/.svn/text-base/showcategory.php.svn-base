<?php

	$clean = $vars['clean'];
	if(!$clean)
		$clean = false;
		
	$class = $vars['class'];
	if(!$class)
		$class = '';
	
	if (isset($vars['entity']->kt_category)) {
		$category = $vars['entity']->kt_category;
		if (isset($vars['entity']->kt_subcategory) && $vars['entity']->kt_subcategory != '') {
			$subcategory = $vars['entity']->kt_subcategory;
		}
	} else {
		if ($vars['category_id']) {
			$category = $vars['category_id'];
			if ($vars['subcategory_id']) {
				$subcategory = $vars['subcategory_id'];	
			}
		}
	}
	
	$array_cat = array();
	if ($category) {
		if(is_array($category) && count($category)>0) {
			foreach($category as $category_id) {
				
				if(is_array($subcategory) && count($subcategory) > 0) {
					$subcategory_id = array_shift($subcategory);

					$category_url = keetup_get_category_url($category_id);
					$category_title = keetup_get_category($category_id);
					$category_link = "<a href='$category_url' alt=\"$category_title\">$category_title</a>";

					$sub_category_title = keetup_get_subcategory($category_id, $subcategory_id);
					$sub_category_url = keetup_get_category_url($category_id, $subcategory_id);
					$sub_category_link = ' / ' . "<a href='$sub_category_url' alt=\"$sub_category_title\">$sub_category_title</a>";

					$array_cat[] = $category_link . $sub_category_link;
				}
			}
		}
		else {
			$category_id = $category;
			$subcategory_id = $subcategory;
			
			$category_url = keetup_get_category_url($category_id);
			$category_title = keetup_get_category($category_id);
			$category_link = "<a href='$category_url' alt=\"$category_title\">$category_title</a>";

			$sub_category_title = keetup_get_subcategory($category_id, $subcategory_id);
			$sub_category_url = keetup_get_category_url($category_id, $subcategory_id);
			$sub_category_link = ' / ' . "<a href='$sub_category_url' alt=\"$sub_category_title\">$sub_category_title</a>";
	
			$array_cat[] = $category_link . $sub_category_link;
		}
		
	}
	
	
		
	$title = '';
	if(!$clean)
		$title = '<label>' . elgg_echo('keetup_categories:category') . ': </label>'; 
	
	if(count($array_cat) > 0) {
		if(!$clean) {
			$cat = '<span>' . implode('<br />', $array_cat) . '</span>';
			echo "<div class=\"profile_field_info {$class}\">{$title}{$cat}<div class=\"clearfloat\"></div></div>";
		}
		else {
			if(empty($title))
				$cat = implode(' | ', $array_cat);
			else 
				$cat = '<span>' . implode('<br />', $array_cat) . '</span>';
			
			echo "{$title}{$cat}";
		}
	}
?>