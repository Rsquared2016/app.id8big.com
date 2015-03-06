<?php

/**
 * jobs
 *
 * myclass lib description here...
 * 
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
/* [To delete] 
 *  This is the myclass library
 */
//jobs_check_dependencies();
//require_once(dirname(dirname(__FILE__)) . '/classes/KtJob.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/KtJobForm.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/KtJobHandler.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/KtJobFormFilter.php');

function jobs_main_init() {
	//elgg_extend_view("object/jobs", 'object/ktform');
	//Support for comments into the plugin.
	KtJobBaseMain::ktform_set_entity_comments_support('job');
//	KtJobBaseMain::ktform_set_entity_likes_support('job');
	//KtJobBaseMain::ktform_set_comment_likes_support('job');
	//KtJobBaseMain::ktform_set_entity_comments_support('job', TRUE, array('bulk_support' => TRUE));
	//KtJobBaseMain::ktform_set_entity_category_support('job');
	//KtJobBaseMain::ktform_set_entity_rating_support('job');
	//KtJobBaseMain::ktform_set_bulk_action_support('job');	
	//Geolokation support.
	//KtJobBaseMain::ktform_set_entity_geolokation_support('job');
	// Register entity type and class
	// This is needed to handle the Class
	add_subtype("object", "job", "KtJob");
	add_subtype("object", SUBMIT_JOB_SUBTYPE, "SubmitJob");

	// Register entity type
	//If you register this, the object will appear in the search results, be carefull.
	//register_entity_type('object', 'jobs');
	//Add filter support, comment the line below to remove filter.
	KtJobBaseMain::ktform_set_filter(array('plugin_name' => 'jobs', 'filter' => 'KtJobFormFilter'));

	//Support for images into the plugin. Just one line, so easy, yessss. :)
	KtJobBaseMain::ktform_set_entity_image_support('job');

	elgg_register_action('jobs/job/add', dirname(dirname(__FILE__)) . '/actions/jobs/edit_a.php');
	elgg_register_action('jobs/job/edit', dirname(dirname(__FILE__)) . '/actions/jobs/edit_a.php');

	jobs_setup_listing_fields();
}

function jobs_setup_listing_fields() {
	global $CONFIG;

	$fields = array(
		 //'tags' => 'tags',

//		 'dummie_dropdown' => array(
//			  'type' => 'pulldown', //Static output. => This will use default: output/pulldown
//			  //'output_view' => 'myview/mycustompulldown', //This will use this view.
//			  'options' => array(
//					'options_values' => array(),
//			  ),
//			  'sortable' => TRUE,
//		 ),
//		 'second' => array(
//			  'type' => 'pulldown', //Static output. => This will use default: output/pulldown
//			  //'output_view' => 'myview/mycustompulldown', //This will use this view.
//			  'options' => array(
//					'options_values' => array(),
//			  ),
//			  'sortable' => FALSE,
//		 ),
		 'job_region' => array(
			  'type' => 'job_regions', //Static output. => This will use default: output/pulldown
			  //'output_view' => 'myview/mycustompulldown', //This will use this view.
			 
			  'sortable' => FALSE,
		 ),
	);

	//Add extra fields.
	KtJobBaseMain::ktform_set_extra_listing_fields('job', $fields);

	/**
	 * Full fields
	 */
	//KtJobBaseMain::ktform_set_extra_listing_full_fields('job', $fields);
}

function jobs_check_dependencies() {
	if (!class_exists('KtJobBaseForm')) {
		register_error('The Ktform plugin should be installed and enabled in a higher position than jobs');
		disable_plugin('jobs');
		forward(REFERER);
	}
}

elgg_register_event_handler('init', 'system', 'jobs_main_init');