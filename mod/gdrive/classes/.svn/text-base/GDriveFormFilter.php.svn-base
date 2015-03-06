<?php

class GDriveFormFilter extends GDriveBaseFilter {

	public function __construct($form_vars = array()) {
		global $CONFIG;

		$form_vars['plugin_name'] = 'gdrive';

		parent::__construct($form_vars);

		//	$this->setFormAction($CONFIG->url.'gdrive/search/');

		$this->setTypes('object', 'gdrive');

		$fields = array(
			/**
			 * FILTER FIELDS
			 */
			"keyword" => array(
				'filter_type' => 'keyword',
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('gdrive_ktform:filter:label:keyword'),
				),
			),
			"owner" => array(
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'filter_type' => 'owner',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('gdrive_ktform:filter:label:owner'),
				),
			),
//			'tags' => array(
//				'type' => 'text',
//				'label' => FALSE,
//				'container_group' => 'ktG50',
//				'filter_type' => 'metadata',
//				 'options' => array(
//					'placeholder' => elgg_echo('gdrive_ktform:filter:label:tags'),
//				),
//				'filter_options' => array(
//					'operand' => 'LIKE',
//				),
//			),
//			"option_1" => array(
//				'filter_type' => 'text',
//				'type' => 'dropdown',
//				'container_group' => 'ktG50',
//				'input_class' => 'txtFrm txtFrm100',
//				'label' => FALSE,
//				'options' => array(
//					'options_values' => array('0' => "Seleccione una OP1", '1' => 'OP 1.1', '2' => 'OP 1.2'),
//				),
//			),
//			"option_2" => array(
//				'type' => 'dropdown',
//				'container_group' => 'ktG50',
//				'input_class' => 'txtFrm txtFrm100',
//				'filter_type' => 'owner',
//				'label' => FALSE,
//				'options' => array(
//					'options_values' => array('0' => "Seleccione una OP2", '1' => 'OP 2.1', '2' => 'OP 2.2'),
//				),
//			),
		);

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