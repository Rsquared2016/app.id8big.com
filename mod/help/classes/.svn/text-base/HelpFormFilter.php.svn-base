<?php

class HelpFormFilter extends HelpBaseFilter {

	public function __construct($form_vars = array()) {
		global $CONFIG;

		$form_vars['plugin_name'] = 'help';

		parent::__construct($form_vars);

		//	$this->setFormAction($CONFIG->url.'help/search/');

		$this->setTypes('object', 'help');

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
					'placeholder' => elgg_echo('help_ktform:filter:label:keyword'),
				),
			),
			'category_id' => array(
				'label' => FALSE,
				'type' => 'keetup_categories',
				'filter_type' => 'keetup_categories',
				'container_group' => 'ktG50 right',
				'input_class' => 'txtFrm txtFrm100',
				'options' => array(
					'size' => 1,
					'show_subcategories' => FALSE,
				),
			),
			
			/*"owner" => array(
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				'filter_type' => 'owner',
				'label' => FALSE,
				'options' => array(
					'placeholder' => elgg_echo('help_ktform:filter:label:owner'),
				),
			),*/
//			'tags' => array(
//				'type' => 'text',
//				'label' => FALSE,
//				'container_group' => 'ktG50',
//				'filter_type' => 'metadata',
//				 'options' => array(
//					'placeholder' => elgg_echo('help_ktform:filter:label:tags'),
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
		
		//Filter content based on user subtype.
		//User subtype content.
		$user_content_type = help_get_user_types_content(FALSE, TRUE);
		if($user_content_type) {
			$fields['user_content_type'] = array(
					'type' => 'pulldown',
					'options' => array(
						'options_values' => $user_content_type
					),
					'filter_type' => 'metadata', //Search by geolocation
					'container_group' => 'ktG50',
					'input_class' => 'txtFrm txtFrm100',
			);
		}		
		

		$this->setFields($fields);
		$this->unsetField('owner');

		//Add class field
		$fields_count = count($fields);
		$classNumElements = 1;
		if ($fields_count) {
			$classNumElements = floor($fields_count / 2);
		}
		$this->setSubmitButtonClassname("rBtnSrchFrm mTop$classNumElements");
	}

}