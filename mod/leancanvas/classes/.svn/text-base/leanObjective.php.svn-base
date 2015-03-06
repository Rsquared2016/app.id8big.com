<?php

/**
 * Add lean board objective task
 * 
 */

class leanObjective extends ElggObject {

	/**
	 * Set subtype to leanObjective.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "lean_objective";
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getColor() {
		$color = $this->color;
		return $color;
	}
	
	public function getDeleteURL() {
		$delete_url = elgg_normalize_url('action/leancanvas/delete_objective');
		$delete_url = elgg_http_add_url_query_elements($delete_url, array('guid' => $this->getGUID()));
		
		return elgg_add_action_tokens_to_url($delete_url);
	}
	
	public function getSection() {
		
		return $this->section;
		
	}

}
