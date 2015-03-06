<?php

/**
 * Meeting
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
 *		- FOR EXAMPLE OF IMPLEMENTATION SEE THE FUNCTION @meeting_fields_demo_hook()
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 *		- TO REMOVE THE DEMO MODE SET TO FALSE THE CONSTANT Meeting_ENABLE_DEMO
 */

class MeetingForm extends MeetingBaseForm {

	public function __construct($form_vars = array()) {
        
        global $SITE_TIMEZONE;
        
		$form_vars['plugin_name'] = 'meeting';
		
		parent::__construct($form_vars);

		$this->setTypes('object', 'meeting');

		//$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
		//If you have to upload files, uncomment this line
		$this->setFormFileSupport();
		
		$fields = array(
			/*'image' => array(
				'type' => 'image',
				'container_group' => 'a',
				'validators' => array('file' => array('required' => TRUE, 'mimetype' => "web_images", 'max_size' => '200067')),
			),*/
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
            'start_date' => array(
                'type' => 'date',
                'input_class' => 'txtFrm txtFrm25',
                'validators' => array('required' => TRUE),
				'container_group' => 'c',
            ),
            'start_time' => array(
                'type' => 'time',
                'input_class' => 'txtFrm txtFrm25',
                'validators' => array('required' => TRUE),
				'container_group' => 'c',
            ),
            'timezone' => array(
                'type' => 'timezone',
                'input_class' => 'txtFrm txtFrm50',
                'validators' => array('required' => TRUE),
                'container_group' => 'c',
                'default_value' => $SITE_TIMEZONE,
                'options' => array(
                    'is_pulldown' => TRUE,
                ),
            ),
            'duration' => array(
                'type' => 'duration',
                'input_class' => 'txtFrm txtFrm25',
                'validators' => array('required' => TRUE),
				'container_group' => 'c',
                //'info_text' => elgg_echo('meeting:duration:info_text'),
            ),
            'participants' => array(
                'type' => 'participants',
                'input_class' => 'txtFrm txtFrm25',
                'validators' => array('required' => TRUE),
				'container_group' => 'c',
                //'info_text' => elgg_echo('meeting:participants:info_text'),
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