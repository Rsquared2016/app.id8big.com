<?php

/**
 * userSubtypesForm
 *
 * Class that handle the user subtype registrations
 * 
 * @author Bortoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
class userSubtypesForm extends KtForm {

	public function __construct($form_vars = array()) {
		
		$form_vars['plugin_name'] = 'register';
		parent::__construct($form_vars);
		global $CONFIG;
		//TODO: LIMITAR CUANDO NO ES NECESARIO SUBIR ARCHIVOS O NO ...
		//$this->setFormFileSupport();

		$this->setFormAction($CONFIG->url.'action/register/');

		$user_type = kt_get_user_subtype();
		
		$hide_email = get_input('invite_code_gatekeeper');
		
		$terms_link = elgg_view('output/url', array('href' => $CONFIG->url.'expages/read/terms', 'text' => elgg_echo('terms_of_use'), 'target' => '_blank'));

		$fields = array(
			'name' => array(
				'type' => 'text',
				'validators' => array('required' => TRUE),
				'label' => elgg_echo("register_exteps:label:{$user_type}:name"),
			),
			'lastname' => array(
				'type' => 'text',
				'validators' => array('required' => TRUE),
				'label' => elgg_echo("register_exteps:label:lastname"),
			),
			//TODO: MAKE EMAIL FIELD HIDDEN			
			'email' => array(
				'type' => 'hidden',
				'validators' => array('required' => TRUE),
				'label' => FALSE,
			),						
			'username' => array(
				'type' => 'text',
				'validators' => array('required' => TRUE),
				'label' => elgg_echo("register_exteps:label:username"),
			),
			'password' => array(
				'type' => 'password',
				'validators' => array('required' => TRUE),
				'label' => elgg_echo("register_exteps:label:password"),
			),
			'password2' => array(
				'type' => 'password',
				'validators' => array('required' => TRUE, 'value_filter' => array('exp' => get_input('password'))),
				'label' => elgg_echo("register_exteps:label:password2"),
			),
			'user_type' => array(
				'type' => 'hidden',
				'label' => FALSE,
				'default_value' => $user_type,
			),
			'friend_guid' => array(
				'type' => 'hidden',
				'label' => FALSE,
				'default_value' => get_input('friend_guid'),
			),		
			'invite_code' => array(
				'type' => 'hidden',
				'label' => FALSE,
				'default_value' => get_input('invite_code'),
			),							
			'terms_condition' => array(
				'label' => sprintf(elgg_echo('register_exteps:label:terms_condition'), $terms_link),
				'type' => 'checkboxes',
				'validators' => array('required' => TRUE),
				'options' => array(
					'options' => array(//TODO: AGREGAR TRADUCCION
						sprintf(elgg_echo('register_exteps:label:terms_condition'), $terms_link) => 1,
					),
				),
			),
			'drinking_condition' => array(
				'label' => elgg_echo('register_exteps:label:drinking_condition'),
				'type' => 'checkboxes',
				'validators' => array('required' => TRUE),
				'options' => array(
					'options' => array(//TODO: AGREGAR TRADUCCION
						elgg_echo('register_exteps:label:drinking_condition') => 1,
					),
				),
			),						
		); //End of fields array


		if (empty($hide_email)) {
			$fields['email']['type'] = 'text';
			$fields['email']['label'] = TRUE;
		}
		
		$this->setFields($fields);
		
		if ($open_registration) {
			
		}

		switch ($user_type) {
			case US_BAR;
			case US_COMPANY;
				$this->unsetField(array('lastname', 'drinking_condition'));
			break;
		
		} //endswitch
	}

}
