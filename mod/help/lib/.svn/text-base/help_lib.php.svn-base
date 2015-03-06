<?php

/**
 * help
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
//help_check_dependencies();
//require_once(dirname(dirname(__FILE__)) . '/classes/Help.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/HelpForm.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/HelpHandler.php');
//require_once(dirname(dirname(__FILE__)) . '/classes/HelpFormFilter.php');

function help_main_init() {
	//elgg_extend_view("object/help", 'object/ktform');
	//Support for comments into the plugin.
	//HelpBaseMain::ktform_set_entity_comments_support('help');
	//HelpBaseMain::ktform_set_entity_likes_support('help');
	//HelpBaseMain::ktform_set_comment_likes_support('help');
	//HelpBaseMain::ktform_set_entity_comments_support('help', TRUE, array('bulk_support' => TRUE));
	HelpBaseMain::ktform_set_entity_category_support('help');
	//HelpBaseMain::ktform_set_entity_rating_support('help');
	//HelpBaseMain::ktform_set_bulk_action_support('help');	
	//Geolokation support.
	//HelpBaseMain::ktform_set_entity_geolokation_support('help');
	// Register entity type and class
	// This is needed to handle the Class
	add_subtype("object", "help", "Help");

	// Register entity type
	//If you register this, the object will appear in the search results, be carefull.
	//register_entity_type('object', 'help');
	//Add filter support, comment the line below to remove filter.
	HelpBaseMain::ktform_set_filter(array('plugin_name' => 'help', 'filter' => 'HelpFormFilter'));

	//Support for images into the plugin. Just one line, so easy, yessss. :)
	//HelpBaseMain::ktform_set_entity_image_support('help');

	if (defined('Help_ENABLE_DEMO') && Help_ENABLE_DEMO) {
		elgg_register_plugin_hook_handler('help:fields', 'help:fields', 'help_fields_demo_hook');
	}
	
	elgg_register_action('help/help/add', dirname(dirname(__FILE__)) . '/actions/help/edit_a.php');
	elgg_register_action('help/help/edit', dirname(dirname(__FILE__)) . '/actions/help/edit_a.php');

	help_setup_listing_fields();
	
	//Add support for categories.
	register_plugin_hook('keetup_categories:allow', 'context', 'help_allow_categories');	

}

/**
 * This hook hacks the keetup categories to add extra contexts
 * @param type $hook
 * @param type $entity_type
 * @param type $returnvalue
 * @param type $params
 * @return string 
 */
function help_allow_categories($hook, $entity_type, $returnvalue, $params) { 
	if ($hook == 'keetup_categories:allow' && $entity_type == 'context') {
		$returnvalue[] = 'help';
	}

	return $returnvalue;
}

function help_setup_listing_fields() {
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

	
	//KTODO: Implement help user types.
	/*$user_content_type = help_get_user_types_content(FALSE);
	if($user_content_type) {
		$fields['user_content_type'] = array(
				'type' => 'checkboxes',
				'output_view' => 'help/output/user_content_type', //This will use this view.
				'options' => array(
					'options' => $user_content_type
				),
		);
	}*/
	
	//Add extra fields.
	//HelpBaseMain::ktform_set_extra_listing_fields('help', $fields);

	/**
	 * Full fields
	 */
	//HelpBaseMain::ktform_set_extra_listing_full_fields('help', $fields);
}

function help_check_dependencies() {
	if (!class_exists('HelpBaseForm')) {
		register_error('The Ktform plugin should be installed and enabled in a higher position than help');
		disable_plugin('help');
		forward(REFERER);
	}
}

/**
 * HOOK FIELDS DEMO
 */
function help_fields_demo_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'help:fields');
	$check_type = ($type == 'help:fields');
	
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
						'subtype' => 'help',
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

elgg_register_event_handler('init', 'system', 'help_main_init');