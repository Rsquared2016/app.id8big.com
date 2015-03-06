<?php

/**
 * jobs_ktform
 *
 * @author Diego Gallardo and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

require_once(dirname(__FILE__) . '/vendors/plugin/plugin.php');

//KTODO: ADD BULK ACTIONS PROGRAMMING
define('KtJob_st_DISABLE_BULK_ACTIONS', FALSE);
define('KtJob_st_LISTING_FULL_EXCERPT_LONGTEXT', 250);
define('KtJob_st_MAX_LENGHT_TEXT', 150);
define('KtJob_st_MAX_LENGHT_TITLE', 90);
define('KtJob_st_MAX_LENGHT_TITLE_LISTING', 70);
define('KtJob_st_AJAX_REL_ATTR', 'isAjaxForm');

$load_classes = array(
	'KtJobBaseMain', //Main functions
	 
	'KtJobBaseExceptions',
	'KtJobBaseValidators',
	'KtJobBaseSave',
	'KtJobBaseGroupSave',
	'KtJobBaseForm',
	'KtJobBaseHandler',
	'KtJobBaseFilter',
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

function jobs_ktform_init() {
	//Initializate the plugin
	jobs_ktform_initializateplugin();

	//Page Handler
	elgg_register_page_handler('jobs_ktform', 'jobs_ktform_page_handler');
	// Register an annotation handler for comments etc
	elgg_register_plugin_hook_handler('entity:annotate', 'object', 'jobs_ktform_annotate_comments');
	elgg_register_plugin_hook_handler('entity:annotate', 'group', 'jobs_ktform_annotate_comments');
	
	elgg_register_plugin_hook_handler('comments', 'object', 'jobs_ktform_generic_comment');
	elgg_register_plugin_hook_handler('comments', 'group', 'jobs_ktform_generic_comment');

	elgg_extend_view('css', 'jobs/css/main');
	elgg_extend_view('css', 'jobs/css/custom');
	elgg_extend_view('css', 'jobs/css/elements/helpers');
	//elgg_extend_view('css', 'jobs_ktform_group/css');
	
	elgg_extend_view('footer/analytics', 'jobs/js/main', 400);
	elgg_extend_view('footer/analytics', 'jobs/js/custom', 400);
	
	elgg_register_action('jobs/delete', dirname(__FILE__).'/actions/delete_a.php');
	
	//Some bulk actions.
	elgg_register_action('jobs/job/bulk/delete', dirname(__FILE__).'/actions/bulk/delete_a.php');	
	elgg_register_action('jobs/job/bulk/comments_enabled', dirname(__FILE__).'/actions/bulk/comments_enabled_a.php');

	//Bulk Actions hook.
	elgg_register_plugin_hook_handler('jobs_ktform:entity:bulk:links:actions', 'entity', 'jobs_ktform_comments_entity_links_bulk_actions');
	
	
	//KTODO: Check bulk actions to add before pagintion.
	//elgg_extend_view('navigation/pagination', 'jobs_ktform/bulk_actions/form', 400);
	
	//Add object page owner handler.
//	add_page_owner_handler('KtJobBaseMain::ktform_object_owner_handler'); //@KTODO: CHECK IF THIS WORK, SERIOUSLY
	
	elgg_register_event_handler("create",'object',"jobs_ktform_save_date_range");
	elgg_register_event_handler("update",'object',"jobs_ktform_save_date_range");
	
	//Geolokation support.
	elgg_register_plugin_hook_handler("geolokation:allowed_contexts", "all", "jobs_ktform_geolokation_allowed_contexts");	
	
	//Unit tests
	//elgg_register_plugin_hook_handler('unit_test', 'system', 'jobs_ktform_unit_test');
	register_translations(dirname(__FILE__).'/languages/', TRUE);
}

/*
 * Ktform unit test.
 */
function jobs_ktform_unit_test($hook, $type, $value, $params) {
	$value[] = dirname(__FILE__) . '/tests/jobs_ktform.php';
	return $value;
}
 

/** 
 * geolokation_allowed_contexts
 *
 * Extend the current context options to allow map geolocalization to show up
 */
function jobs_ktform_geolokation_allowed_contexts($hook, $entity_type, $returnvalue, $params) {

	$geo_support = KtJobBaseMain::ktform_get_entities_geolokation_support();
	
	if($geo_support && is_array($geo_support)) {
		$returnvalue = array_merge($geo_support, $returnvalue);
	}
	
	
	return $returnvalue;
}


/*
 * This function return an array of bulk actions links.
 * 
 */
function jobs_ktform_comments_entity_links_bulk_actions($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;
	
	//Make some validations.
	$valid_hook = $hook == 'jobs_ktform:entity:bulk:links:actions';
	
	$context = $params['context'];
	//KTODO: Check wich entity could be comentable.
	$comments_bulk_support = FALSE;
	
	if($context) {
		$comments_options = KtJobBaseMain::ktform_ktform_get_entity_comments_support_options($context);
		
		if($comments_options && $comments_options['comments'] && $comments_options['bulk_support']) {
			$comments_bulk_support = TRUE;
		} 
	}
	
	if($valid_hook && $comments_bulk_support) {
		//Remove default bulk actions.
		$returnvalue = array(
			'' => elgg_echo('jobs_ktform:bulk_actions:select:one'),
		);
		
		//Allow
		$allow_link = "{$CONFIG->url}action/jobs_ktform/bulk/comments_enabled?enabled=1";

		//Deny
		$deny_link = "{$CONFIG->url}action/jobs_ktform/bulk/comments_enabled?enabled=0";
		
		//Check tabs: Avoid tabs.
		//$current_tab = $params['tab'];
		
		$returnvalue[$allow_link] = elgg_echo('jobs_ktform:comments:entity:links:action:comments:on');
		$returnvalue[$deny_link] = elgg_echo('jobs_ktform:comments:entity:links:action:comments:off');

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
function jobs_ktform_annotate_comments($hook, $entity_type, $returnvalue, $params)
{
	$entity = $params['entity'];
	$full = $params['full_view'];

	if (
		//Try to detect if wa want to comment.
		($entity instanceof KtJob) &&	// Is the right type
		(KtJobBaseMain::ktform_get_entity_comments_support($entity->getSubtype())) &&  // The comments are enabled to the object.
		//KTODO: The comments on var should be good to implement, but always must be sent, as on or off.
		KtJobBaseMain::ktform_is_entity_commentable($entity) && 
		($full) // This is the full view
	)
	{
		// Display comments
		return elgg_view_comments($entity);
	}

}

function jobs_ktform_generic_comment($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	if ($entity instanceof KtJob) {
		$content = '';
		
		$content = elgg_list_annotations(array(
			 'entity' => $entity->getGUID(),
			 'annotation_names' => array('generic_comment'),
		));
		//display the comment form
		$content .= elgg_view('comments/forms/edit',array('entity' => $entity));
		
		//Put the content into a wrapper
		$wrapper = elgg_view('jobs_ktform/comments/wrapper', array('entity' => $entity, 'content' => $content));

		return $wrapper;
	}
}

/**
 * Handler for jobs_ktform
 * 
 * @param type $page
 */
function jobs_ktform_page_handler($page) {
	
}


function jobs_ktform_save_date_range($event, $object_type, $object) {
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
			$calendar_start = KtJobBaseMain::ktform_get_default_dates($calendar_start);

			if (date('Y', $calendar_start['calendar_start']) <= 1971) {
				$object->calendar_start = time();
			} else {
				$object->calendar_start = $calendar_start['calendar_start'];
			}

			if (is_numeric($calendar_end) && $calendar_end > 0) {
				$calendar_end = KtJobBaseMain::ktform_get_default_dates($calendar_end);
				if (date('Y', $calendar_end['calendar_end']) <= 1971) {
					$object->calendar_end = time();
				} else {
					$object->calendar_end = $calendar_end['calendar_end'];
				}
			} //validate the inputs
		} //validate the object and the event
	}
}

function jobs_ktform_setup() {
	global $CONFIG;
	if (elgg_get_context() == 'admin') {
//		add_submenu_item(elgg_echo("jobs_ktform:admin"), $CONFIG->wwwroot . "jobs_ktform/admin");
	}
}

elgg_register_event_handler('init', 'system', 'jobs_ktform_init');
elgg_register_event_handler('pagesetup', 'system', 'jobs_ktform_setup');
