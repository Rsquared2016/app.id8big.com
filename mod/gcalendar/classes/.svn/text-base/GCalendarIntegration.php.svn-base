<?php

/*
 * GCalendar
 * 
 * API Console https://code.google.com/apis/console/
 * API https://developers.google.com/google-apps/calendar/v3/reference/
 * Example http://code.google.com/p/google-api-php-client/wiki/Samples#Calendar_API
 */

// Require
//$vendors = elgg_get_plugins_path() . 'gcalendar/vendors/';
//require_once($vendors . 'google/Google_Client.php');
//require_once($vendors . 'google/contrib/Google_Oauth2Service.php');
//require_once($vendors . 'google/contrib/Google_CalendarService.php');

class GCalendarIntegration {
	
	/**
	 * Attributtes
	 */
	private $client,
			$drive,
			$calendar;
	
	/**
	 * Construct
	 */
	public function __construct() {
		
		// Get site
		$site = elgg_get_site_entity();
		
		// Create Google Client
		$this->client = new Google_Client();
		
		// Set config
		$this->client->setUseObjects(true);
		$this->client->setAuthClass('Google_OAuth2');
		$this->client->setApplicationName($site->name);
		
		// Set client id and client secret
		if (elgg_is_active_plugin('gdrive')) {
			$client_id = elgg_get_plugin_setting('client_id', 'gdrive');
			$client_secret = elgg_get_plugin_setting('client_secret', 'gdrive');
		}
		else {
			$client_id = elgg_get_plugin_setting('client_id', 'gcalendar');
			$client_secret = elgg_get_plugin_setting('client_secret', 'gcalendar');
		}
		$this->client->setClientId($client_id);
		$this->client->setClientSecret($client_secret);
		
		if (elgg_is_active_plugin('gdrive')) {
			$redirect_uri = elgg_get_site_url() . 'gdrive/authenticate';
		}
		else {
			$redirect_uri = elgg_get_site_url() . 'gcalendar/authenticate';
		}
		$this->client->setRedirectUri($redirect_uri);
		$this->client->setState(substr($_SERVER["REQUEST_URI"], 1));
		
		// Create Google Calendar Service
		$this->drive = new Google_DriveService($this->client);
		$this->calendar = new Google_CalendarService($this->client);
		
	}
	
	/**
	 * Authenticate
	 */
	public function authenticate() {
		
		if (isset($_GET['code'])) {
			$this->client->authenticate();
			$_SESSION['token'] = $this->client->getAccessToken();
		}
		
		if (isset($_SESSION['token'])) {
			$this->client->setAccessToken($_SESSION['token']);
		}
		
	}
	
	/**
	 * Create Aut Url
	 */
	public function createAuthUrl() {
		
		return $this->client->createAuthUrl();
		
	}
	
	/**
	 * Is Authenticated
	 */
	public function isAuthenticated() {
		
		if ($this->client->getAccessToken()) {
			return true;
		}
		
		return false;
		
	}
	
	/**
	 * Insert event
	 */
	public function insertEvent($params = array()) {
		
		$default_params = array(
			'anyoneCanAddSelf' => false,
			'attendees' => array(), // Array of emails
			'description' => '',
			'end' => time(), // timestamp
			'guestsCanInviteOthers' => true,
			'guestsCanSeeOtherGuests' => true,
			'location' => '',
			'maxAttendees' => 0,
			'sendNotifications' => true,
			'start' => time(), // timestamp
			'summary' => '',
			'timezone' => date_default_timezone_get(),
		);
		
		// Validate params
		$error = true;
		if (!empty($params) && is_array($params)) {
			$params = array_merge($default_params, $params);
			
			if (!empty($params['summary']) &&
				!empty($params['start']) &&
				!empty($params['end']) &&
				!empty($params['timezone'])) {
				$error = false;
			}
		}
		
		if (!$error) {
			try {
			// Create Event
			$event = new Google_Event();
			
			// Set summary
			$event->setSummary($params['summary']);
			
			// Set description
			$event->setDescription($params['description']);
			
			// Set start time
			$start = new Google_EventDateTime();
			$start->setTimeZone($params['timezone']);
			$start_datetime = $this->convertTimestampToFormatRFC3339($params['start']);
			$start->setDateTime($start_datetime);
			$event->setStart($start);
			
			// Set end time
			$end = new Google_EventDateTime();
			$end->setTimeZone($params['timezone']);
			$end_datetime = $this->convertTimestampToFormatRFC3339($params['end']);
			$end->setDateTime($end_datetime);
			$event->setEnd($end);
			
			// Add attendees
			if (is_array($params['attendees'])) {
				$attendees = array();
				foreach($params['attendees'] as $email) {
					if (is_email_address($email)) {
						$a = new Google_EventAttendee();
						$a->setEmail($email);
						$attendees[] = $a;
					}
				}
				if (!empty($attendees)) {
					$event->attendees = $attendees;
				}
			}
			
			// Set options
			$options_params = array(
				'sendNotifications' => $params['sendNotifications'],
			);
			$insert_event = $this->calendar->events->insert('primary', $event, $options_params);
			
			return $insert_event;
			}
			catch (Exception $e) {}
			
		}
		
		return false;
		
	}
	
	/**
	 * Update event
	 */
	public function updateEvent($params = array()) {
		
		$default_params = array(
			'event_id' => '',
			'attendees' => array(), // Array of emails
			'attendees_delete' => array(),
			'sendNotifications' => true,
		);
		// Validate params
		$error = true;
		if (!empty($params) && is_array($params)) {
			$params = array_merge($default_params, $params);
			
			if (!empty($params['event_id']) &&
				(!empty($params['attendees']) || !empty($params['attendees_delete']))) {
				$error = false;
			}
		}
		
		if (!$error) {
			try {
				$event = $this->calendar->events->get('primary', $params['event_id']);
				
				if ($event instanceof Google_Event) {
					// Add attendees
					$attendees_current = $event->getAttendees();
					if (is_array($params['attendees']) && is_array($params['attendees_delete'])) {
						$attendees = array();
						
						if (!empty($attendees_current) && is_array($attendees_current)) {
							foreach($attendees_current as $ac) {
								$email_current = $ac->getEmail();

								if (in_array($email_current, $params['attendees'])) {
									$keys = array_keys($params['attendees'], $email_current);
									if (is_array($keys)) {
										$key = current($keys);
										unset($params['attendees'][$key]);
									}
								}
								if (!in_array($email_current, $params['attendees_delete'])) {
									$attendees[] = $ac;
								}
							}
						}
						
						foreach($params['attendees'] as $email) {
							if (is_email_address($email)) {
								$a = new Google_EventAttendee();
								$a->setEmail($email);
								$attendees[] = $a;
							}
						}
						if (!empty($attendees)) {
							$event->attendees = $attendees;
						}
					}
					
					$options_params = array(
						'sendNotifications' => $params['sendNotifications'],
					);
					$update_event = $this->calendar->events->update('primary', $event->getId(), $event, $options_params);

					if ($update_event instanceof Google_Event) {
						return $update_event->getUpdated();
					}
				}
			}
			catch(Exception $e) {
				//throw new Exception('Error: ' . $e->getMessage());
			}
		}
		
		return false;
		
	}
    
    /**
     * Calendar list
     */
    public function getCalendarList() {
        
        try {
            $calendar_list = $this->calendar->calendarList->listCalendarList();
            
            return $calendar_list;
        }
		catch (Exception $e) {}
        
        return FALSE;
        
    }
    
    /**
     * Get calendar
     */
    public function getCalendar($calendar_id) {
        
        try {
            $calendar = $this->calendar->calendars->get($calendar_id);
            
            return $calendar;
        }
		catch (Exception $e) {}
        
        return FALSE;
        
    }
    
    /**
     * Calendar list
     */
    public function getEvents($calendar_id, $options = array()) {
        
        try {
            if (!is_array($options)) {
                $options = array();
            }
            $events = $this->calendar->events->listEvents($calendar_id, $options);
            
            return $events;
        }
		catch (Exception $e) {}
        
        return FALSE;
        
    }
    
    /**
     * Get Events For Calendars
     */
    public function getEventsForCalendar($options = array()) {
        
        // Events
        $events = array();
        
        // Authenticate
        $this->authenticate();
        
        // Get gcalendars for user logged in
        $gcalendars = $this->getGCalendars();
        
        if (!empty($gcalendars)) {
            if (!is_array($options)) {
                $options = array();
            }
            
            // Key sortable
            $key_sortable = elgg_extract('key_sortable', $options, FALSE);
            
            // Options to Options Events
            $options_events = array();
            $start_time_date = elgg_extract('start_time_date', $options, '');
            $end_time_date = elgg_extract('end_time_date', $options, '');
            if (!empty($start_time_date)) {
                // Lower bound (inclusive) for an event's end time to filter by.
                $start_time_date = strtotime($start_time_date);
                $options_events['timeMin'] = $this->convertTimestampToFormatRFC3339($start_time_date);
            }
            if (!empty($end_time_date)) {
                // Upper bound (exclusive) for an event's start time to filter by
                $end_time_date = strtotime($end_time_date);
                $options_events['timeMax'] = $this->convertTimestampToFormatRFC3339($end_time_date);
            }
            
            foreach($gcalendars as $gc) {
                $calendar_id = $gc->calendar_id;
//                $gcalendar_timezone = $gc->timezone;
//                $default_timezone = date_default_timezone_get();
                
                $calendar_events = $this->getEvents($calendar_id, $options_events);
                
                if ($calendar_events instanceof Google_Events) {
                    $items = $calendar_events->getItems();
                    
                    if (!empty($items)) {
                        foreach ($items as $item) {
                            if ($item instanceof Google_Event) {
                                if ($key_sortable) {
                                    $start = $item->getStart();
                                    $end = $item->getEnd();
                                    
//                                    $timezone = $start->getTimeZone();
//                                    if (empty($timezone)) {
//                                        $timezone_offset = $this->getTimezoneOffset($gcalendar_timezone, $default_timezone);
//                                    }
//                                    else {
//                                        $to1 = $this->getTimezoneOffset($timezone, $gcalendar_timezone);
//                                        $to2 = $this->getTimezoneOffset($gcalendar_timezone, $default_timezone);
                                        $timezone_offset = 0;
//                                    }
                                    
                                    
                                    $start_datetime = strtotime($start->dateTime);
                                    $start_datetime += $timezone_offset;
                                    $start_datetime_aux = $this->convertTimestampToFormatRFC3339($start_datetime);
                                    $start->setDateTime($start_datetime_aux);
                                    $item->setStart($start);
                                    
                                    $end_datetime = strtotime($end->dateTime);
                                    $end_datetime += $timezone_offset;
                                    $end_datetime_aux = $this->convertTimestampToFormatRFC3339($end_datetime);
                                    $end->setDateTime($end_datetime_aux);
                                    $item->setEnd($end);
                                    
                                    $key = $start_datetime . '_' . $item->getId();
                                    $item->calendar_id = $calendar_id;
                                    $events[$key] = $item;
                                }
                                else {
                                    $start = $item->getStart();
                                    $end = $item->getEnd();
                                    
//                                    $timezone = $start->getTimeZone();
//                                    if (empty($timezone)) {
//                                        $timezone = $gcalendar_timezone;
//                                    }
//                                    $timezone_offset = $this->getTimezoneOffset($gcalendar_timezone, $default_timezone);
                                    $timezone_offset = 0;
                                    
                                    $start_datetime = strtotime($start->dateTime);
                                    $start_datetime += $timezone_offset;
                                    $start_datetime_aux = $this->convertTimestampToFormatRFC3339($start_datetime);
                                    $start->setDateTime($start_datetime_aux);
                                    $item->setStart($start);
                                    
                                    $end_datetime = strtotime($end->dateTime);
                                    $end_datetime += $timezone_offset;
                                    $end_datetime_aux = $this->convertTimestampToFormatRFC3339($end_datetime);
                                    $end->setDateTime($end_datetime_aux);
                                    $item->setStart($end);
                                    
                                    $item->calendar_id = $calendar_id;
                                    $events[] = $item;
                                }
                            }
                        }
//                        exit;
                    }
                }
            }
        }
        
        return $events;
        
    }
    
    /**
     * Get Timezone Offset
     */
    public function getTimezoneOffset($remote_timezone, $origin_timezone) {
        
        $origin_dtz = new DateTimeZone($origin_timezone);
        $remote_dtz = new DateTimeZone($remote_timezone);
        $origin_dt = new DateTime("now", $origin_dtz);
        $remote_dt = new DateTime("now", $remote_dtz);
        $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
    
        return $offset;
        
    }
	
	/**
	 * Convert timestamp to format RFC3339
	 */
	public function convertTimestampToFormatRFC3339($timestamp = 0) {
		
		if (empty($timestamp)) {
			$timestamp = time();
		}
		
		$date = date("Y-m-d\TH:i:sP", $timestamp);
		
		return $date;
		
	}
    
    /**
     * Get entity gcalendar by calendar id
     */
    public function getGCalendarByCalendarId($calendar_id) {
        
        if (empty($calendar_id)) {
            return FALSE;
        }
        
        $options = array(
            'type' => 'object',
            'subtype' => 'gcalendar',
            'owner_guid' => elgg_get_logged_in_user_guid(),
            'container_guid' => elgg_get_logged_in_user_guid(),
            'offset' => 0,
            'limit' => 1,
            'metadata_name_value_pairs' => array(
                'name' => 'calendar_id',
                'value' => $calendar_id,
            ),
        );
        $entities = elgg_get_entities_from_metadata($options);
        if ($entities) {
            return current($entities);
        }
        
        return FALSE;
        
    }
    
    public function getGCalendars($options = array()) {
        
        $defaults = array(
            'type' => 'object',
            'subtype' => 'gcalendar',
            'owner_guid' => elgg_get_logged_in_user_guid(),
            'offset' => 0,
            'limit' => NULL,
        );
        if (!is_array($options)) {
            $options = array();
        }
        $options = array_merge($defaults, $options);
        
        $entities = elgg_get_entities($options);
        
        return $entities;
        
    }
	
}