<?php

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	global $CONFIG;
	
	$offset = get_input("offset", 0);
	$limit = 10;
	
	elgg_set_context('search');
	
	$category_id = get_input('category_id');
	$subcategory_id = get_input('subcategory_id');
	
	$entity_type = get_input('entity_type',NULL);
	$entity_subtype = get_input('entity_subtype',NULL);
	$entity_context = get_input('entity_context');
	
	if ($entity_context) {
		elgg_set_context($entity_context);
	}
	
	$category_title  = keetup_get_category($category_id);
	$subcategory_title  = keetup_get_subcategory($category_id, $subcategory_id); 
	
//	if($subcategory_title)
//		$category_title = "$category_title / $subcategory_title";
	
	$search_terms = array();
	if($category_id)
		$search_terms['kt_category'] = $category_id;

	if($subcategory_id)
		$search_terms['kt_subcategory'] = $subcategory_id;
		
//	$count_entities = get_entities_from_metadata_multi($search_terms, "", "", "", $limit, $offset, "", null, true);
//	$entities = get_entities_from_metadata_multi($search_terms, "", "", "", $limit, $offset, "", null, false);
	
	$options = array(
		'metadata_name_value_pairs' => $search_terms,
		'limit' => $limit,
		'offset' => $offset,
		'count' => TRUE,
		'metadata_name_value_pairs_operator' => 'and',
		'type' => $entity_type,
		'subtype' => $entity_subtype,
	);
	$count_entities = elgg_get_entities_from_metadata($options);
	unset($options['count']);
	$entities = elgg_get_entities_from_metadata($options);
	
	if($count_entities > 0){
		
		$nav = elgg_view('navigation/pagination',array(
														'base_url' => $_SERVER['REQUEST_URI'],
														'offset' => $offset,
														'count' => $count_entities,
														'limit' => $limit,
													  ));
		$contents = '';													  
		foreach($entities as $entity){
			
			$classes = array(
								'ElggUser' => 'user',
								'ElggObject' => 'object',
								'ElggGroup' => 'group'
							);
				
			$entity_class = get_class($entity);
				
			if (isset($classes[$entity_class])) {
				$entity_type = $classes[$entity_class];
			} else {
				foreach($classes as $class => $type) {
					if ($entity instanceof $class) {
						$entity_type = $type;
						break;
					}
				}
			}
			
			$contents .= elgg_view("keetup_categories/default/default",array('entity' => $entity));
		}
	}
	
//	$title = elgg_echo('keetup_categories:searchcategories');
	$title = elgg_echo('keetup_categories:searchcategories:title',
			array(
				'entity_title' => elgg_echo("item:$entity_type:$entity_subtype:plural"),
				'category_title' => $category_title
		));
	if ($subcategory_title != 'Other') {
		$title .= elgg_echo('keetup_categories:searchsubcategories:title',array($subcategory_title));
	}
	$body = elgg_view_title($title);
	$body .= $nav . $contents . $nav;
	
//	$body = elgg_view_layout('two_column_left_sidebar', '', $body);
	$vars = array(
		 'content' => $body,
	);
	$body = elgg_view_layout('two_column_left_sidebar', $vars);
	
	// Finally draw the page
//	page_draw($category_title, $body);
	echo elgg_view_page($category_title, $body);
?>