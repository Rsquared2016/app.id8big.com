<?php

/**
 * Events
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
 *		- FOR EXAMPLE OF IMPLEMENTATION SEE THE FUNCTION @events_fields_demo_hook()
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 *		- TO REMOVE THE DEMO MODE SET TO FALSE THE CONSTANT Events_ENABLE_DEMO
 */

class EventsForm extends EventsBaseForm {

	public function __construct($form_vars = array()) {

		$form_vars['plugin_name'] = 'events';
		parent::__construct($form_vars);

		$this->setTypes('object', 'event');
		$this->setClass('Events');
		
		global $SITE_TIMEZONE;
		
		$default_startime = events_get_default_time();
		
		
		//$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
		//If you have to upload files, uncomment this line
		$this->setFormFileSupport();
		$fields = array(
			 'title' =>
			 array(
				  'type' => 'text',
				  'input_class' => 'txtFrm txtFrm100',
				  'validators' => array('required' => TRUE),
				  'container_group' => 'a',
			 ),
			 'description' =>
			 array(
				  'type' => 'longtext',
				  'label' => TRUE,
				  'validators' => array('required' => TRUE),
				  'container_group' => 'a',
			 ),
			 'location' => array(
				  'type' => 'location',
				  'input_class' => 'txtFrm txtFrm100',
				  'container_group' => 'a',
			 ),
                        'all_day' => array(
				  'type' => 'checkboxes',
				  'input_class' => 'txtFrm txtFrm50 all_day:check',
				  'container_group' => 'bADateGroup ',
                                  'label' => FALSE,
                                  'options' => array(
                                      'options' => array(elgg_echo('event:all_day') => 'yes'),
                                  ),
			 ),
			 'start_date' => array(
				  'type' => 'date',
				  'input_class' => 'txtFrm txtFrm50',
				  'container_group' => 'bADateGroup datechoose',
				  'default_value' => date('Y-m-d'),
			 ),
			 'start_time' => array(
				  'type' => 'date_time',
				  'input_class' => 'txtFrm txtFrm25',
				  'container_group' => 'bADateGroup inline',
				  'default_value' => $default_startime,
			 ),
			 
			 'end_date' => array(
				  'type' => 'date',
				  'input_class' => 'txtFrm txtFrm50',
				  'container_group' => 'bEDateGroup',
				  'default_value' => date('Y-m-d'),
			 ),
			 'end_time' => array(
				  'type' => 'date_time',
				  'input_class' => 'txtFrm txtFrm25',
				  'container_group' => 'bEDateGroup inline',
				  'default_value' => '84600',
			 ),			 
			 
			 'timezone' => array(
				  'type' => 'timezone_entities',
				  'input_class' => 'txtFrm txtFrm100',
				  'container_group' => 'c',
				  'default_value' => $SITE_TIMEZONE,
			 ),
			 'image' =>
			 array(
				  'type' => 'image',
				  'container_group' => 'a',
				  'validators' => array('file' => array('required' => FALSE, 'mimetype' => "web_images", 'max_size' => '200067')),
				  'container_group' => 'z',
			 ),
			 'file' => array(
				  'type' => 'kt_file',
                  'validators' => array('file' => array('required' => FALSE)),
				  'container_group' => 'c',
                  'options' => array(
					'file_options' => array(
						'type' => 'object',
						'subtype' => 'event',
					),
				),
			 ),
			 'access_id' =>
			 array(
				  'type' => 'access',
				  'container_group' => 'z',
				  'default_value' => ACCESS_LOGGED_IN,
				  'container_group' => 'z',
			 ),
		);
                if (elgg_is_active_plugin('categories')) {
                    $fields['categories'] = array(
				  'type' => 'categories',
                                  'label' => FALSE,
				  'input_class' => 'txtFrm txtFrm100',
				  'container_group' => 'c',
			 );
                }
		$this->setFields($fields);
	}

}