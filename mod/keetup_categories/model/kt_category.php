<?php

/*
 * This is the KtCategory class, an extension of elggObject
 * */

class KtCategory extends ElggObject {

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "kt_category";
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
			'relationship' => KT_CATEGORIES_FOLLOW_CATEGORY,
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
	
	public function getSubCategoriesDeprecated() {
		//Get subcategories.
		$result = $this->getAnnotations('kt_subcategory');
		return $result;
	}
	
	public function getSubCategories($guid = 0) {

		//Get subcategories.
		$options = array(
			'limit' => 0,
			'relationship' => kt_categories_subcat_cat,
			'relationship_guid' => $this->getGUID(),
			'inverse_relationship' => FALSE,
			'wheres' => array(),
		);
		
		if($guid) {
			$guid = sanitise_int($guid);
			
			if($guid) {
				$options['wheres'][] = "e.guid = {$guid}";
			}
		}
		
		$result = elgg_get_entities_from_relationship($options);
		
		return $result;
	}

	public function getSubCategoryById($id) {
		return $this->getSubCategories($id);
	}
	
	public function getSubCategoryByIdDeprecated($id) {
		return get_annotation($id);
	}

	public function deleteSubcategories() {
		$result = FALSE;
		
		//Get all subcategories.
		
		//Delete all subcategories and relationships.
		
		//return $this->clearAnnotations('kt_subcategory');
	}

	public function deleteSubcategoriesDeprecated() {
		return $this->clearAnnotations('kt_subcategory');
	}

	public function getSubCategoriesNames() {

		$sub_categories_name = array();
		//Get subcategories.
		$sub_categories = $this->getSubCategories();

		//Get their names.
		if ($sub_categories) {
			foreach ($sub_categories as $sub_category) {
				$id = $sub_category->getGUID();
				$title = $sub_category->getName();
				$sub_categories_name[$id] = $title;
			}

			asort($sub_categories_name);
		}

		return $sub_categories_name;
	}

	
	public function getSubCategoriesNamesDeprecated() {

		$sub_categories_name = array();
		//Get subcategories.
		$sub_categories = $this->getSubCategories();

		//Get their names.
		if ($sub_categories) {
			foreach ($sub_categories as $sub_category) {
				$sub_categories_name[$sub_category->id] = $sub_category->value;
			}

			asort($sub_categories_name);
		}

		return $sub_categories_name;
	}

}
