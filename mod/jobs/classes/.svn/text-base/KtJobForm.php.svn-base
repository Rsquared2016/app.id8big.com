<?php

/**
 * KtJob
 *
 * Class description here or bellow...
 * 
 * @author [author]
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
class KtJobForm extends KtJobBaseForm {

	public function __construct($form_vars = array()) {

		$form_vars['plugin_name'] = 'jobs';
		parent::__construct($form_vars);

		$this->setTypes('object', 'job');

		//$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
		$page_owner = elgg_get_page_owner_entity();

		if ($page_owner) {
			if ($page_owner->getSubtype() == 'company') {
				$company_name = $page_owner->name;
				$company_url = $page_owner->website;
			}
			$default_contact_email = $page_owner->contactemail;
		}

		//If you have to upload files, uncomment this line
		$this->setFormFileSupport();
		$fields = array(
			'title' => array(
				'type' => 'text',
				'input_class' => 'txtFrm txtFrm100',
				'container_group' => 'a1',
				'validators' => array('required' => TRUE),
			),
			'job_type' =>
			array(
				'type' => 'job_type',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => true),
				'container_group' => 'a1',
				'default_value' => 'full_time',
			),
			'job_length' =>
			array(
				'type' => 'radio',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => true),
				'container_group' => 'a1',
				'default_value' => '0_3',
				'options' => array(
					'options' => KtJob::getJobLength(),
				)
			),
			'job_category' =>
			array(
				'type' => 'job_category',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => FALSE),
				'container_group' => 'a1',
				'options' => array(
					'input_type' => 'checkboxes',
				),
			),

			'company' => array(
				'type' => 'text',
				//'type' => 'job_company',
				'input_class' => 'txtFrm txtFrm100',
				'container_group' => 'a2',
				'validators' => array('required' => TRUE),
				'default_value' => $company_name,
			),
			'company_url' => array(
				'type' => 'url',
				'input_class' => 'txtFrm txtFrm100',
				'container_group' => 'a2',
				'default_value' => $company_url,
			),
			//Company Image
			'image' =>
			array(
				'label' => elgg_echo('jobs:label:company:image'),
				'type' => 'image',
				'container_group' => 'a2',
				'validators' => array('file' => array('required' => false, 'mimetype' => "web_images", 'max_size' => '200067')),
			),
			/* Keetup category support ? */
			/* 'category_id' =>
			  array(
			  'label' => elgg_echo('keetup_categories:category:title'),
			  'type' => 'keetup_categories',
			  'input_class' => 'selectFrm selectFrm50',
			  //'validators' => array('required' => TRUE),
			  'options' => array(
			  'size' => 1,
			  'cthis' => FALSE,
			  ),
			  ), */

			'job_region' =>
			array(
				'type' => 'job_regions',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => TRUE),
				'container_group' => 'b',
				'options' => array(
					'input_type' => 'dropdown',
				),
			),
			'location' =>
			array(
				'label' => elgg_echo('jobs:jobs:label:location'),
				'type' => 'location',
				'container_group' => 'b',
				'wrapper_class' => 'ktFormWrapper locationWrapper',
				'validators' => array('required' => TRUE),
				'input_class' => 'txtFrm txtFrm100',
			),
			'description' =>
			array(
				'type' => 'longtext',
				'container_group' => 'b',
				'validators' => array('required' => TRUE),
			),
			'email' =>
			array(
				'type' => 'text',
				'container_group' => 'b',
				//				'type	' => 'job_company',
				'input_class' => 'txtFrm txtFrm100',
				'validators' => array('required' => TRUE),
				'info_text' => TRUE,
				'default_value' => $default_contact_email,
			),
			'tags' => array(
				'type' => 'tags',
				'container_group' => 'c',
				'process_as' => 'array', //This will process the form as array, if you do not pass any array as input, then will strip tags to array
			),
				/* 'access_id' => 
				  array(
				  'type' => 'access',
				  'container_group' => 'z',
				  'default_value' => ACCESS_LOGGED_IN,
				  ), */
		);

		$extra_fields = array();
		//KTODO: Check if option site wide category is enabled.
		/* $extra_fields = array(
		  'universal_categories_list[]' => array(
		  'type' => 'categories',
		  'label' => elgg_echo('jobs:jobs:label:categories'),
		  'container_group' => 'a',
		  'input_class' => 'txtFrm txtFrm100',
		  ),
		  ); */

		$fields = array_merge($fields, $extra_fields);

		if (elgg_is_active_plugin('keetup_categories') == FALSE) {
			$has_categories = JobsSettings::getCategories();
			if (empty($has_categories)) {
				unset($fields['job_category']);
			}
		}

			$has_regions = JobsSettings::getCategories(array(), 'jobs_regions');
			if (empty($has_regions)) {
				unset($fields['job_region']);
			}

		if (get_input('action')) {
			$job_type = get_input('job_type');

			if ($job_type == 'freelance') {
				$fields['location']['validators']['required'] = FALSE;
			}
		}

		$this->setFields($fields);
	}

}