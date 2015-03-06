<?php

/**
 * @ktodo: add another object types on skeleton
 */
class News extends ElggObject {

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "new";
	}

	public function __construct($guid = null) {
		parent::__construct($guid);
	}

	/**
	 * Export the object values, so we can get those in the profile, etc
	 * 
	 * This method has to be implemented allways according to the model
	 *
	 * @param array $exclude
	 * @return array
	 */
	public function getObjectValues($exclude = array()) {

		$form = new NewsForm();
		return $form->getObjectValues($exclude, $this);
	}

	/**
	 * Imporatant this must be added into the class.
	 *
	 * @param string $section The section you want to get the actions: listing, profile.
	 *
	 * return array of actions links.
	 */
	public function getEntityLinkActions($section = 'listing') {
		global $CONFIG;

		switch ($section) {
			case 'profile':
				$actions = NewsBaseMain::ktform_get_entity_actions_link_default($this);
				break;

			case 'listing':
			default:
				$actions = NewsBaseMain::ktform_get_entity_actions_link_default($this);
				break;
		}
		//Can edit.
		if ($this->canEdit()) {
			$actions['edit'] = "<a href='{$CONFIG->url}news/edit/{$this->getGUID()}'>" . elgg_echo('edit') . '</a>';
		}


		return $actions;
	}

	public function getListingLink() {
		global $CONFIG;
		return $CONFIG->url . 'news/';
	}

	public function getTagsOnListing() {
		$tags = $this->getTags();
		
		if (!empty($tags)) {
			$tags = elgg_view('news/output/tags', array('value' => $tags));
			return $tags;
		}
		
		
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Overrides the listing subtitle section
	 */
//Uncomment this line to override the "By Administrator time ago"	
//	public function getSubtitleOnListing() {
//		
//	}

}
