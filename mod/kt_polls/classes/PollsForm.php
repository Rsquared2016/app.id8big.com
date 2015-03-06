<?php

/**
 * Polls
 *
 * Class description here or bellow...
 * 
 * @author [author]
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
class PollsForm extends PollsBaseForm {

	public function __construct($form_vars = array()) {

		$form_vars['plugin_name'] = 'kt_polls';
		parent::__construct($form_vars);

		$this->setTypes('object', 'kt_poll');
		
		/**
		 * Poll subtype is if that is a normal poll or just a test
		 * If is a test then add the answer input
		 */
		$poll_context = get_input('poll_context', 'poll_profile');

		$options_extra_class = 'shouldHide';
		$question_type = 'pulldown';
		$question_type_defval = '0';
		$question_type_class = '';
		$question_type_label = TRUE;
		$question_info_text = TRUE;
		
		if ($poll_context == 'poll_profile') {
			$options_extra_class = '';
			$question_type = 'hidden';
			$question_type_defval = 'quiz';
			$question_type_class = 'no';
			$question_type_label = FALSE;
			$question_info_text = elgg_echo('kt_form:kt_polls:info_text:question_options:with_max');
		}
		
		//$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
		//If you have to upload files, uncomment this line
		$this->setFormFileSupport();

		$fields = array(
			'title' => array(
				'type' => 'text',
				'validators' => array(
					'required' => TRUE,
				),
			),
			'video' =>
				array(
					'type' => 'video',
					'input_class' => 'txtFrm txtFrm100',
					'options' => array(
						'video_options' => array(
							'generate_thumb' => FALSE,
						),
					),
					'validators' => array(
						'required' => FALSE,
//						'url' => TRUE,
//						'video' => TRUE,
					),
				),	
			'image' =>
				array(
					'type' => 'image',
					'input_class' => 'txtFrmFile',
					'mimetype' => "web_images",
					//'validators' => array('file' => array('required' => TRUE, 'mimetype' => "web_images")),
                    'options' => array('image_options' => array('access_id' => ACCESS_PUBLIC)),
				),					
			'description' => array(
				'type' => 'longtext',
				'info_text' => TRUE,
			),			
			'question_type' => array(
				'type' => $question_type,
				'options' => array(
					'options_values' => kt_get_poll_types(),
					'internalid' => 'question_type',
				),
				'validators' => array(
					'required' => TRUE,
				),
				 'wrapper_class' => $question_type_class,
				 'default_value' => $question_type_defval,
				'input_class' => 'selectFrm33',
				 'label' => $question_type_label,
			),
			'question_answer' => array(
				'type' => 'text',
				'validators' => array(
					'required' => TRUE,
				),
				'wrapper_class' => 'ktFormWrapper shouldHide poll',
			),
			'question_options' => array(
				'type' => 'plaintext',
				'validators' => array(
					'required' => TRUE,
				),
				'info_text' => $question_info_text,
				'wrapper_class' => "ktFormWrapper {$options_extra_class} quiz",
			),
			'question_right_answer' => array(
				'type' => 'text',
				'validators' => array(
					'required' => TRUE,
					'value_type' => 'integer',
				),
				'wrapper_class' => 'ktFormWrapper bottomLineBreak shouldHide quiz',
				'input_class' => 'txtFrm txtFrm33',
			),
			'poll_context' => array(
				'type' => 'hidden',
				'default_value' => $poll_context,
				'label' => FALSE,
				'wrapper_class' => 'no',
			),
			'container_guid' => array(
				'type' => 'hidden',
				'default_value' => PollsBaseMain::ktform_get_container_guid(),
				'label' => FALSE,
				'wrapper_class' => 'no',
			),	
			'access_id' => array(
				'type' => 'access',
				'default_value' => ACCESS_LOGGED_IN,
			),
		);

		/**
		 * TODO ADD THIS ON THE CONTROLLER, THE INPUT SHOULD BE ALLWAAYYYSSS, DEPENDING ON TYPE
		 */
		$question_type = get_input('question_type', FALSE);
		$polls_quiz_action = get_input('polls_quiz_action', FALSE);

		if (!elgg_is_admin_logged_in()) {
			unset($fields['video']);			
			unset($fields['image']);			
		}
		
		if ($poll_context == 'poll_profile') {
			unset($fields['question_answer']);
			unset($fields['question_right_answer']);
			unset($fields['description']);
			
			if (array_key_exists('video', $fields)) {
				unset($fields['video']);
			}
			
			if (array_key_exists('image', $fields)) {
				unset($fields['image']);
			}
			
			
//			$fields['add_to_profile'] = array(
//				 'type' => 'checkboxes',
//				 'label' => FALSE,
//				 'options' => array(
//						'options' => array(elgg_echo('kt_form:kt_polls:label:add_to_profile') => 'yes'),
//				 ),
//			);
		}
		
		if ($polls_quiz_action) {
			switch ($question_type) {
				case 'poll':
					if (is_array($fields)) {
						if (array_key_exists('question_options', $fields)) {
							unset($fields['question_options']);
						}

						if (array_key_exists('question_right_answer', $fields)) {
							unset($fields['question_right_answer']);
						}
					}

					break;

				case 'quiz':
					if (is_array($fields)) {
						if (array_key_exists('question_answer', $fields)) {
							unset($fields['question_answer']);
						}
					}
					break;

				default:
					if (is_array($fields)) {
						if (array_key_exists('question_answer', $fields)) {
							unset($fields['question_answer']);
						}

						if (array_key_exists('question_options', $fields)) {
							unset($fields['question_options']);
						}

						if (array_key_exists('question_right_answer', $fields)) {
							unset($fields['question_right_answer']);
						}
					}
					break;
			}
		}

		$this->setFields($fields);
	}

}