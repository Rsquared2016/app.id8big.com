<?php

/**
 * News
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
 *		- FOR EXAMPLE OF IMPLEMENTATION SEE THE FUNCTION @news_fields_demo_hook()
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 *		- TO REMOVE THE DEMO MODE SET TO FALSE THE CONSTANT News_ENABLE_DEMO
 */

class NewsForm extends NewsBaseForm {

	public function __construct($form_vars = array()) {

		$form_vars['plugin_name'] = 'news';
		
		parent::__construct($form_vars);

		$this->setTypes('object', 'new');

		//$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
		//If you have to upload files, uncomment this line
		$this->setFormFileSupport();
		
		$fields = array(
//			'image' => array(
//				'type' => 'image',
//				'container_group' => 'a',
//				'validators' => array('file' => array('required' => TRUE, 'mimetype' => "web_images", 'max_size' => '200067')),
//			),
			'title' => array(
				'type' => 'text',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => TRUE),
				'container_group' => 'b',
			),
			'excerpt' => array(
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

		$this->setFields($fields);
		
	}

}