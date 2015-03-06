<?php

/*
 * This class handle the SubmitJob Object
 * If we have something to attach
 */

/**
 * 
 *
 * @author German Bortoli
 */
class SubmitJob extends ElggObject{
	protected function initialise_attributes() {
        parent::initialise_attributes();
        $this->attributes['subtype'] = SUBMIT_JOB_SUBTYPE;
		 
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

		$form = new SubmitJobForm();
		return $form->getObjectValues($exclude, $this);
	}	
}


