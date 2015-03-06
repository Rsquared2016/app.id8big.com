<?php

/**
 * GDrive
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
 *		- FOR EXAMPLE OF IMPLEMENTATION SEE THE FUNCTION @gdrive_fields_demo_hook()
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 *		- TO REMOVE THE DEMO MODE SET TO FALSE THE CONSTANT GDrive_ENABLE_DEMO
 */

class GDriveForm extends GDriveBaseForm {

	public function __construct($form_vars = array()) {

		$form_vars['plugin_name'] = 'gdrive';
		
		parent::__construct($form_vars);

		$this->setTypes('object', 'gdrive');
		
		$form_vars = array(
//			'class' => 'gdrive-auth',
		);
		$this->setFormVars($form_vars);
		
		//$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
		//If you have to upload files, uncomment this line
		$this->setFormFileSupport();
		
		$fields = array(
			'title' => array(
				'type' => 'text',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => TRUE),
				'container_group' => 'b',
			),
			'description' => array(
				'type' => 'longtext',
				'label' => TRUE,
				'validators' => array('required' => TRUE),
				'container_group' => 'c',
			),
//			'gdriveauth' => array(
//				'type' => 'gdriveauth',
//				'wrapper_class' => 'no',
//				'container_group' => 'e',
//			),
			'access_id' => array(
				'type' => 'access',
				'container_group' => 'z',
				'default_value' => ACCESS_LOGGED_IN,
			),
		);
		
//		$guid = get_input('guid');
//		$entity = get_entity($guid);
//		if (!($entity instanceof GDrive)) {
			$fields['file'] = array(
				'type' => 'kt_file',
				'container_group' => 'd',
				'validators' => array('file' => array('required' => TRUE)),
				'options' => array(
					'file_options' => array(
						'type' => 'object',
						'subtype' => 'gdrive',
					),
				),
			);
//		}

		$this->setFields($fields);
		
	}

}