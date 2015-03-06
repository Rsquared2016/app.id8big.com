<?php

/*
 * Format - JSON
 * 
	{
	id: 999,
	title: 'All Day Event',
	start: new Date(y, m, 1)
	end: new Date(y, m, d-2)
	allDay: false,
	backgroundColor: #000000,
	borderColor: #000000,
	className: 'class_color'
	url: 'http://google.com/' 
	}
 */

// Load Elgg engine
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

global $CONFIG;

//Get inputs
//Calendar Inputs
$start = (int) get_input('start', mktime(0, 0, 0, date('m'), 1, date('Y'))); //First day of current month.
$end = (int) get_input('end', mktime(23, 59, 59, date('m')+1, 0, date('Y'))); //Last day of current month.

//We could detect the agenda type based into the interval times. Detect the range: month, week, day.
//Get day difference.
$days_diff = event_calendar_get_time_diff($end, $start, array('day', 'hour'), FALSE);
$agenda_mode = 'month'; //Default.

if(is_array($days_diff) && count($days_diff)) {
	if($days_diff['day'] <= 1 || isset($days_diff['hour'])) {
		$agenda_mode = 'day';
	} else if($days_diff['day'] <= 7) {
		$agenda_mode = 'week';
	}
}

//Other inputs.
$container_guid = get_input('container_guid', ELGG_ENTITIES_ANY_VALUE);

$attend_options = get_input('attend_options', '');

//If we send this params, will only show the events of the user that will attend.
$attend_user_guid = get_input('attend_user_guid', ''); 

//This is for test only, we should add a class name, so later with css the could 
//add custom colors to attend options.
//Comment this line later.
$attend_code_colors = event_get_attend_options_color();
$subtype_background_color = array(
    'event' => '#3366CC',
    'meeting' => '#CC2113',
    'gtask' => '#F2DA32',
    'gcalendar' => '#486b40',
);
$subtype_label_color = array(
    'event' => '#FFFFFF',
    'meeting' => '#FFFFFF',
    'gtask' => '#000000',
    'gcalendar' => '#FFFFFF',
);
$attend_code_colors_label = event_get_attend_options_color_label();

//KTODO: Validar que ocurre si hay muchos eventos en un mismo dia. Testear con varios elementos.

//This array will check for event day, to add a link to search for more events into the day.
$events_days = array();

//Loggedin ?
$events = array();
if(elgg_is_logged_in()) {
	
	$start_event = get_day_start(date('d', $start), date('m', $start), date('Y', $start));
	$start_event = date('Y-m-d H:i:s', $start_event);
	$end_event = get_day_end(date('d', $end), date('m', $end), date('Y', $end));
	$end_event = date('Y-m-d H:i:s', $end_event);
	
	$options = array(
		'start_time_date' => $start_event,
		'end_time_date' => $end_event,
		'container_guid' => $container_guid,
		'attend_options' => $attend_options,
		'attend_user_guid' => $attend_user_guid, //This should work with left joins.

		'limit' => 50, //KTODO: Limit ?
		'offset' => 0,
		'callback'	=>	'',
	);

	if($attend_user_guid) {
		$options['selects'] = array(
			'msn_attend.string as attend_text',
			'msv_attend.string as attend_value',
		);
	}
                        
//	$entities = event_search_events($options);
	$entities = sparkfire_get_agenda($options);
    
	if($entities) {
		foreach($entities as $row) {
            // $is google event?
            $is_google_event = ($row instanceof Google_Event);
            
            if ($is_google_event) {
                $entity = $row;
            }
            else {
                $entity = entity_row_to_elggstar($row);
            }

			if($entity) {
                if ($is_google_event) {
                    $subtype = 'gcalendar';
                    $id = $entity->getId();
                    
                    $entity_title = elgg_get_excerpt($entity->getSummary(), EVENTS_CALENDAR_TITILE_MAX_CHARS);
                    $title_full = $entity->getSummary();
                    
                    $entity_desc = elgg_get_excerpt($entity->getDescription(), EVENTS_CALENDAR_DESC_MAX_CHARS);
                    
//                    $start = $entity->getStart();
//                    $start_datetime = strtotime($start->dateTime);
//                    
//                    $end = $entity->getEnd();
//                    $end_datetime = strtotime($end->dateTime);
//                    
//                    $entity_when = date("Y-m-d, G:i", $start_datetime) . ' - ' . date("Y-m-d, G:i", $end_datetime);
                    
                    if (is_callable('gcalendar_get_user_time_start') && is_callable('gcalendar_get_user_time_end')) {
                        $start_datetime = gcalendar_get_user_time_start($entity);
                        
                        $entity_when = gcalendar_get_user_time_start($entity, EVENT_DATE_FORMAT) . ' - ' . gcalendar_get_user_time_end($entity, EVENT_DATE_FORMAT);
                    }
                    
                    $all_day = FALSE;
                    
                    $entity_url = $entity->getHtmlLink();
                    
                    $gcalendar_id = '';
                    if (is_callable('gcalendar_get_friendly_gcalendar_id')) {
                        $gcalendar_id = gcalendar_get_friendly_gcalendar_id($entity->calendar_id);
                    }
                }
                else {
                    // Entity Elgg
                    $entity_title = elgg_get_excerpt($entity->title, EVENTS_CALENDAR_TITILE_MAX_CHARS);
                    $entity_desc = elgg_get_excerpt($entity->description, EVENTS_CALENDAR_DESC_MAX_CHARS);
//                  $entity_when = $entity->getFriendlyTime();
                    $subtype = $entity->getSubtype();
                    switch ($subtype) {
                        case 'event':
//                            $entity_when = date("Y-m-d, G:i", events_get_user_time_start($entity)) . ' - ' . date("Y-m-d, G:i", events_get_user_time_end($entity));
                            $entity_when = events_get_user_time_start($entity, EVENT_DATE_FORMAT) . ' - ' . events_get_user_time_end($entity, EVENT_DATE_FORMAT);
                            $start_datetime = events_get_user_time_start($entity);
                            $end_datetime = events_get_user_time_end($entity);
                            break;
                        case 'meeting':
//                            $entity_when = date("Y-m-d, G:i", meeting_get_user_time_start($entity)) . ' - ' . date("Y-m-d, G:i", meeting_get_user_time_end($entity));
                            $entity_when = meeting_get_user_time_start($entity, EVENT_DATE_FORMAT) . ' - ' . meeting_get_user_time_end($entity, EVENT_DATE_FORMAT);
                            $start_datetime = meeting_get_user_time_start($entity);
                            $end_datetime = meeting_get_user_time_end($entity);
                            break;
                        case 'gtask':
//                            $end_date = get_day_end(date('d', strtotime($entity->calendar_end)), date('m', strtotime($entity->calendar_end)), date('Y', strtotime($entity->calendar_end)));
//                            $start_date = $end_date;
//                            $start_datetime = $start_date;
//                            $end_datetime = $end_date;
//                            $entity_when = 'End Date: ' . date("Y-m-d", $end_date);
                                
                            if (is_callable('gtask_get_user_time_end')) {
                                $end_date = gtask_get_user_time_end($entity);
                                $start_date = $end_date;
                                $start_datetime = $start_date;
                                $end_datetime = $end_date;
                                $entity_when = 'End Date: ' . gtask_get_user_time_end($entity, "Y-m-d");
                            }
                            break;
                        default:
                            break;
                    }
//                  $entity_where = $entity->getFriendlyWhere();
                    $entity_where = $entity->location;
                    
                    //Times
                    $start_time_date = $entity->start_time_date;
                    $end_time_date = $entity->end_time_date;
                    
                    if($agenda_mode == 'month') {
                        //View more event days.
                        $events_days = event_calendar_add_event_day($start_time_date, $end_time_date, $events_days);

                        //Check if we could show the event, because we have evet limits display.
                        $day_start = date('Ymd', $start_time_date);
                        if(isset($events_days[$day_start]) && $events_days[$day_start] > EVENTS_CALENDAR_MONTH_VIEW_MAX_EVENTS_PER_DAY) {
                            //If we have more of certain elements continue.
                            continue;
                        }
                        //View more event days end.
                    }
                    
                    $all_day = FALSE;
//    				if(!$all_day) {
//    					$start_time_date_day = event_split_time($start_time_date);
//    					$end_time_date_day = event_split_time($end_time_date);
//    					
//    					//If an event takes more than a day, we could say it takes all day.
//    					//This is clearly used into agenda mode in week and day mode.
//    					if($start_time_date_day['time_date'] != $end_time_date_day['time_date']) {
//    						$all_day = TRUE;
//    					}
//    				}
                    if ($subtype == 'gtask') {
                        $all_day = true;
                    }
                    
                    $id = $entity->getGUID();
                    $title_full = $entity->title;
                    $entity_url = $entity->getURL();
                    $gcalendar_id = '';
                }
				$event = array(
					'id' => $id,
					'title' => $entity_title,
//					'start' => $start_time_date,
					'start' => $start_datetime,
//					'end' => $end_time_date,
					'end' => $end_datetime,
					'allDay' => $all_day,
					//'url' => $entity->getURL(), //Disabled and replaced for qtip
					//Extras.
					'title_full' => $title_full,
					'description' => '<h4>' . elgg_echo('events:description') . ':</h4><p>' . $entity_desc . '</p>',
					'when_friendly' => '<strong>'.elgg_echo('events:event_when').':</strong> ' . $entity_when ,
//					'where_friendly' => '<strong>'.elgg_echo('events:location').':</strong> ' . $entity_where,
					'view_more_link' => elgg_view('output/url', array(
						'text' => elgg_echo('events:calendar:qtip:desc:link:view:more'),
						'href' => $entity_url,
                    )),
                    'gcalendar_id' => $gcalendar_id,
				);
                
                if ($subtype == 'event') {
//                    $event['where_friendly'] = '<strong>'.elgg_echo('events:location').':</strong> ' . $entity_where;
                    $attend_value = $entity->getUserAttend($attend_user_guid);
                    $site_url = elgg_get_site_url();
                    if($attend_value) {
                        $img_url = '';
                        $title = '';
                        switch ($attend_value) {
                            case 'yes':
                                $img_url = "{$site_url}mod/events/graphics/calendar-assist.png";
                                $title = elgg_echo('events:guests:title:yes');
                                break;
                            case 'no':
                                $img_url = "{$site_url}mod/events/graphics/calendar-no-assist.png";
                                $title = elgg_echo('events:guests:title:no');
                                break;
                            case 'maybe':
                                $img_url = "{$site_url}mod/events/graphics/calendar-maybe.png";
                                $title = elgg_echo('events:guests:title:maybe');
                                break;
                        }
                        $event['imageurl'] = "<img title='{$title}' style='margin-right:3px;'src='{$img_url}'>";
                    }
                }

//				$attend_value = $row->attend_value;

				//If we didnt got attend value, should we try to know if the user 
				//will attend to this event  ?
				//This should be done with a left join clase, but because there is a elgg core
				//bug it returns two values.
//				if(!$attend_value) {
//					$attend_value = $entity->getUserAttend($attend_user_guid);
//				}

//				if($attend_value) {
//					if(array_key_exists($attend_value, $attend_code_colors)) {
//						$event['backgroundColor'] = $attend_code_colors[$attend_value];
//						$event['borderColor'] = $attend_code_colors[$attend_value];
//						$event['textColor'] = $attend_code_colors_label[$attend_value];
//					}
//					$class_name = "userAttend".ucwords($attend_value);
//					$event['className'] = $class_name;
//				}
                $event['backgroundColor'] = $subtype_background_color[$subtype];
                $event['borderColor'] = $subtype_background_color[$subtype];
                $event['textColor'] = $subtype_label_color[$subtype];
                
				$events[] = $event;
			}

		}
	}	
}

//Add the view more event days.
//This is only needed into month view ?
if($events_days && $agenda_mode == 'month') {
	foreach($events_days as $ed_key => $ed_val) {
		if($ed_val > EVENTS_CALENDAR_MONTH_VIEW_MAX_EVENTS_PER_DAY) {
			$start_time_date = strtotime("$ed_key 23:58:59");
			$end_time_date = strtotime("$ed_key 23:59:59");
			
			$search_url = "{$CONFIG->url}pg/events/search?start_time_date={$start_time_date}&end_time_date={$end_time_date}";
			
			$count_val = $ed_val - EVENTS_CALENDAR_MONTH_VIEW_MAX_EVENTS_PER_DAY;
			$event = array(
				'title' => "+{$count_val} " . elgg_echo('events:calendar:qtip:desc:link:view:more'),
				'start' => $start_time_date,
				'end' => $end_time_date,
				'url' => $search_url
			);
			
			$events[] = $event;				
		}
	}
}
echo json_encode($events);