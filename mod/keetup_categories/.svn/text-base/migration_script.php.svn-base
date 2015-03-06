<?php

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	global $CONFIG;
	
	
	$search = "category";
	
	$count_entities = get_entities_from_metadata($search, "", "", "", 0, 0, 0, "", null, true);
	$entities = get_entities_from_metadata($search, "", "", "", 0, $count_entities, 0, "", null, false);
		
/*	$entity = array_shift($entities);
	
	$category = $entity->category;
	$category_array = array(0 => $category);
	$subcategory = $entity->subcategory;
	$subcategory_tmp = explode("_", $subcategory);
	$subcategory_tmp_count = count($subcategory_tmp);
	$subcategory = $subcategory_tmp[$subcategory_tmp_count-1]; 
	if(!is_array($category)) {
		//$entity->clearMetadata('category');
	 	$entity->category = $category_array;
		//$entity->clearMetadata('subcategory');
		$subcategory_array = array(0 => ($category."_".$subcategory));
		$entity->subcategory = $subcategory_array;
	}

	var_dump($category_array);
	var_dump($subcategory_array);
	
	var_dump($entity->category);
	var_dump($entity->subcategory);
	
*/	
	
	if($entities) {
		foreach($entities as $entity) {
			$category = $entity->category;
			
			if(!is_array($category)) {
				$category_array = array(0 => $category);
				$subcategory = $entity->subcategory;
				
				if($subcategory) {
					$subcategory_tmp = explode("_", $subcategory);
					$subcategory_tmp_count = count($subcategory_tmp);
					$subcategory = $subcategory_tmp[$subcategory_tmp_count-1]; 
					$subcategory_array = array(0 => ($category."_".$subcategory));
				}
				else {
					//If its not set the subcategory.
					$subcategory_array = array(0 => '0');
				}

				//$entity->clearMetadata('category');
			 	$entity->category = $category_array;
				//$entity->clearMetadata('subcategory');
				$entity->subcategory = $subcategory_array;
			}
		}
	}
	
	
	exit;
	
?>