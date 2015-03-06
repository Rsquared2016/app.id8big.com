<?php

/**
 * @ktodo: add another object types on skeleton
 */
class Meeting extends ElggObject {

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "meeting";
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

		$form = new MeetingForm();
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
				$actions = MeetingBaseMain::ktform_get_entity_actions_link_default($this);
				break;

			case 'listing':
			default:
				$actions = MeetingBaseMain::ktform_get_entity_actions_link_default($this);
				break;
		}
		//Can edit.
		if ($this->canEdit()) {
			$actions['edit'] = "<a href='{$CONFIG->url}meeting/edit/{$this->getGUID()}'>" . elgg_echo('edit') . '</a>';
		}


		return $actions;
	}

	public function getListingLink() {
		global $CONFIG;
		return $CONFIG->url . 'meeting/';
	}

	public function getTagsOnListing() {
		$tags = $this->getTags();
		
		if (!empty($tags)) {
			$tags = elgg_view('meeting/output/tags', array('value' => $tags));
			return $tags;
		}
		
		
	}
	
	public function getTitle() {
		return $this->title;
	}
    
    /**
     * Add participant
     */
    public function addParticipant(ElggUser $user) {
        
        $success = false;
        
        if (empty($user)) {
            $user = elgg_get_logged_in_user_entity();
        }
        if (!elgg_instanceof($user, 'user')) {
            return $success;
        }
        
        $options = array(
            'guid' => $this->getGUID(),
            'annotation_names' => MEETING_PARTICIPANT_ANNOTATION,
            'annotation_owner_guids' => $user->getGUID(),
            'limit' => 1,
        );
        $annotations = elgg_get_annotations($options);
        
        if (empty($annotations)) {
            $success = $this->annotate(
                MEETING_PARTICIPANT_ANNOTATION,
                time(),
                ACCESS_LOGGED_IN,
                $user->getGUID()
            );
        }
        else {
            $success = true;
        }
        
        return $success;
        
    }
    
    /**
     * Can Join
     * 
     * Can join the meeting considering the date?
     */
    public function canJoin(ElggUser $user) {
        
        $can_join = false;
        
        if (empty($user)) {
            $user = elgg_get_logged_in_user_entity();
        }
        if (!elgg_instanceof($user, 'user')) {
            return $can_join;
        }
        
        // Get status
        $status = $this->getStatus();
        if ($status == 'in_progress') {
            $can_join = true;
        }
        
        return $can_join;
        
    }
    
    public function getStatus() {
        
        // Status
        $status = 'not_started';
        
        // Get site timezone
        if (is_callable('elgg_timezone_get_timezone_site')) {
            // Function added into this module
            $site_timezone = elgg_timezone_get_timezone_site();
        }
        else {
            $site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
        }
        
        // Get current timezone
        $current_timezone = date_default_timezone_get();
        
        // Set site timezone
        date_default_timezone_set($site_timezone);
        
        // Get site start datetime
        $site_start_datetime = $this->site_start_datetime;
        
        // Get site end datetie
        $site_end_datetime = $this->site_end_datetime;
        
        // Get now
        $now = time();
        
        if ($now < $site_start_datetime) {
            $status = 'not_started';
        }
        else {
            if ($now <= $site_end_datetime) {
                $status = 'in_progress';
            }
            else {
                $status = 'finished';
            }
        }
        
        // Set current timezone
        date_default_timezone_set($current_timezone);
        
        return $status;
        
    }
    
    /**
     * Are complete the number of participants?
     */
    public function areCompleteNumberParticipants(ElggUser $user) {
        
        $are_complete = true;
        
        if (empty($user)) {
            $user = elgg_get_logged_in_user_entity();
        }
        if (!elgg_instanceof($user, 'user')) {
            return $are_complete;
        }
        
        // Get participants
        $participants = $this->participants;
        
        if (!empty($participants)) {
            $user_guid = $user->getGUID();
            $options = array(
                'guid' => $this->getGUID(),
                'annotation_names' => MEETING_PARTICIPANT_ANNOTATION,
                'limit' => NULL,
                'count' => TRUE,
                'wheres' => array(
                    "(n_table.owner_guid != {$user_guid})",
                ),
            );
            $count = elgg_get_annotations($options);
            
            if ((int)$count >= (int)$participants) {
                $are_complete = true;
            }
            else {
                $are_complete = false;
            }
        }
        else {
            $are_complete = false;
        }
        
        return $are_complete;
        
    }
    
    /**
     * Get start datetime for user
     */
    public function getStartDatetimeForUser() {
        
        // Get user logged in        
        $user_logged_in = elgg_get_logged_in_user_entity();
        
        // Get user timezone
        $user_timezone = elgg_timezone_get_timezone_user($user_logged_in);
        
        // Get site timezone
        if (is_callable('elgg_timezone_get_timezone_site')) {
            // Function added into this module
            $site_timezone = elgg_timezone_get_timezone_site();
        }
        else {
            $site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
        }
        if (empty($user_timezone)) {
            $user_timezone = $site_timezone;
        }
        
        // Get offset timezone
        $offset_timezone = elgg_timezone_get_timezone_offset($this->timezone, $user_timezone);
        
        // Get current timezone
        $current_timezone = date_default_timezone_get();
        
        // Set meeting timezone
        date_default_timezone_set($user_timezone);
        
        // Get user start datetime
        $user_start_datetime = strtotime($this->start_date . ' ' . $this->start_time);
        $user_start_datetime = $user_start_datetime + $offset_timezone;
        
        // Set current timezone
        date_default_timezone_set($current_timezone);
        
        return $user_start_datetime;
        
    }
    
    public function getStartDatetimeFriendly($timestamp = 0, $show_date = true, $show_time = true) {
        
        if (empty($timestamp)) {
            $timestamp = $this->start_datetime;
        }
        
        if (!empty($timestamp)) {
            $user_timezone = elgg_timezone_get_timezone_user(elgg_get_logged_in_user_entity());
            $default_timezone = date_default_timezone_get();
            date_default_timezone_set($user_timezone);
            
            $start_datetime = '';
            if ($show_date) {
                $start_datetime .= elgg_echo('meeting:' . strtolower(date('F', $timestamp)));
                $start_datetime .= ' ' . date('j, Y', $timestamp);
            }
            if ($show_time) {
                if ($show_date) {
                    $start_datetime .= ' - ';
                }
                $start_datetime .= date(MEETING_TIME_FORMAT, $timestamp);
//                $start_datetime .= elgg_echo('meeting:hours'); 
            }
            
            date_default_timezone_set($default_timezone);
            
            return $start_datetime;
        }
        
        return '';
        
    }
	
	/**
	 * Overrides the listing subtitle section
	 */
//Uncomment this line to override the "By Administrator time ago"	
//	public function getSubtitleOnListing() {
//		
//	}

}
