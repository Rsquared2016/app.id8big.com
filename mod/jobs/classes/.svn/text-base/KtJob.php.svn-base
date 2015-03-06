<?php

/**
 * @ktodo: add another object types on skeleton
 */
class KtJob extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "job";
    }
	
    public function __construct($guid = null) {
        parent::__construct($guid);
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function canSubmitJob() {
       $user = elgg_get_logged_in_user_entity();
       
       if (empty($user)) {
           return FALSE;
       }
       
       if ($user->getGUID() == $this->getOwnerGUID()) {
           return FALSE;
       }
       
       if ($this->isSubmitted($user)) {
           return FALSE;
       }

       return TRUE;
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

        $form = new KtJobForm();
        //Hide email from profile.
        if ($exclude['exclude']) {
            $exclude['exclude'][] = 'email';
        } else {
            $exclude[] = 'email';
        }

        $categories = $this->job_category;
        if (empty($categories)) {
            $exclude[] = 'job_category';
        }

        $form_values = $form->getObjectValues($exclude, $this);
	
        if ($form_values['company'] && $form_values['company_url']) {
            $form_values['company']['value'] = elgg_view('output/url', array(
                'text' => $form_values['company']['value'],
                'href' => $this->company_url,
                'target' => '_blank',
                    ));

            unset($form_values['company_url']);
        }

        return $form_values;
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
                $actions = KtJobBaseMain::ktform_get_entity_actions_link_default($this);
                break;

            case 'listing':ktform_get_user_entity($user);
            default:
                $actions = KtJobBaseMain::ktform_get_entity_actions_link_default($this);
                break;
        }
        //Can edit.
        if ($this->canEdit()) {
            $actions['edit'] = "<a href='{$CONFIG->url}jobs/edit/{$this->getGUID()}'>" . elgg_echo('edit') . '</a>';
        }


        return $actions;
    }

    public function getListingLink() {
        global $CONFIG;
        return $CONFIG->url . 'jobs/';
    }

	public static function getJobTypes($value = NULL) {
		$return = '';
		$options = array(
				elgg_echo('jobs:job_type:full_time') => 'full_time',
				elgg_echo('jobs:job_type:part_time') => 'part_time',
				elgg_echo('jobs:job_type:freelance') => 'freelance',
		  );
		$return = $options;
		
		if(!is_null($value)) {
			if($key = array_search($value, $options)) {
				$return = $key;
			} else {
				$return = '';
			}
		}
		
		return $return;
	}
	
	public static function getJobLength($value = NULL) {
		$return = '';
		$options = array(
				elgg_echo('jobs:job_length:0_3') => '0_3',
				elgg_echo('jobs:job_length:3_6') => '3_6',
				elgg_echo('jobs:job_length:6_more') => '6_more',
		  );
		$return = $options;
		
		if(!is_null($value)) {
			if($key = array_search($value, $options)) {
				$return = $key;
			} else {
				$return = '';
			}
		}
		
		return $return;
	}


	
    /**
     * Method to submit the job
     * 
     * @param int|ElggEntity $user
     * @return bool
     * 
     * @throws Exception 
     */
    public function submitJob($user = FALSE) {
        $user = KtJobBaseMain::ktform_get_user_entity($user);

        if ($user == FALSE) {
            throw new Exception(elgg_echo('job:error:user:not_valid'));
        }

        $relationship_name = FALSE;
        if (defined('SUBMIT_JOB_RELATIONSHIP')) {
            $relationship_name = SUBMIT_JOB_RELATIONSHIP;
        }

        if ($relationship_name == FALSE) {
            throw new Exception(elgg_echo('job:error:relationship:not_setted'));
        }

        $relationship_success = $this->addRelationship($user->getGUID(), $relationship_name);
        return $relationship_success;
    }

    public function isSubmitted($user = FALSE) {
        $user = KtJobBaseMain::ktform_get_user_entity($user);
        if ($user == FALSE) {
            return FALSE;
        }

        $check_relationship = check_entity_relationship($this->getGUID(), SUBMIT_JOB_RELATIONSHIP, $user->getGUID());

        return $check_relationship;
    }

    public function getGuests($get_owner = TRUE, $get_entities = FALSE) {
        $guest_limit = (int) get_input('guest_limit', 999999);
        $guest_entities = $this->getEntitiesFromRelationship(SUBMIT_JOB_RELATIONSHIP, FALSE, $guest_limit);
        $guest_guids = array();

        foreach ($guest_entities as $guest) {
            if ($get_entities == TRUE) {
                $guest_guids[$guest->getGUID()] = $guest;
            } else {
                $guest_guids[$guest->getGUID()] = $guest->getGUID();
            }
        }

        $owner_guid = $this->getOwner();
        if ($get_owner == FALSE) {
            if (array_key_exists($owner_guid, $guest_guids) && $owner_guid != 0) {
                unset($guest_guids[$owner_guid]);
            }
        }

        return $guest_guids;
    }

}
