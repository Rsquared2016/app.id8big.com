<?php

/**
 * meeting_ktform
 *
 * @author Diego Gallardo and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

require_once(dirname(__FILE__) . '/vendors/plugin/plugin.php');

//KTODO: ADD BULK ACTIONS PROGRAMMING
define('Meeting_st_DISABLE_BULK_ACTIONS', FALSE);
define('Meeting_st_LISTING_FULL_EXCERPT_LONGTEXT', 250);
define('Meeting_st_MAX_LENGHT_TEXT', 150);
define('Meeting_st_MAX_LENGHT_TITLE', 90);
define('Meeting_st_MAX_LENGHT_TITLE_LISTING', 70);
define('Meeting_st_AJAX_REL_ATTR', 'isAjaxForm');

$load_classes = array(
	'MeetingBaseMain', //Main functions
	 
	'MeetingBaseExceptions',
	'MeetingBaseValidators',
	'MeetingBaseSave',
//	'MeetingBaseGroupSave',
	'MeetingBaseForm',
	'MeetingBaseHandler',
	'MeetingBaseFilter',
);

foreach ($load_classes as $to_include) {
	$filename = dirname(__FILE__) . "/classes/{$to_include}.php";

	if (file_exists($filename)) {
		require_once( $filename );
	}
}

$load_libs = array(
	'utils',
	'main',
	'kt_form_images',
	'kt_form_video',
	'kt_form_file',
//	'kt_groups_lib',
	'kt_ajax_lib',
);

foreach ($load_libs as $to_include) {
	$filename = dirname(__FILE__) . "/lib/{$to_include}.php";

	if (file_exists($filename)) {
		require_once( $filename );
	}
}

function meeting_ktform_init() {
	//Initializate the plugin
	meeting_ktform_initializateplugin();

	//Page Handler
	elgg_register_page_handler('meeting_ktform', 'meeting_ktform_page_handler');
	
	// Register an annotation handler for comments etc
	elgg_register_plugin_hook_handler('entity:annotate', 'object', 'meeting_ktform_annotate_comments');
	elgg_register_plugin_hook_handler('entity:annotate', 'group', 'meeting_ktform_annotate_comments');
	
	elgg_register_plugin_hook_handler('comments', 'object', 'meeting_ktform_generic_comment');
	elgg_register_plugin_hook_handler('comments', 'group', 'meeting_ktform_generic_comment');

	elgg_extend_view('css/elgg', 'meeting/css/main');
	elgg_extend_view('css/elgg', 'meeting/css/custom');
	elgg_extend_view('css/elgg', 'meeting/css/elements/helpers');
	//elgg_extend_view('css', 'meeting_ktform_group/css');
	
	elgg_extend_view('js/elgg', 'meeting/js/main', 400);
	elgg_extend_view('js/elgg', 'meeting/js/custom');
	
	elgg_register_action('meeting/delete', dirname(__FILE__).'/actions/delete_a.php');
	
	//Some bulk actions.
	elgg_register_action('meeting/meeting/bulk/delete', dirname(__FILE__).'/actions/bulk/delete_a.php');	
	elgg_register_action('meeting/meeting/bulk/comments_enabled', dirname(__FILE__).'/actions/bulk/comments_enabled_a.php');

	//Bulk Actions hook.
	elgg_register_plugin_hook_handler('meeting_ktform:entity:bulk:links:actions', 'entity', 'meeting_ktform_comments_entity_links_bulk_actions');
	
	
	//KTODO: Check bulk actions to add before pagintion.
	//elgg_extend_view('navigation/pagination', 'meeting_ktform/bulk_actions/form', 400);
	
	//Add object page owner handler.
//	add_page_owner_handler('MeetingBaseMain::ktform_object_owner_handler'); //@KTODO: CHECK IF THIS WORK, SERIOUSLY
	
	elgg_register_event_handler("create",'object',"meeting_ktform_save_date_range");
	elgg_register_event_handler("update",'object',"meeting_ktform_save_date_range");
	
	//Geolokation support.
	elgg_register_plugin_hook_handler("geolokation:allowed_contexts", "all", "meeting_ktform_geolokation_allowed_contexts");	
	
	//Unit tests
	//elgg_register_plugin_hook_handler('unit_test', 'system', 'meeting_ktform_unit_test');
	register_translations(dirname(__FILE__).'/languages/', TRUE);
}

/*
 * Ktform unit test.
 */
function meeting_ktform_unit_test($hook, $type, $value, $params) {
	$value[] = dirname(__FILE__) . '/tests/meeting_ktform.php';
	return $value;
}
 

/** 
 * geolokation_allowed_contexts
 *
 * Extend the current context options to allow map geolocalization to show up
 */
function meeting_ktform_geolokation_allowed_contexts($hook, $entity_type, $returnvalue, $params) {

	$geo_support = MeetingBaseMain::ktform_get_entities_geolokation_support();
	
	if($geo_support && is_array($geo_support)) {
		$returnvalue = array_merge($geo_support, $returnvalue);
	}
	
	
	return $returnvalue;
}


/*
 * This function return an array of bulk actions links.
 * 
 */
function meeting_ktform_comments_entity_links_bulk_actions($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;
	
	//Make some validations.
	$valid_hook = $hook == 'meeting_ktform:entity:bulk:links:actions';
	
	$context = $params['context'];
	//KTODO: Check wich entity could be comentable.
	$comments_bulk_support = FALSE;
	
	if($context) {
		$comments_options = MeetingBaseMain::ktform_ktform_get_entity_comments_support_options($context);
		
		if($comments_options && $comments_options['comments'] && $comments_options['bulk_support']) {
			$comments_bulk_support = TRUE;
		} 
	}
	
	if($valid_hook && $comments_bulk_support) {
		//Remove default bulk actions.
		$returnvalue = array(
			'' => elgg_echo('meeting_ktform:bulk_actions:select:one'),
		);
		
		//Allow
		$allow_link = "{$CONFIG->url}action/meeting_ktform/bulk/comments_enabled?enabled=1";

		//Deny
		$deny_link = "{$CONFIG->url}action/meeting_ktform/bulk/comments_enabled?enabled=0";
		
		//Check tabs: Avoid tabs.
		//$current_tab = $params['tab'];
		
		$returnvalue[$allow_link] = elgg_echo('meeting_ktform:comments:entity:links:action:comments:on');
		$returnvalue[$deny_link] = elgg_echo('meeting_ktform:comments:entity:links:action:comments:off');

	}
	
	
	return $returnvalue;
}


/**
 * Hook into the framework and provide comments on blog entities.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 * @return unknown
 */
function meeting_ktform_annotate_comments($hook, $entity_type, $returnvalue, $params)
{
	$entity = $params['entity'];
	$full = $params['full_view'];

	if (
		//Try to detect if wa want to comment.
		($entity instanceof Meeting) &&	// Is the right type
		(MeetingBaseMain::ktform_get_entity_comments_support($entity->getSubtype())) &&  // The comments are enabled to the object.
		//KTODO: The comments on var should be good to implement, but always must be sent, as on or off.
		MeetingBaseMain::ktform_is_entity_commentable($entity) && 
		($full) // This is the full view
	)
	{
		// Display comments
        $add_comment = TRUE;
        $container = $entity->getContainerEntity();
        if (elgg_instanceof($container, 'group', 'project')) {
            if ($container->isVisitor()) {
                $add_comment = FALSE;
            }
        }
		$comments = elgg_view_comments($entity, $add_comment);
		return $comments;
	}

}

function meeting_ktform_generic_comment($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	if ($entity instanceof Meeting) {
		$content = '';
		
		$content = elgg_list_annotations(array(
			 'entity' => $entity->getGUID(),
			 'annotation_names' => array('generic_comment'),
		));
		//display the comment form
		$content .= elgg_view('comments/forms/edit',array('entity' => $entity));
		
		//Put the content into a wrapper
		$wrapper = elgg_view('meeting_ktform/comments/wrapper', array('entity' => $entity, 'content' => $content));

		return $wrapper;
	}
}

/**
 * Handler for meeting_ktform
 * 
 * @param type $page
 */
function meeting_ktform_page_handler($page) {
	
}


function meeting_ktform_save_date_range($event, $object_type, $object) {
	$validate_event = ($event == 'create' || $event == 'update');
	$validate_object_type = ($object_type == 'object');
	$validate_object = ($object instanceof ElggObject);

	$calendar_start = get_input('calendar_start', 0);
	$calendar_end = get_input('calendar_end', 0);

	if ($validate_event && $validate_object_type && $validate_object) {
		if (is_numeric($calendar_start) && $calendar_start > 0) {

			/**
			 * JavaScript fix to remove nanoseconds
			 */
			if (strlen($calendar_start) == 13) {
				$calendar_start = round($calendar_start / 1000);
			}

			if (strlen($calendar_end) == 13) {
				$calendar_end = round($calendar_end / 1000);
			}
			//End of js fix
			$calendar_start = MeetingBaseMain::ktform_get_default_dates($calendar_start);

			if (date('Y', $calendar_start['calendar_start']) <= 1971) {
				$object->calendar_start = time();
			} else {
				$object->calendar_start = $calendar_start['calendar_start'];
			}

			if (is_numeric($calendar_end) && $calendar_end > 0) {
				$calendar_end = MeetingBaseMain::ktform_get_default_dates($calendar_end);
				if (date('Y', $calendar_end['calendar_end']) <= 1971) {
					$object->calendar_end = time();
				} else {
					$object->calendar_end = $calendar_end['calendar_end'];
				}
			} //validate the inputs
		} //validate the object and the event
	}
}

function meeting_ktform_setup() {
	global $CONFIG;
	if (elgg_get_context() == 'admin') {
//		add_submenu_item(elgg_echo("meeting_ktform:admin"), $CONFIG->wwwroot . "meeting_ktform/admin");
	}
}

elgg_register_event_handler('init', 'system', 'meeting_ktform_init');
elgg_register_event_handler('pagesetup', 'system', 'meeting_ktform_setup');
