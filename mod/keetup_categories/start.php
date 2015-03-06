<?php

	/* Keetup Categories Module */
	
	//Include some libs
	require_once dirname(__FILE__) . '/model/main.php';
	
	define('KT_CATEGORIES_SUBCAT_OTHER_INPUT', 'subcategory_new_title');
	
	/* Initialise Keetup Categories Module */
	function keetup_categories_init(){
		global $CONFIG;
		
		//Other subcategory
		$CONFIG->keetup_categories->allowed_other_subcategories = TRUE;
		$CONFIG->keetup_categories->other_subcategories_context = array('opportunities');
		
		/**
		 * Set contexts it register a plugin hook too
		 */
		$allowed_contexts_path = dirname(__FILE__).'/config/allowed_contexts.xml';
		$allowed_xml = kt_category_read_xml($allowed_contexts_path);
		keetup_category_set_group($allowed_xml);
		
		//Extend css view
		elgg_extend_view('css/elgg','keetup_categories/css');
		elgg_extend_view('css/admin', 'keetup_categories/admin/css');
		
		//KTODO: Hacer configurable esto.
		//for objects
		elgg_register_event_handler('create','object','keetup_set_categories');
		elgg_register_event_handler('update','object','keetup_set_categories');
//		
//		//for groups
//		elgg_register_event_handler('create','group','keetup_set_categories');
//		elgg_register_event_handler('update','group','keetup_set_categories');
		
		//for users
		elgg_register_event_handler('create','user','keetup_set_categories');
		elgg_register_event_handler('update','user','keetup_set_categories');
		
		//KTODO: Hacer configurable esto.
		//For users update profile fields.
//		elgg_register_plugin_hook_handler('profile:fields', 'profile', 'keetup_categories_set_profile_fields');
		
		
		elgg_register_event_handler('delete','object','kt_category_delete_subcategories');
		
		//Set Page Handler
		elgg_register_page_handler('categories','categories_page_handler');
		
		//Extend some views.
		elgg_extend_view('footer/analytics', 'js/keetup_categories', 400);
		
		//Register some actions.
		elgg_register_action("keetup_categories/add", $CONFIG->pluginspath . "keetup_categories/actions/add.php", 'admin');
		elgg_register_action("keetup_categories/delete", $CONFIG->pluginspath . "keetup_categories/actions/delete.php", 'admin');
		
		elgg_register_action("keetup_categories/follow", $CONFIG->pluginspath . "keetup_categories/actions/follow.php", 'logged_in');
		elgg_register_action("keetup_categories/unfollow", $CONFIG->pluginspath . "keetup_categories/actions/unfollow.php", 'logged_in');
		
		// Register entity type and class
        // This is needed to handle the Class
		add_subtype("object", "kt_category", "KtCategory");
		add_subtype("object", "kt_subcategory", "KtSubCategory");
		
		//Set default context to empty categoryes
		run_function_once('keetup_categories_set_groups');
		
		//Compatibility function.
		//run_function_once('keetup_categories_convert_subcat');
		
		elgg_register_plugin_hook_handler('action', 'all', 'keetup_categories_create_other_subcategory');
		
		elgg_extend_view('input/categories', 'categories_support/input');
		elgg_extend_view('output/categories', 'categories_support/output');
	}
	
	function keetup_categories_create_other_subcategory($hook, $object_type, $returnvalue, $params) {
		$input_name = 'subcategory_id';
		$object_type = 'object';
		$object_subtype = 'kt_subcategory';
		$autocomplete_name = KT_CATEGORIES_SUBCAT_OTHER_INPUT;

		$input_value = get_input($input_name);
		$input_category = get_input('category_id');
		$input_auto_value = get_input($autocomplete_name);

		$dbprefix = get_config('dbprefix');

		if ($input_value == 'other' && !empty($input_category) && !empty($input_auto_value)) {
			//Check if there is a subcategory with the same title.
			//Avoid duplicate entries.
			$input_auto_value = trim(sanitize_string($input_auto_value));
			$options = array(
				'limit' => 1,
				'category_id' => $input_category, //Parent category.
				'title' => $input_auto_value,
				'callback' => 'entity_row_to_elggstar', //Remember this.
			);

			$tmp_entity = kt_category_get_subcategories(false, $options);
			if ($tmp_entity) {
				$entity = current($tmp_entity);
				set_input($input_name, $entity->getGUID());
				$input_value = $entity->getGUID();
			} else {
				$options['title'] = $input_auto_value;

				$guid = kt_categories_subcategory_save(0, $options, $input_category);
				if ($guid) {
					set_input($input_name, $guid);
					$input_value = $guid;
				} else {
					register_error(elgg_echo('keetup_categories:subcategories:other:text:error:saving'));
					return FALSE;
				}
			}
		}
		
		// Save in session subcategory id
		if ($input_value) {
			$_SESSION['subcategory_id'] = $input_value;
		}
	}	
	
	function keetup_categories_convert_subcat () {
		//Convert old anotations to objets.
		
		//Clear all anotations
		//$kt_category->clearAnnotations('kt_subcategory');
	}
	
	function keetup_categories_set_groups() {
		$options = array(
			'count' => TRUE,
			'type' => 'object',
			'subtype' => 'kt_category',
		);
		
		$counts = elgg_get_entities($options);
		unset($options['count']);
		
		$options['limit'] = $counts;
		$entities = elgg_get_entities($options);
		
		foreach($entities as $category) {
			if (empty($category->category_group)) {
				$category->category_group = 'default';
			}
		}
	}
	
	function keetup_categories_setup() {
		global $CONFIG;
		if (elgg_get_context() == 'admin') {
			
				elgg_register_admin_menu_item('administer', 'keetup_categories', 'administer_utilities');
			
//    		add_submenu_item(elgg_echo("keetup_categories"), $CONFIG->wwwroot . "categories/admin/" );
		}
	}
	
	function keetup_categories_set_profile_fields($hook, $entity_type, $return_value, $params) {

		if($hook == 'profile:fields' && $entity_type == 'profile') {
			//This is only a seed, to filter, then we will modify the edit/view profile.
			$categories_field = array('keetup_categories' => 'keetup_categories');
			$return_value = array_merge($return_value, $categories_field);
		}
		
		return $return_value;
	}
	
	
	
	function categories_page_handler($page) {
		
		global $CONFIG;

		if (isset($page[0])) {
			
			switch($page[0]) {
				case 'admin':
					!@include_once(dirname(__FILE__) . "/admin.php");
						return false;
					break;
					
				default:
					if (isset($page[0])) {
						set_input('category_id', $page[0]);		
					}
					
					if (isset($page[2])) {
						set_input('subcategory_id', $page[2]);		
					}

					include($CONFIG->pluginspath . "keetup_categories/index.php");
					break;
			}
		}
	}
	
	/**
	 * This function save the relationship between an entity and a category.
	 * @param type $event
	 * @param type $object_type
	 * @param type $object 
	 */
	function keetup_set_categories($event, $object_type, $object){
		
		$category = get_input('category_id');
		$sub_category = get_input('subcategory_id');
		
		if(is_array($category)) {
			$object->kt_category = $category;
			
			$subcategory_array = array();
			foreach($category as $index => $category_id) {
				if(isset($sub_category[$index])) {
					$subcategory_array[$index] = $sub_category[$index];
				}
				else {
					//Other category. Not visible to select.
					$subcategory_array[$index] = 0;
				}
			}
			$object->kt_subcategory = $subcategory_array;	
		}
		else {
			if($category)
				$object->kt_category = $category;
	
			if($sub_category)
				$object->kt_subcategory = $sub_category;	
		}
		
		//This is set to enabled profile fields.
		if($object->kt_category || $object->kt_subcategory) {
			//This has to be done, because, we could get the entity inside the output view.
			$object->keetup_categories = $object->getGUID();
		}
		
			
	}
	
	function kt_category_delete_subcategories($event, $object_type, $object){

		if($event == 'delete' && $object instanceof KtCategory) {
			return $object->deleteSubcategories();			
		}
		
		return true;
	}
	
	
	function keetup_categories_get_categories($category_group = FALSE){
		
		$categories = kt_category_get_categories_names($category_group);
								
		return $categories;
		
	}
	
	
	function keetup_categories_get_subcategories($other_subcategory = false, $category_group = FALSE){
			
			$subcategories = kt_category_get_subcategories_names($category_group);
			
			if($other_subcategory) {
				$subcategories = array('0' => elgg_echo('Other')) + $subcategories;
			}
						
			return $subcategories;
		
	}
		
	function keetup_get_category($category_id){
		//New one: the category is an objet.
		//Is more direct, is less work for the db.
		$title = '';
		$category = get_entity($category_id);
		if($category) {
			$title = $category->title;
		}
		
		return $title;
	}
	
	function keetup_get_subcategory($category_id,$subcategory_id){
		$subcategories = keetup_categories_get_subcategories(true);
		
		if(!$subcategory_id)
			return $subcategories[0];
		else
			return $subcategories[$category_id][$subcategory_id];
	}
	
	function keetup_get_category_id($category_name){
		
		$categories = keetup_categories_get_categories();
		
		if($key = array_search($category_name, $categories))
			return $key; 
			
		return false;
	}
	
	function keetup_get_subcategory_id($subcategory_name){
		
		$subcategories = keetup_categories_get_subcategories();
		
		if($key = array_search($subcategory_name, $subcategories))
			return $key; 
			
		return false;
	}
	
	function keetup_get_category_url($category_id, $subcategory_id = 0){
		
		global $CONFIG;
		
		if($category_id){
			$category_str = keetup_get_category($category_id);
			$category_str = elgg_get_friendly_title($category_str);
			
			if($subcategory_id){
				$subcategory_str = keetup_get_subcategory($category_id, $subcategory_id);
				$subcategory_str = elgg_get_friendly_title($subcategory_str);
				
				return $CONFIG->url . "categories/{$category_id}/{$category_str}/{$subcategory_id}/{$subcategory_str}/";
				
			}
			
			return $CONFIG->url . "categories/{$category_id}/{$category_str}/";
		
		}
		
		return $CONFIG->url . "categories/";

	}
	

	
	// Initialise log browser
	elgg_register_event_handler('init','system','keetup_categories_init');
	elgg_register_event_handler('pagesetup','system','keetup_categories_setup');
