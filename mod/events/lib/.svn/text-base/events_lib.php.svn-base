<?php
/**
* events
*
* myclass lib description here...
* 
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

/* [To delete] 
*  This is the myclass library
*/

//require_once(dirname(dirname(__FILE__)) . '/classes/Events.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/EventsForm.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/EventsHandler.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/EventsFormFilter.php');
 
function events_main_init() {
	//elgg_extend_view("object/events", 'object/ktform');
	
	//Support for comments into the plugin.
	EventsBaseMain::ktform_set_entity_comments_support('event');
//	EventsBaseMain::ktform_set_entity_likes_support('event');
	//EventsBaseMain::ktform_set_comment_likes_support('event');
	//EventsBaseMain::ktform_set_entity_comments_support('event', TRUE, array('bulk_support' => TRUE));
	//EventsBaseMain::ktform_set_entity_category_support('event');
	//EventsBaseMain::ktform_set_entity_rating_support('event');
	//EventsBaseMain::ktform_set_bulk_action_support('event');	
	
	//Geolokation support.
	//EventsBaseMain::ktform_set_entity_geolokation_support('event');

	// Register entity type and class
    // This is needed to handle the Class
	add_subtype("object", "event", "Events");

	// Register entity type
    //If you register this, the object will appear in the search results, be carefull.
	//register_entity_type('object', 'events');
	
	//Add filter support, comment the line below to remove filter.
	EventsBaseMain::ktform_set_filter(array('plugin_name' => 'events', 'filter' => 'EventsFormFilter'));

	//Support for images into the plugin. Just one line, so easy, yessss. :)
	EventsBaseMain::ktform_set_entity_image_support('event');
	
	elgg_register_action('events/event/add', dirname(dirname(__FILE__)).'/actions/edit_a.php');
	elgg_register_action('events/event/edit', dirname(dirname(__FILE__)).'/actions/edit_a.php');
	elgg_register_action('events/event/invite', dirname(dirname(__FILE__)).'/actions/invite_a.php');
	elgg_register_action('events/event/attend', dirname(dirname(__FILE__)).'/actions/attend_a.php');
	
	elgg_register_action('events/event/cancel', dirname(dirname(__FILE__)).'/actions/cancel_a.php');
	elgg_register_action('events/event/reopen', dirname(dirname(__FILE__)).'/actions/reopen_a.php');
	
	
	elgg_register_plugin_hook_handler('entity:profile:output:fields:extend', 'object', 'event_profile_extra_fields');
	
	events_setup_listing_fields();
	

	
}
 


function events_setup_listing_fields() {
	global $CONFIG;

	$fields = array(
		//'tags' => 'tags',
		
//		'mypulldown' => array(
//			'type' => 'pulldown', //Static output. => This will use default: output/pulldown
//			//'output_view' => 'myview/mycustompulldown', //This will use this view.
//			'options' => array(
//				'options_values' => array(),
//			),
//		),
//		'location' => array(
//			'output_view' => 'events/listing/location_listing', //This will use this view.
//		),
//		'event_date' => array(
//			'output_view' => 'events/listing/event_date_listing', //This will use this view.
//		),
	);

	//Add extra fields.
	EventsBaseMain::ktform_set_extra_listing_fields('event', $fields);
	
	/**
	 * Full fields
	 */
	//EventsBaseMain::ktform_set_extra_listing_full_fields('events', $fields);
}

function event_profile_extra_fields($hook, $object_type, $returnvalue, $params) {
	$check_hook = $hook == 'entity:profile:output:fields:extend';
	$check_object_type = $object_type == 'object';

	if ($check_hook && $check_object_type) {
		$entity = $params['entity'];
		if (elgg_is_logged_in()) {
			if ($entity instanceof Events) {
				
				
				$user_star_time = events_get_user_time_start($entity, EVENT_DATE_FORMAT);
				$user_end_time = events_get_user_time_end($entity, EVENT_DATE_FORMAT);
				
				$returnvalue["star_event_date_time_user"] = array(
						"label" => elgg_echo('events:start_event_date_time_user:label'),
//						"value" => date("Y-m-d, G:i", $user_star_time),
                        "value" => $user_star_time,
					);
				$returnvalue["end_event_date_time_user"] = array(
						"label" => elgg_echo('events:end_event_date_time_user:label'),
//						"value" => date("Y-m-d, G:i", $user_end_time),
                        "value" => $user_end_time,
					);
				if (elgg_is_active_plugin('categories')) {
                                    if($entity->universal_categories) {
                                        $returnvalue['categories'] = array(
                                                      "label" => elgg_echo('categories'),
                                                      "value" => elgg_view('output/universal_categories', array('entity'=>$entity)),
                                             );
                                    }
                                }
                if ($entity->file_filestore) {
                    $returnvalue["file"] = array(
						"label" => elgg_echo('events:events:label:file'),
						"value" => elgg_view('events/output/kt_file', array('entity' => $entity, 'internalname' => 'file'))
					);
                }
    			return $returnvalue;
			}
		}
	}
}

elgg_register_event_handler('init','system','events_main_init');