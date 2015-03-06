<?php

/*
 * This is the KtCategory class, an extension of elggObject
 * */

class KtSubCategory extends ElggObject {

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "kt_subcategory";
	}
	
	public function __construct($guid = null) {
		parent::__construct($guid);
	}
	
	public function getName() {
		return $this->title;
	}
	
	public function getEntityLinkActions() {
		return false;
	}
	
	
	public function isFollowing($params = array()) {
		$default = array(
			'guid_one' => elgg_get_logged_in_user_guid(),
			'relationship' => KT_CATEGORIES_FOLLOW_SUBCATEGORY,
			'guid_two' => $this->getGUID(),
		);
		
		$params = array_merge($default, $params);
		
		$following = check_entity_relationship($params['guid_one'], $params['relationship'], $params['guid_two']);
		
		if($following) {
			return TRUE;
		} else {
			return FALSE;
		}
	}	
	
	public function getParentCategory() {

		//Get subcategories.
		$options = array(
			'limit' => 1,
			'relationship' => KT_CATEGORIES_SUBCAT_CAT_REL,
			'relationship_guid' => $this->getGUID(),
			'inverse_relationship' => TRUE,
			'wheres' => array(),
		);
		
		$entity = FALSE;
		$result = elgg_get_entities_from_relationship($options);
		if($result) {
			$entity = current($result);
		}
		
		return $entity;
	}	
}

/**
 * Saves a subctegory with a related category.
 * 
 * @param integer $guid
 * @param array $options
 * @param integer $cat_guid
 * 
 * @return array | boolean 
 * @throws exception
 */
function kt_categories_subcategory_save($guid = 0, $options = array(), $category_guid = 0) {
	$def_owner_guid = elgg_get_logged_in_user_guid();
	
	$default = array(
		'title' => '', //Required
		
		'owner_guid' => $def_owner_guid, 
		'container_guid' => $def_owner_guid,
		'access_id' => ACCESS_PUBLIC,
	);
	$options = array_merge($default, $options);
	
	$result = FALSE;
	//Validate category guid.
	$kt_category = get_entity($category_guid);
	if(!$kt_category || !($kt_category instanceof KtCategory)) {
		//throw new Exception('Invalid Category or not Instance of Category');
		return $result;
	}

	//Validate title.
	$title = $options['title'];
	if(!$title) {
		//throw new Exception('Invalid Subcategory Title');
		return $result;
	}
	
	
	if($guid) {
		//Editing
		$kt_subcategory = get_entity($guid);

		if($kt_subcategory && $kt_subcategory instanceof KtSubCategory) {
			//We are edditing. Change title.
			$kt_subcategory->title = $title;
			$result = $kt_subcategory->save();
		} else {
			//throw new Exception('Invalid Subcategory guid');
		}
	} else {
		//Adding
		//SubCategory Object
		$kt_subcategory = new KtSubCategory();
		$kt_subcategory->owner_guid = $options['owner_guid']; 
		$kt_subcategory->container_guid = $options['container_guid']; 
		$kt_subcategory->access_id = $options['access_id'];

		$kt_subcategory->title = $title;
		$subcat_guid = $kt_subcategory->save();

		if($subcat_guid) {
			//Create a relationship between subcategory and category.
			$result_rel = $kt_category->addRelationship($subcat_guid, KT_CATEGORIES_SUBCAT_CAT_REL);
			if($result_rel) {
				$result = $subcat_guid;
			} else {
				$result = FALSE;
			}
		}
	}
	
	return $result;
}
