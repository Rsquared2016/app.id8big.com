<?php

/**
 * kt_polls
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
//kt_polls_check_dependencies();
//require_once(dirname(dirname(__FILE__)) . '/classes/Polls.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/PollsForm.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/PollsHandler.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/PollsFormFilter.php');

function kt_polls_main_init() {
	//elgg_extend_view("object/kt_polls", 'object/ktform');
	//Support for comments into the plugin.
//	PollsBaseMain::ktform_set_entity_comments_support('kt_poll');
	//PollsBaseMain::ktform_set_entity_likes_support('kt_poll');
	//PollsBaseMain::ktform_set_comment_likes_support('kt_poll');
	//PollsBaseMain::ktform_set_entity_comments_support('kt_poll', TRUE, array('bulk_support' => TRUE));
	//PollsBaseMain::ktform_set_entity_category_support('kt_poll');
	//PollsBaseMain::ktform_set_entity_rating_support('kt_poll');
	//PollsBaseMain::ktform_set_bulk_action_support('kt_poll');	
	//Geolokation support.
	//PollsBaseMain::ktform_set_entity_geolokation_support('kt_poll');
	// Register entity type and class
	// This is needed to handle the Class
	add_subtype("object", "kt_poll", "Polls");

	//This view is usefull to add the poll and quiz form
	//elgg_extend_view('ktform/profile/buttons', 'kt_polls/profile/buttons');
	
	// Register entity type
	//If you register this, the object will appear in the search results, be carefull.
	//register_entity_type('object', 'kt_polls');
	//Add filter support, comment the line below to remove filter.
	PollsBaseMain::ktform_set_filter(array('plugin_name' => 'kt_polls', 'filter' => 'PollsFormFilter'));

	//Support for images into the plugin. Just one line, so easy, yessss. :)
//	PollsBaseMain::ktform_set_ent122ity_image_support('kt_poll');

	if (defined('Polls_ENABLE_DEMO') && Polls_ENABLE_DEMO) {
		elgg_register_plugin_hook_handler('kt_polls:fields', 'kt_polls:fields', 'kt_polls_fields_demo_hook');
	}
	
	elgg_register_action('kt_polls/kt_poll/add', dirname(dirname(__FILE__)) . '/actions/kt_polls/edit_a.php');
	elgg_register_action('kt_polls/kt_poll/edit', dirname(dirname(__FILE__)) . '/actions/kt_polls/edit_a.php');

//	kt_polls_setup_listing_fields();
}

function kt_polls_setup_listing_fields() {
	global $CONFIG;

	$fields = array(
//		 'tags' => array(
//			 'type' => 'tags',
//			 'sortable' => TRUE,
//		 ),

		 'first' => array(
			  'type' => 'pulldown', //Static output. => This will use default: output/pulldown
			  //'output_view' => 'myview/mycustompulldown', //This will use this view.
			  'options' => array(
					'options_values' => array(),
			  ),
			  'sortable' => TRUE,
		 ),
		 'second' => array(
			  'type' => 'pulldown', //Static output. => This will use default: output/pulldown
			  //'output_view' => 'myview/mycustompulldown', //This will use this view.
			  'options' => array(
					'options_values' => array(),
			  ),
			  'sortable' => FALSE,
		 ),
		 'third' => array(
			  'type' => 'pulldown', //Static output. => This will use default: output/pulldown
			  //'output_view' => 'myview/mycustompulldown', //This will use this view.
			  'options' => array(
					'options_values' => array(),
			  ),
			  'sortable' => TRUE,
		 ),
	);

	//Add extra fields.
	PollsBaseMain::ktform_set_extra_listing_fields('kt_poll', $fields);

	/**
	 * Full fields
	 */
	//PollsBaseMain::ktform_set_extra_listing_full_fields('kt_poll', $fields);
}

function kt_polls_check_dependencies() {
	if (!class_exists('PollsBaseForm')) {
		register_error('The Ktform plugin should be installed and enabled in a higher position than kt_polls');
		disable_plugin('kt_polls');
		forward(REFERER);
	}
}

/**
 * HOOK FIELDS DEMO
 */
function kt_polls_fields_demo_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'kt_polls:fields');
	$check_type = ($type == 'kt_polls:fields');
	
	if ($check_hook && $check_type) {
		$return = array(
			'image' => array(
				'type' => 'image',
				'container_group' => 'a',
				'validators' => array('file' => array('required' => TRUE, 'mimetype' => "web_images", 'max_size' => '200067')),
			),
			'other_image' => array(
				'type' => 'kt_file',
				'validators' => array('file' => array('required' => TRUE, 'mimetype' => "web_images", 'max_size' => '200067')),
				'options' => array(
					'file_options' => array(
						'type' => 'object',
						'subtype' => 'kt_poll',
					),
				),
			),
			'title' => array(
				'type' => 'text',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => TRUE),
				'container_group' => 'b',
			),
			'dummie_autocomplete' => array(
				'type' => 'autocomplete',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
			),
			'dummie_checkboxes' => array(
				'type' => 'checkboxes',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
				'options' => array(
					'options' => array(
						'Check Option 1' => 'yes',
						'Check Option 2' => 'no',
					),
				),
			),
			'dummie_date' => array(
				'type' => 'date',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
			),
			'dummie_dropdown' => array(
				'type' => 'dropdown',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
				'options' => array(
					'options' => array(
						'opt1' => 'Option 1',
						'opt2' => 'Option 2',
						'opt3' => 'Option 3',
					),
				),
			),
			'dummie_email' => array(
				'type' => 'email',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
			),
			'location' => array( //That kind of imput only support this metaname
				'type' => 'location',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
			),
			'dummie_radios' => array(
				'type' => 'radio',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
				'options' => array(
					'options' => array(
						'Radio Opt 1' => 'rad_opt1',
						'Radio Opt 2' => 'rad_opt2',
						'Radio Opt 3' => 'rad_opt3',
					),
				),
			),
//			'dummie_tag' => array( //Accepts a single tag value
//				'type' => 'tag',
//				'input_class' => 'txtFrm txtFrm100',
//				'validators' => array('required' => FALSE),
//				'container_group' => 'b',
//			),
			'dummie_url' => array( //Accepts a single tag value
				'type' => 'url',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
			),
			'members' => array( //That kind of imput only support this metaname
				'type' => 'userpicker',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'b',
			),
			'shortdescription' => array(
				'type' => 'text',
				'info_text' => TRUE,
				'label' => TRUE,
				'container_group' => 'c',
			),
			'description' => array(
				'type' => 'longtext',
				'info_text' => TRUE,
				'label' => TRUE,
				'validators' => array('required' => TRUE),
				'container_group' => 'c',
			),
			'tags' => array(
				'type' => 'tags',
				'container_group' => 'c',
				//'validators' => array('value_filter' => array('exp' => 'image')), //some regexp
				'process_as' => 'array', //This will process the form as array, if you do not pass any array as input, then will strip tags to array
			),
			'access_id' => array(
				'type' => 'access',
				'container_group' => 'z',
				'default_value' => ACCESS_LOGGED_IN,
			),
		);
	}
	
	return $return;
	
}

elgg_register_event_handler('init', 'system', 'kt_polls_main_init');