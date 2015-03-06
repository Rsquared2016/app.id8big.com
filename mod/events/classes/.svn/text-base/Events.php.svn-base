<?php

/**
 * @ktodo: add another object types on skeleton
 */

class Events extends ElggObject {

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "event";
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

		$form = new EventsForm();
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
				$actions = EventsBaseMain::ktform_get_entity_actions_link_default($this);
				break;

			case 'listing':
			default:
				$actions = EventsBaseMain::ktform_get_entity_actions_link_default($this);
				break;
		}
		//Can edit.
		if ($this->canEdit()) {
			$actions['edit'] = "<a href='{$CONFIG->url}events/edit/{$this->getGUID()}'>" . elgg_echo('edit') . '</a>';
			if ($this->state == EVENT_STATE_OPENED) {
				$url_cancel = elgg_add_action_tokens_to_url("{$CONFIG->url}action/events/event/cancel/?guid={$this->getGUID()}");
				$actions['cancel'] = "<a href='{$url_cancel}'>" . elgg_echo('events:list:cancel') . '</a>';
			} else {
				$url_reopen = elgg_add_action_tokens_to_url("{$CONFIG->url}action/events/event/reopen/?guid={$this->getGUID()}");
				$actions['reopen'] = "<a href='{$url_reopen}'>" . elgg_echo('events:list:reopen') . '</a>';
			}
		}

		return $actions;
	}

	public function getListingLink() {
        
		global $CONFIG;
        
		return $CONFIG->url . 'events/';
	}

	public function getTagsOnListing() {
		$tags = $this->getTags();
		
		if (!empty($tags)) {
			$tags = elgg_view('events/output/tags', array('value' => $tags));
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

    /**
	 * Events: Save
	 * 
	 * @return type 
	 */
	public function save() {
		
		// Check start date and end date
		$star_date = get_input('start_date');
        $start_time = elgg_timezone_sec_to_time(get_input('start_time'));
        
        $end_date = get_input('end_date');
        $end_time = elgg_timezone_sec_to_time(get_input('end_time'));

		$event_timezone = get_input('timezone');

		$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');

		$offset_time = elgg_timezone_get_timezone_offset($event_timezone, $server_timezone);

		$current_timezone = date_default_timezone_get;
		date_default_timezone_set($server_timezone);

		$star_date_time = strtotime($star_date . ' ' . $start_time);

		$end_date_time = strtotime($end_date . ' ' . $end_time);

		date_default_timezone_set($current_timezone);
                
                

		if ($star_date_time >= $end_date_time) {
            register_error(elgg_echo('events:end_time_smaller'));
            forward(REFERER);
		}
		$success = parent::save();

		if ($success) {
            
			$star_server = $star_date_time + $offset_time;

			$end_server = $end_date_time + $offset_time;
                        

			$this->star_event_date_time = $star_server;

			$this->end_event_date_time = $end_server;

            $this->timezone_group = get_input('timezone_group');
                       
			if (!isset($this->state)) {
				$this->state = EVENT_STATE_OPENED;
			}
			
			/**
			 * Set access custom if applicable
			 */
//			$this->setAccessCustom();
		}

		return $success;
		
	}
	
	/**
	 * Events Access: Set Access Custom
	 */
	public function setAccessCustom() {
		
		$success = TRUE;
		
		if (defined('EVENTS_ACCESS_CUSTOM') && EVENTS_ACCESS_CUSTOM) {
			// Get access id
			$access_id = events_access_get_access_to_event($this);
			
			$this->access_id = $access_id;
			
			// ATTENTION!!! => Do not call method of the entity, if not go into infinite loop :).
			$success = parent::save();
		}
		
		return $success;
		
	}

	/**
	 * Attend
	 */
	public function attend($attend, $user_guid = 0) {

		$success = FALSE;

		if (empty($user_guid)) {
			$user_guid = elgg_get_logged_in_user_guid();
		}

		if ($attend == EVENTS_ATTEND_YES ||
				$attend == EVENTS_ATTEND_MAYBE ||
				$attend == EVENTS_ATTEND_NO) {

			$options = array(
				'guid' => $this->getGUID(),
				'annotation_owner_guid' => $user_guid,
				'annotation_name' => EVENTS_ATTEND_ANNOTATION_NAME,
			);
			$annotations = elgg_get_annotations($options);

			if ($annotations) {
				$annotation = current($annotations);

				// Update attend
				$success = update_annotation($annotation->id, EVENTS_ATTEND_ANNOTATION_NAME, $attend, 'text', $user_guid, ACCESS_PUBLIC);
			} else {
				// Create attend
				$success = create_annotation($this->getGUID(), EVENTS_ATTEND_ANNOTATION_NAME, $attend, 'text', $user_guid, ACCESS_PUBLIC);
				
				// Add to access private
				if (is_callable('events_access_add_to_access_private')) {
					$result = events_access_add_to_access_private($this, $user_guid);
				}
			}
		}

		return $success;
	}

	/**
	 * is guests?
	 */
	public function isGuest($user_guid = 0) {

		if (empty($user_guid)) {
			$user_guid = elgg_get_logged_in_user_guid();
		}

		$options = array(
			'guid' => $this->getGUID(),
			'annotation_owner_guid' => $user_guid,
			'annotation_name' => EVENTS_ATTEND_ANNOTATION_NAME,
			'count' => TRUE,
		);
		$annotations = elgg_get_annotations($options);

		return $annotations;
	}

	/**
	 * Add guest
	 */
	public function addGuest($user_guid = 0) {

		$user = get_entity($user_guid);
		$user_logged_in = elgg_get_logged_in_user_entity();

		$success = false;
		if (elgg_instanceof($user, 'user') && elgg_instanceof($user_logged_in, 'user')) {
			$from = $user_logged_in->getGUID();
			$subject = elgg_echo('events:invite:subject', array($user_logged_in->name, $this->title));
			$message = elgg_echo('events:invite:body', array($user_logged_in->name, $this->title, $this->getURL()));

			set_input('email_queue_message', TRUE);

			if (!$this->isGuest($user_guid)) {
				$success = create_annotation($this->getGUID(), EVENTS_ATTEND_ANNOTATION_NAME, EVENTS_ATTEND_NOT_REPLIED, 'text', $user_guid, ACCESS_PUBLIC);

				if ($success) {
					// Add to access private
					if (is_callable('events_access_add_to_access_private')) {
						$result = events_access_add_to_access_private($this, $user_guid);
					}
					
					$result = notify_user($user_guid, $from, $subject, $message);
				}
			} else {
				$success = true;
			}

			set_input('email_queue_message', FALSE);
		}

		return $success;
	}

	/**
	 * Get user attend
	 */
	public function getUserAttend($user_guid = 0) {

		if (empty($user_guid)) {
			$user_guid = elgg_get_logged_in_user_guid();
		}

		$options = array(
			'guid' => $this->getGUID(),
			'annotation_owner_guid' => $user_guid,
			'annotation_name' => EVENTS_ATTEND_ANNOTATION_NAME,
		);
		$annotations = elgg_get_annotations($options);

		$attend = '';

		if ($annotations) {
			$annotation = current($annotations);

			$attend = $annotation->value;
		}

		return $attend;
	}

	/**
	 * Get guests
	 * 
	 * Default: get all guests
	 */
	public function getGuests($options = array()) {

		$default = array(
			'guid' => $this->getGUID(),
			'annotation_name' => EVENTS_ATTEND_ANNOTATION_NAME,
//			'annotation_value' => '',
			'count' => FALSE,
		);

		if (!is_array($options)) {
			$options = array();
		}
		$options = array_merge($default, $options);

		$annotations = elgg_get_annotations($options);

		$users = array();

		if ($annotations) {
			foreach ($annotations as $annotation) {
				$users[] = $annotation->owner_guid;
			}
		}

		return $users;
	}

	/**
	 * is canceled?
	 */
	public function isCanceled() {

		$is_canceled = ($this->state == EVENT_STATE_CLOSED);

		return $is_canceled;
	}

	/**
	 * Notify when an evento was close
	 * 
	 * @return bool
	 */
	public function notifyEventClosed() {
		global $CONFIG;
		$options = array(
			'guid' => $this->getGUID(),
			'annotation_name' => EVENTS_ATTEND_ANNOTATION_NAME,
		);
		$annotations = elgg_get_annotations($options);
		
		if ($annotations) {
			$guid_from = $CONFIG->site;
			$subject = sprintf(elgg_echo('events:notification:event:canceled:subject'), $this->title);
			$message = sprintf(elgg_echo('events:notification:event:canceled:message'), $this->title, $this->getURL());

			set_input('email_queue_message', TRUE);
			foreach ($annotations as $annotation) {
				$guid_to = $annotation->owner_guid;

				if ($guid_to != $guid_from) {
					notify_user($guid_to, $guid_from, $subject, $message);
				}
			}
			set_input('email_queue_message', FALSE);
		}

		return true;
	}

	/**
	 * Notify when an evento was reopened
	 * 
	 * @return bool
	 */
	public function notifyEventReopened() {
		global $CONFIG;
		$options = array(
			'guid' => $this->getGUID(),
			'annotation_name' => EVENTS_ATTEND_ANNOTATION_NAME,
		);
		$annotations = elgg_get_annotations($options);

		if ($annotations) {
			$guid_from = $CONFIG->site;
			$subject = sprintf(elgg_echo('events:notification:event:reopened:subject'), $this->title);
			$message = sprintf(elgg_echo('events:notification:event:reopened:message'), $this->title, $this->getURL());

			set_input('email_queue_message', TRUE);
			foreach ($annotations as $annotation) {
				$guid_to = $annotation->owner_guid;

				if ($guid_to != $guid_from) {
					notify_user($guid_to, $guid_from, $subject, $message);
				}
			}
			set_input('email_queue_message', FALSE);
		}

		return true;
	}
    
    public function getDescription() {
        $return = "<div class=\"elgg-subtext\">";
        $return .= elgg_view('events/listing/event_date_listing', array('entity' => $this));
        $return .= "</div>";
        $return .= elgg_view('events/listing/location_listing', array('entity' => $this));
        return $return;
    }
}
