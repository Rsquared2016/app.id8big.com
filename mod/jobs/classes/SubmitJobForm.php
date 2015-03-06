<?php

/**
 * Job
 *
 * Class description here or bellow...
 * 
 * @author [author]
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
class SubmitJobForm extends KtJobBaseForm {

	public function __construct($form_vars = array()) {

		global $CONFIG;

		$form_vars['plugin_name'] = 'submit_job';
		parent::__construct($form_vars);
		$this->setTypes('object', SUBMIT_JOB_SUBTYPE);

		$this->setFormFileSupport();
		$this->setFormAction($CONFIG->url . 'action/jobs/submit');

//		$attachment_types = job_get_attachment_types(TRUE);

		$fields = array(
			'job_guid' => array(
				'type' => 'hidden',
				'label' => FALSE,
				'default_value' => get_input('job_guid'),
				'wrapper_class' => 'no',
			),		
			'title' => array(
				'type' => 'hidden',
				'label' => FALSE,
				'default_value' => 'attachment',
				'wrapper_class' => 'no',
			),				
//			'attachment_type' => array(
//				'type' => 'pulldown',
//				'options' => array(
//					'options_values' => $attachment_types,
//					'internalid' => 'attachment_type',
//				),
//				'input_class' => 'selectFrm selectFrm100',
//			),
			
			'attachment_file' => array(
				'type' => 'kt_file',
				'input_class' => 'txtFrm txtFrm100',
				'options' => array(
					'file_options' => array('subtype' => SUBMIT_JOB_SUBTYPE),
					
				),
				'wrapper_class' => 'ktFormWrapper shouldHide file',
				
				'validators' => array('file' => array(
					 'required' => FALSE, 
					 'mimetype' => '(application\/pdf)|(application\/msword)|(application\/vnd.openxmlformats-officedocument.wordprocessingml.document)')),
				'info_text' => TRUE,
			),
			
			
			'description' => array(
				'type' => 'plaintext',
            'validators' => array('required' => TRUE),
			),
		//End of fields	
		);

//		if (get_input('action', FALSE) == TRUE) {
//
//			$attachment_type = get_input('attachment_type', 0);
//			
//			
//			if ($attachment_type != 1) {
//				if (array_key_exists('attachment_file', $fields)) {
//				
//					unset($fields['attachment_file']);
//				}
//			}
//		}

		$this->setFields($fields);
	}

}