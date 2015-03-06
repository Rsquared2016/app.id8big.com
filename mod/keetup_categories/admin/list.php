<?php
	
	/*
	 * Keetup categories.
	 * */ 
	global $CONFIG;

	$offset = get_input('offset', 0);
	$limit = get_input('limit', 15);
	
	$filter_by = get_input('filter_by', FALSE);
	
	//List elements
	$options = array(
		'type' => 'object',
		'subtype' => 'kt_category',
		'limit' => $limit,
		'offset' => $offset,
	);
	
	if ($filter_by) {
		$options['metadata_name_value_pairs'] = array('name' => 'category_group', 'value' => $filter_by);
	}
	
	//Apply order only
	$options = array_merge(array(
		'joins' => "JOIN {$CONFIG->dbprefix}objects_entity oe on e.guid = oe.guid",
		'order_by' => 'oe.title asc'			
	), $options);
	
	$entities_count = elgg_get_entities_from_metadata(array_merge($options, array('count' => TRUE)));
	$entities = elgg_get_entities_from_metadata($options);
	

		$vars = array(
			'items' => $entities,
			'count' => (int) $entities_count, // the old count parameter
			'offset' => $options['offset'],
			'limit' => (int) $options['limit'],
			'full_view' => FALSE,
			'pagination' => FALSE,
			'list_type' => TRUE,
		);	
	
	
	$elements = elgg_view_entity_list($entities, $vars);
	
//$elements = elgg_list_entities(array_merge(array('full_view' => FALSE, 'pagination' => TRUE), $options));	
	
	if(!$elements) {
		$elements = '<p>' . elgg_echo('keetup_categories:category:no:categories') .'</p>';
	}

	//Wrapper list.
	echo elgg_view('keetup_categories/list_wrapper', array('elements' => $elements)); 
	
