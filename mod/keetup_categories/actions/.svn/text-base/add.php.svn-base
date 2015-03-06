<?php

//Validate loged in and admin.
	admin_gatekeeper();

//Get inputs.
	$guid = get_input('guid', null);
	$category = get_input('category');
	$sub_categories = get_input('sub_categories', '', false);
	//eg: array(array(
	//			'value' => 'title', 
	//			'id' => 'guid', 
	//			'action' => 'delete' //In case we are deleting.
	//	)); 

	$category_group = get_input('category_group'); 

//Url to forward in case of error.
	$qsreferer = explode('?',$_SERVER['HTTP_REFERER']);
	$qs = $qsreferer[0] . '?';
	$qs .= 'tab=categories'; //Add tab redirection.
	$qs .= '&category='.urlencode($category);


//Validate inputs.
	$error = false;	
	//if(!$category || !$sub_categories) {
	if(!$category) { //Allow to add categories, with empty subcategories.
		register_error(elgg_echo('keetup_categories:category:required:fields'));
		$error = true;
	}

//Save data.
	if(!$error) {
		//Define access.
		$acces_id = ACCESS_PUBLIC;
		//Onwer 
		$owner = elgg_get_logged_in_user_guid();
		$container_guid = elgg_get_logged_in_user_guid();

		//Category Object
		$kt_category = new KtCategory($guid);

		if(is_null($guid)) {
			$kt_category->owner_guid = $owner; 
			$kt_category->container_guid = $container_guid;
		}

		$kt_category->access_id = $acces_id;

		$kt_category->title = $category;
		$kt_category->category_group = $category_group;

		if($kt_category->save()) {
			//Now save the sub_categories.
			if($sub_categories && is_array($sub_categories) && count($sub_categories) > 0) {
				foreach($sub_categories as $subcategory) {

					$result = false;
					if(is_array($subcategory)) {
						$value = $subcategory['value'];
						$id = $subcategory['id'];
						$action = $subcategory['action'];

						switch($action) {
							case 'delete':
								if($id) {
									//Delete subcategory.
									$kt_subcategory = get_entity($id);
									if($kt_subcategory instanceof KtSubCategory) {
										//Delete already clear all relationships.
										$result = $kt_subcategory->delete();
									}
								}
								break;
							case 'update':
								//Force to update.
								//Not implemented
								break;

							//Add
							default:
								//We could be editing or adding.
								//if(!$id) { //Optimizacion.
									$options['title'] = $value;
									$result = kt_categories_subcategory_save($id, $options, $kt_category->getGUID());
									
								//}

								break;
						}

					}

					if(!$result) {
						$error = true;
						register_error(elgg_echo('keetup_categories:subcategory:error:saving'));
						break;
					}
				}
			}

			// Success message
			system_message(elgg_echo("keetup_categories:category:saved"));
		} else {
			register_error(elgg_echo('keetup_categories:category:error:saving'));
			$error = true;
		}
	}

//Redirect
	if(is_null($guid) && $error) {
		//add
		forward($qs);
	} else if($error) {
		//Error on edit.
		forward($_SERVER['HTTP_REFERER']);
	}else {
		//forward to list
		//forward('categories/admin/?tab=list');

		//Forward to add new one, general we want to add more than once category.
		//Fast input.
		forward("admin/administer_utilities/keetup_categories?tab=categories&category_group={$category_group}");
	}
