<?php

class KtJobFormFilter extends KtJobBaseFilter {

	public function __construct($form_vars = array()) {
		global $CONFIG;

		$form_vars['plugin_name'] = 'jobs';

		parent::__construct($form_vars);

		//	$this->setFormAction($CONFIG->url.'jobs/search/');

		$this->setTypes('object', 'job');

		$fields = array(
			/**
			 * FILTER FIELDS
			 */
			"keyword" =>
			array(
				'filter_type' => 'keyword',
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('jobs:jobs_filter:label:keyword'),
				),
			),
			"owner" =>
			array(
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'filter_type' => 'owner',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('jobs_ktform:filter:label:owner'),
				),
			),
			"company" =>
			array(
				'filter_type' => 'metadata',
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('jobs_ktform:filter:label:company'),
				),
				'filter_options' => array(
					'operand' => 'LIKE',
				),
			),
			"location" =>
			array(
				'filter_type' => 'metadata',
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('jobs_ktform:filter:label:location'),
				),
				'filter_options' => array(
					'operand' => 'LIKE',
				),
			),
			"tags" =>
			array(
				'filter_type' => 'metadata',
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('jobs_ktform:filter:label:tags'),
				),
				'filter_options' => array(
					'operand' => 'LIKE',
				),
			),
			'job_length' =>
			array(
				'type' => 'radio',
				'input_class' => 'txtFrm txtFrm100',
				'label' => elgg_echo('jobs:jobs:label:job_length'),
				'filter_type' => 'metadata',
				'wrapper_class' => 'ktFormWrapper breakline',
				'container_group' => 'zJobLenght ktG50',
				'default_value' => '',
				'options' => array(
					'options' => array(elgg_echo('jobs:job_length:all') => '') + KtJob::getJobLength(),
				)
			),
			"added" =>
			array(
				'filter_type' => 'metadata',
				'type' => 'added_filter',
				'container_group' => 'zZAddFilter ktG50',
				'wrapper_class' => 'ktFormWrapper breakline',
				'input_class' => 'txtFrm txtFrm100',
				'label' => TRUE,
			),
			'job_category' => array(
				'type' => 'job_category',
				'label' => TRUE,
				'container_group' => 'zzZJobCategory ktG50',
				'input_class' => 'txtFrm txtFrm100',
//				'filter_type' => 'metadata',
				'wrapper_class' => 'ktFormWrapper breakline',
				'options' => array(
					'placeholder' => elgg_echo('obras_ktform:filter:label:job_category'),
					'input_type' => 'checkboxes',
				),
				'filter_options' => array(
//		    'operand' => 'LIKE',
				),
			),

			'job_region' => array(
				'type' => 'job_regions',
				'label' => TRUE,
				'container_group' => 'zZJobCategory ktG50',
				'input_class' => 'txtFrm txtFrm100',
//				'filter_type' => 'metadata',
				'wrapper_class' => 'ktFormWrapper breakline',
				'options' => array(
					'placeholder' => elgg_echo('obras_ktform:filter:label:job_region'),
					'input_type' => 'checkboxes',
				),
				'filter_options' => array(
//		    'operand' => 'LIKE',
				),
			),			
		);



		$has_categories = JobsSettings::getCategories();

		if (empty($has_categories)) {
			unset($fields['job_category']);
		}

		$has_regions = JobsSettings::getCategories(array(), 'jobs_regions');

		if (empty($has_regions)) {
			unset($fields['job_region']);
		}		

		$this->setFields($fields);

		//Add class field
		$fields_count = count($fields);
		$classNumElements = 1;
		if ($fields_count) {
			$classNumElements = floor($fields_count / 2);
		}
		$this->setSubmitButtonClassname("rBtnSrchFrm mTop$classNumElements");
	}

}