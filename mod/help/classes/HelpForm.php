<?php

/**
 * Help
 *
 * Class description here or bellow...
 * 
 * @author [author]
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 * 
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 *		- FOR EXAMPLE OF IMPLEMENTATION SEE THE FUNCTION @help_fields_demo_hook()
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 *		- TO REMOVE THE DEMO MODE SET TO FALSE THE CONSTANT Help_ENABLE_DEMO
 */

class HelpForm extends HelpBaseForm {

	public function __construct($form_vars = array()) {

		$form_vars['plugin_name'] = 'help';
		
		parent::__construct($form_vars);

		$this->setTypes('object', 'help');

		//$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
		//If you have to upload files, uncomment this line
		$this->setFormFileSupport();
		
		$fields = array(
			
			'title' => 
				array(
					'type' => 'text',
					'input_class' => 'txtFrm txtFrm100',
					'validators' => array('required' => TRUE),
				),
			'category_id' =>
				array(
					'label' => elgg_echo('keetup_categories:category:title'),
					'type' => 'keetup_categories',
					'input_class' => 'selectFrm selectFrm50',
					'validators' => array('required' => TRUE),
					'options' => array(
						'size' => 1,
						'cthis' => FALSE,
					),
				),
			'description' =>
				array(
					'type' => 'longtext',
					'validators' => array('required' => TRUE),
					'container_group' => 'c',
			),
			'access_id' => 
				array(
					'type' => 'access',
					'default_value' => ACCESS_PUBLIC,
					'container_group' => 'c',
					//'wrapper_class' => 'ktFormWrapper no',
				),
		);
		
		//User subtype content.
		//Throw a hook or call a static method.
		$user_content_type = help_get_user_types_content();
		if($user_content_type) {
			$default_value = current($user_content_type);
			
			$fields['user_content_type'] = array(
					'type' => 'checkboxes',
					'options' => array(
						'options' => $user_content_type
					),
					'default_value' => $default_value,
					'validators' => array('required' => TRUE),
			);
		}

		$this->setFields($fields);
		
	}

}