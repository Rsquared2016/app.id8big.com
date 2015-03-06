<?php
	$entity = $vars['entity'];
	if(!$entity) {
		$entity = get_entity($vars['value']);
	}
	
	$entity_type = $entity->getType();
	$entity_subtype = $entity->getSubtype();
	$entity_context = elgg_get_context();

	$clean = $vars['clean'];
	if(!$clean)
		$clean = true;
	
	$show_category_only_info = false;
	if(array_key_exists('show_category_only_info', $vars)) {
		$show_category_only_info = $vars['show_category_only_info'];
	}
	
	$with_subcategory = true;
	if(array_key_exists('with_subcategory', $vars))
		$with_subcategory = $vars['with_subcategory'];
		
		
	$class = $vars['class'];
	if(!$class)
		$class = '';
	
	if (isset($entity->kt_category)) {
		$category = $entity->kt_category;
		if (isset($entity->kt_subcategory) && $entity->kt_subcategory != '') {
			$subcategory = $entity->kt_subcategory;
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

					$category_url = keetup_get_category_url($category_id);
					$category_url = $category_url . "?entity_subtype=$entity_subtype&entity_type=$entity_type&entity_context=$entity_context";
					$category_title = keetup_get_category($category_id);
					$category_link = "<a href='$category_url' alt=\"$category_title\">$category_title</a>";

					if($with_subcategory) { 
						$subcategory_id = array_shift($subcategory);
						$sub_category_title = keetup_get_subcategory($category_id, $subcategory_id);
						$sub_category_url = keetup_get_category_url($category_id, $subcategory_id);
						$sub_category_url = $sub_category_url . "?entity_subtype=$entity_subtype&entity_type=$entity_type&entity_context=$entity_context";
						$sub_category_link = ' / ' . "<a href='$sub_category_url' alt=\"$sub_category_title\">$sub_category_title</a>";
					}

					$array_cat[] = $category_link . $sub_category_link;
				}
			}
		}
		else {
			$category_id = $category;
			
			$category_url = keetup_get_category_url($category_id);
			$category_url = $category_url . "?entity_subtype=$entity_subtype&entity_type=$entity_type&entity_context=$entity_context";
			$category_title = keetup_get_category($category_id);
			$category_link = "<a href='$category_url' alt=\"$category_title\">$category_title</a>";

			if($with_subcategory) {
				$subcategory_id = $subcategory;
				$sub_category_title = keetup_get_subcategory($category_id, $subcategory_id);
				$sub_category_url = keetup_get_category_url($category_id, $subcategory_id);
				$sub_category_url = $sub_category_url . "?entity_subtype=$entity_subtype&entity_type=$entity_type&entity_context=$entity_context";
				$sub_category_link = '';
				if (!$show_category_only_info) {
					$sub_category_link = ' / ';
				}
				$sub_category_link .= "<a href='$sub_category_url' alt=\"$sub_category_title\">$sub_category_title</a>";
			}
			if (!$show_category_only_info) {
				$array_cat[] = $category_link . $sub_category_link;
			}
			else {
				$array_cat[] = $sub_category_link;
			}
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