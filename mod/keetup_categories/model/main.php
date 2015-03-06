<?php

/*
 * This is the main lib of keetup categories.
 */

//Load some libs.
require_once dirname(__FILE__) . '/kt_category.php';
require_once dirname(__FILE__) . '/kt_subcategory.php';


//Relationship between subcategory and category.
define('KT_CATEGORIES_SUBCAT_CAT_REL', 'kt_categories_subcat_cat');

//NO USED AT THIS TIME.
//Relationship between entity and category.
define('KT_CATEGORIES_CAT_ENTITY_REL', 'kt_categories_entity_cat');
//Relationship between entity and subcategory.
define('KT_CATEGORIES_SUBCAT_ENTITY_REL', 'kt_categories_entity_subcat');

//Relationship when a user follow a category.
define('KT_CATEGORIES_FOLLOW_CATEGORY', 'kt_categories_follow_cat');
//Relationship when a user follow a subcategory.
define('KT_CATEGORIES_FOLLOW_SUBCATEGORY', 'kt_categories_follow_subcat');


/**
 *  This function return the entities of the categories
 * @return array
 */
function kt_category_get_categories($category_group = false, $options = array()) {
	global $CONFIG;
	
	$default_category_group = array(
		'name' => 'category_group',
		'value' => 'default',
	);
	
	$default = array(
		'type' => 'object',
		'subtype' => 'kt_category',
		'joins' => " JOIN {$CONFIG->dbprefix}objects_entity oe on e.guid = oe.guid ",
		'order_by' => 'oe.title asc',
		'wheres' => array(),
		//Will search with default site categories.
		'metadata_name_value_pairs' => $default_category_group,
	);
	
	//Merge the options.
	$options = array_merge($default, $options);
		
	if($options['title'] != '') {
		$title = trim(sanitise_string($options['title']));
		if($title) {
			$options['wheres'][] = "oe.title like '%$title%'";
		}
	}

	//If is set category group, search with it.
	$count = 0;
	if ($category_group) {
		$options['metadata_name_value_pairs'] = array(
			'name' => 'category_group',
			'value' => $category_group,
		);
		$count = elgg_get_entities_from_metadata(array_merge(array('count' => TRUE), $options));
	}

	//If count equal to 0 => Get the default categories
	if ($count == 0) {
		$options['metadata_name_value_pairs'] = $default_category_group;
		$count = elgg_get_entities_from_metadata(array_merge(array('count' => TRUE), $options));
	}
	
	//if no success then show all the categories, this is correct ?
	if ($count == 0) {
		unset($options['metadata_name_value_pairs']);
		$count = 9999; //A pulldown with 99 values is too much.
	}

	$entities = elgg_get_entities_from_metadata(array_merge(array('limit' => $count), $options));

	return $entities;
}

/* Some extra functions */

/**
 * This function return the categories to be shown.
 * Format:
 * 	array(
 * 	'category_key' => 'category_title'
 * ) 
 */
function kt_category_get_categories_names($category_group = false) {
	$categories = array();

	$entities = kt_category_get_categories($category_group);

	if ($entities) {
		foreach ($entities as $entity) {
			$key = $entity->guid;
			$title = $entity->title;

			$categories[$key] = $title;
		}
	}

	return $categories;
}

/**
 * This function get the subcategories
 * @return array
 */
function kt_category_get_subcategories($category_group = false, $options = array()) {
	global $CONFIG;
	
	$default = array(
		'type' => 'object',
		'subtype' => 'kt_subcategory',
		'limit' => 0,
		'wheres' => array(),
		'joins' => array(),
		'selects' => array(),
		'callback' => '',
		
		'category_id' => '', //If empty will try to get from category group
		'title' => '',
	);
	
	$options = array_merge($default, $options);
	
	$categories_id = array();
	//Filter subcategory from a category id.
	$options['category_id'] = trim(sanitise_string($options['category_id']));
	if($options['category_id']) {
		$categories_id[] = $options['category_id'];
		
		unset($options['category_id']);
	} else {
		$categories = kt_category_get_categories($category_group);
		foreach ($categories as $category) {
			$categories_id[] = $category->getGUID();
		}
	}

	//Filter a certain subcategory for a title.
	$options['title'] = trim(sanitise_string($options['title']));
	if($options['title']) {
		$options['joins'][] = "JOIN {$CONFIG->dbprefix}objects_entity oe on oe.guid = e.guid";
		$options['wheres'][] = "( oe.title LIKE '{$options['title']}' )";
		
		unset($options['title']);
	}
	
	/*if ($category_group) {
		return get_annotations($categories_id, 'object', 'kt_category', 'kt_subcategory', '', 0, 9999);
	}
	
	return get_annotations(0, 'object', 'kt_category', 'kt_subcategory', '', 0, 9999);*/
	
	$options['joins'][] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid";
	$options['selects'][] = "r.guid_one as parent_guid";
	
	if ($category_group && count($categories_id)) {
		$options['wheres'][] = "r.relationship = '" . KT_CATEGORIES_SUBCAT_CAT_REL . "'";
		
		$categories_id_str = implode(', ', $categories_id);
		$options['wheres'][] = "r.guid_one in (".$categories_id_str.")";
	}
	
	$entities = elgg_get_entities($options);
	
	return $entities;
}

/**
 * This function return the categories to be shown.
 * Format:
 * 	array(
 * 		'category_key' => array(
 * 			'catogory_key"_"subcategory_key' => 'subcategory_value'
 * 			)
 * 	) 
 */
function kt_category_get_subcategories_names($category_group = false) {

	$ordered_subcategories = array();

	$subcategories = kt_category_get_subcategories($category_group);
	$subcategories_names = array();
	if ($subcategories) {
		foreach ($subcategories as $subcategory) {
			//$parent_key = $subcategory->entity_guid;
			//TODO: Ver si es necesario guardar el par para la clave. Quizas se puede sacar el guid del padre.
			/*$key = $parent_key . '_' . $subcategory->id;
			//$key = $subcategory->id;
			$title = $subcategory->value;*/
			$parent_key = $subcategory->parent_guid;
			

			
			$subcat_entity = entity_row_to_elggstar($subcategory);
			
			$key = $subcat_entity->getGUID();
			$title = $subcat_entity->getName();

			$subcategories_names[$parent_key][$key] = $title;
		}

		//Apply order.
		if ($subcategories_names) {
			foreach ($subcategories_names as $key => $category) {
				$cat_temp = $category;
				asort($cat_temp);
				$ordered_subcategories[$key] = $cat_temp;
			}
		}
	}

	return $ordered_subcategories;
}

function keetup_category_set_group($values = array()) {
	global $CONFIG;

	if (!is_array($values)) {
		return FALSE;
	}

	$values = elgg_trigger_plugin_hook('keetup_categories:allow', 'context', '', $values);
	
	//We have to validate twice, the argument passed before and the argument passed after the plugin hook to avoid errors.
	if (!is_array($values)) {
		return FALSE;
	}
	
	$values = array_unique($values);
	
	$CONFIG->keetup_categories->allowed_contexts = $values;
}

function keetup_category_get_group($json_value = false) {
	global $CONFIG;

	$contexts = $CONFIG->keetup_categories->allowed_contexts;

	$contexts_tmp = array();

	if (!is_array($contexts)) {
		return array();
	}
//
//	$current_lang = get_current_language();
//	$missing_keys = get_missing_language_keys($current_lang);
	
	foreach ($contexts as $context) {
		$tmp_translation = "keetup_categories:category_group:context:{$context}";
		
//		if (isset($missing_keys[$tmp_translation])) {
//			$tmp_translation = elgg_echo($tmp_translation);
//		} else {
//			$tmp_translation = elgg_echo($context);
//		}
		
//		$contexts_tmp[$context] = $tmp_translation;
		$contexts_tmp[$context] = elgg_echo($tmp_translation);
		
	}

	if ($json_value) {
		return json_encode($contexts_tmp);
	}

	if (is_array($contexts_tmp)) {
		asort($contexts_tmp);
		$contexts_tmp = array('default' => elgg_echo("keetup_categories:category_group:context:default")) + $contexts_tmp;
	}

	return $contexts_tmp;
}

/**
 * This function parse an XML to object.
 * 
 * @param type $xml_path
 * @return object 
 */
function kt_category_read_xml($xml_path) {
	$xml = '';
	//Elgg 1.5 and 1.6 friendly
	if (is_callable('xml_2_object')) {
		$xml = xml_2_object(file_get_contents($xml_path));
	} else if (is_callable('xml_to_object')) {
		//Elgg 1.7 friendly
		$xml = xml_to_object(file_get_contents($xml_path));
	}


	$data = array();
	if (isset($xml->children)) {
		foreach ($xml->children as $children) {
			if (!empty($children->content)) {
				switch ($children->name) {
					case 'allow':
						$data[] = $children->content;
					break;
				} //endswitch
			} //endif
		} //endforeach
	}

	return $data;
}