<?php

/**
 * gdrive
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
//gdrive_check_dependencies();
//require_once(dirname(dirname(__FILE__)) . '/classes/GDrive.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/GDriveForm.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/GDriveHandler.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/GDriveFormFilter.php');

function gdrive_main_init() {
	//elgg_extend_view("object/gdrive", 'object/ktform');
	//Support for comments into the plugin.
	GDriveBaseMain::ktform_set_entity_comments_support('gdrive', false);
	//GDriveBaseMain::ktform_set_entity_likes_support('gdrive');
	//GDriveBaseMain::ktform_set_comment_likes_support('gdrive');
	//GDriveBaseMain::ktform_set_entity_comments_support('gdrive', TRUE, array('bulk_support' => TRUE));
	//GDriveBaseMain::ktform_set_entity_category_support('gdrive');
	//GDriveBaseMain::ktform_set_entity_rating_support('gdrive');
	//GDriveBaseMain::ktform_set_bulk_action_support('gdrive');	
	//Geolokation support.
	//GDriveBaseMain::ktform_set_entity_geolokation_support('gdrive');
	// Register entity type and class
	// This is needed to handle the Class
	add_subtype("object", "gdrive", "GDrive");

	// Register entity type
	//If you register this, the object will appear in the search results, be carefull.
	//register_entity_type('object', 'gdrive');
	//Add filter support, comment the line below to remove filter.
	GDriveBaseMain::ktform_set_filter(array('plugin_name' => 'gdrive', 'filter' => 'GDriveFormFilter'));

	//Support for images into the plugin. Just one line, so easy, yessss. :)
	GDriveBaseMain::ktform_set_entity_image_support('gdrive', false);

	if (defined('GDrive_ENABLE_DEMO') && GDrive_ENABLE_DEMO) {
		elgg_register_plugin_hook_handler('gdrive:fields', 'gdrive:fields', 'gdrive_fields_demo_hook');
	}
	
	elgg_register_action('gdrive/gdrive/add', dirname(dirname(__FILE__)) . '/actions/gdrive/edit_a.php');
	elgg_register_action('gdrive/gdrive/edit', dirname(dirname(__FILE__)) . '/actions/gdrive/edit_a.php');
	elgg_register_action('gdrive/sync', dirname(dirname(__FILE__)) . '/actions/gdrive/sync_a.php');
	elgg_register_action('gdrive/importgoogle', dirname(dirname(__FILE__)) . '/actions/gdrive/importgoogle_a.php');
	elgg_register_action('gdrive/savedocument', dirname(dirname(__FILE__)) . '/actions/gdrive/savedocument_a.php');

	gdrive_setup_listing_fields();
}

function gdrive_setup_listing_fields() {
	global $CONFIG;

	$fields = array(
//		 'tags' => array(
//			 'type' => 'tags',
//			 'sortable' => TRUE,
//		 ),

//		 'first' => array(
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
//		 'third' => array(
//			  'type' => 'pulldown', //Static output. => This will use default: output/pulldown
//			  //'output_view' => 'myview/mycustompulldown', //This will use this view.
//			  'options' => array(
//					'options_values' => array(),
//			  ),
//			  'sortable' => TRUE,
//		 ),
	);

	//Add extra fields.
	GDriveBaseMain::ktform_set_extra_listing_fields('gdrive', $fields);

	/**
	 * Full fields
	 */
	//GDriveBaseMain::ktform_set_extra_listing_full_fields('gdrive', $fields);
}

function gdrive_check_dependencies() {
	if (!class_exists('GDriveBaseForm')) {
		register_error('The Ktform plugin should be installed and enabled in a higher position than gdrive');
		disable_plugin('gdrive');
		forward(REFERER);
	}
}

/**
 * HOOK FIELDS DEMO
 */
function gdrive_fields_demo_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'gdrive:fields');
	$check_type = ($type == 'gdrive:fields');
	
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
						'subtype' => 'gdrive',
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

elgg_register_event_handler('init', 'system', 'gdrive_main_init');