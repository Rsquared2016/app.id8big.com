<?php

/**
 * GDriveBaseForm
 *
 * This class is kinda an Elgg Model to know how to manage, display, save and more things about the elggobject.
 *
 * @author Diego Gallardo and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
define('GDrive_st_INLINE_GROUP_STRING', 'inline');

/**
 * GDriveBaseForm class
 * 
 * Below an extended class as example
 * @example ../docs/example/classes/KtBlogForm.php
 * 
 * @author Diego Gallardo and German Bortoli
 */
class GDriveBaseForm {

	private static $BUNDLE_NAME = 'gdrive';
	protected $form_vars; //an array of form headers options, like the action, method, etc.
	protected $form_fields; //an array of fieldsets with defaults options for the input.
	protected $rendered_fields; //an array of renedered fieldsets, with label, infotext, etc.
	protected $plugin_name; //the plugin name, this is used to manage the auto-actions generator.
	protected $object; // the entity object that will be stored in the object.
	protected $type; //the type of the object.
	protected $subtype; //the subtype of the object.
	protected $class; //the class name of the object, for example KtBlog.
	protected $errors; //an array of errors.
	protected $session; //the sticked form session, this will take as key, the plugin name.
	protected $has_required_fields; //a flag to know when the form have required fields.
	protected $saver; //the classname of the saver class.
	protected $validator; //the classname of the validator.

	/**
	 * Constructor, form_vars can set the plugin name too
	 * @param type $form_vars
	 */

	public function __construct($form_vars = array()) {
		$this->form_vars = array();
		$this->form_fields = array();
		$this->rendered_fields = array();
		$this->errors = array();
		$this->session = new stdClass();
		$this->has_required_fields = FALSE;


//		$this->setSaver('GDriveBaseSave');

		$this->setValidator('GDriveBaseValidators');

		if (count($form_vars) > 0) {
			$this->setFormVars($form_vars);
			//if we have a plugin name to set, then we make that, otherwise will take the context as plugin name
			//Do not use in automatic mode on actions, because there are no contexts.
			if (array_key_exists('plugin_name', $form_vars)) {
				$this->setPluginName($form_vars['plugin_name']);
			} else {
				$this->setPluginName();
			}
		} else {
			$this->setPluginName();
		}
	}

	/**
	 * Magic method to string, that render the form
	 * @return string
	 */
	public function __toString() {
		return $this->render();
	}

	/**
	 * Set the plugin name, that will be allways setted
	 *
	 * @param type string
	 * @return plugin_name
	 */
	public function setPluginName($plugin_name = FALSE) {
		if ($plugin_name) {
			$this->plugin_name = $plugin_name;
		} else {
			$context = elgg_get_context();

			if ($context) {
				$this->plugin_name = $context;
			} else {
				$this->plugin_name = 'default_plugin';
			}
		}

		return $plugin_name;
	}

	/**
	 * Plugin Name Getter
	 * @return string
	 */
	public function getPluginName() {
		return $this->plugin_name;
	}

	/**
	 * Get the type of the object
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Get the subtype of the object
	 * @return string
	 */
	public function getSubType() {
		return $this->subtype;
	}

	/**
	 * Get the object to be edited
	 * @return ElggEntity
	 */
	public function getObject() {
		$object = $this->object;

		return $object;
	}

	/**
	 * Get the specific field error
	 *
	 * @param string $internalname
	 * @return string
	 */
	public function getError($internalname) {
		return $this->errors[$internalname];
	}

	/**
	 * Get all the form errors
	 * @return array
	 */
	public function getErrors() {
		return $this->errors;
	}

	/**
	 * Get the plugin hook name to add custom fields on the form
	 * This is a way to get the name, so we can know which plugin hook have to register
	 * 
	 * We will return the plugin hook by this way:
	 * 	- If we have a "plugin name" will return "pluginname:fields".
	 *  - If we don´t have "plugin name" will return "type:subtype:fields" or "type:fields"
	 *  - If we don´t have "plugin name" and "type "will return "any:fields"
	 * 
	 * @return string 
	 */
	public function getPluginHookName() {

		$plugin_name = $this->getPluginName();

		$type = $this->getType();
		$subtype = $this->getSubType();

		$plugin_hook_name = array();

		if ($plugin_name) {
			$plugin_hook_name[] = $plugin_name;
		} else {
			if ($type) {
				$plugin_hook_name[] = $type;
			} else {
				$plugin_hook_name[] = 'any';
			}

			if ($subtype) {
				$plugin_hook_name[] = $subtype;
			}
		}

		//Add last fields.
		$plugin_hook_name[] = 'fields';

		$plugin_hook_name = implode(':', $plugin_hook_name);

		return $plugin_hook_name;
	}

	/**
	 * Get a value or metadata for the ElggEntity object.
	 * 
	 * @param any $internalname
	 * @return any
	 */
	public function getObjectValue($internalname) {
		$value = '';

		$object = $this->getObject();

		if ($object) {
			$value = $object->$internalname;
		}

		return $value;
	}

	/**
	 * Gets the form vars, this variable is used for the form header settings
	 *
	 * check the view /default/input/forms for more information
	 * @return array
	 */
	public function getFormVars() {

		if (empty($this->form_vars)) {
			$this->form_vars = $this->setFormVars();
		}
		return $this->form_vars;
	}

	/**
	 * Get all formatted form fields
	 * @return array
	 */
	public function getFormFields() {
		return $this->form_fields;
	}

	/**
	 * Get the Class name of the object, for example, ElggObject
	 *
	 * @return string
	 */
	public function getClass() {
		return $this->class;
	}

	/**
	 * Get the saver classname, used to manage the way that the object is saved.
	 * 	by default it will return GDriveBaseSave string, if none is setted.
	 * 
	 * @return string 
	 */
	public function getSaver() {
		return $this->saver;
	}

	/**
	 * Get the validator classname, used to manage the way that the object is validated.
	 * 	by default will return GDriveBaseValidators string, if none is setted
	 * 
	 * @return string 
	 */
	public function getValidator() {
		return $this->validator;
	}

	/**
	 * Construct the saver object that were setted on setSaver	 
	 * 
	 * @param string $type	the type of the object
	 * @param string $subtype	the subtype of the object
	 * @param string $class the GDriveBaseForm class name
	 * 
	 * @return Instance GDriveBaseSave | FALSE if no success 
	 */
	public function getSaverObj($type, $subtype, $class) {

		$class_name = $this->getSaver();
		$saver = FALSE;

		if (class_exists($class_name)) {
			$saver = new $class_name($type, $subtype, $class);
		}


		return $saver;
	}

	/**
	 * Construct the validator object that were setted on setValidator
	 * 
	 * @return Instance KtFormValidator 
	 */
	public function getValidatorObj() {
		$class_name = $this->getValidator();
		$validator = FALSE;

		if (class_exists($class_name)) {
			$validator = new $class_name();
		}

		return $validator;
	}

	/**
	 * Check if the object is a new entity or not
	 *
	 * @return bool
	 */
	private function __isNewEntity() {
		$object = $this->getObject();

		if ($object) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * Set the type and subtype of the ElggEntity object
	 *
	 * @param string $type
	 * @param string $subtype
	 */
	public function setTypes($type = 'object', $subtype = '') {
		if ($type) {
			$this->type = $type;
		}

		if ($subtype) {
			$this->subtype = $subtype;
		}

		switch ($this->type) {
			case 'group':
				$this->setSaver('GDriveBaseGroupSave');
				break;
			default:
				$this->setSaver('GDriveBaseSave');
				break;
		}

		$this->setClass();
		//aca puede setearse el saver
	}

	/**
	 * Set an error for the form validation
	 *
	 * @param string $internalname
	 * @param string $value
	 * @return string
	 */
	public function setError($internalname, $value) {
		if (!empty($value)) {
			$this->errors[$internalname] = $value;
			return $this->errors[$internalname];
		}
	}

	/**
	 * Set the object on the form, if you set an integer, this should be the guid of the object, if not, you can pass an ElggEntity
	 *
	 * @param ElggEntity|int $object_value
	 * @return ElggEntity|bool
	 *
	 * @throws Exception when the type or subtype if not valid for the form object
	 */
	public function setObject($object_value) {
		$object = FALSE;
		if ($object_value instanceof ElggEntity) {
			$object = $object_value;
		} else {
			$object = get_entity($object_value);
		}

		//If we have setted an object but this have not an object type or subtype, or are not equal than the form object.
		//then wanna mean that something is wrong. we throw an exception.
		if (!$this->__isNewEntity()) {
			if (($object->getSubtype() != $this->getSubType()) || $this->getType() != $object->getType()) {
				throw new GDriveBaseInputException(elgg_echo('gdrive:error:no_equal_subtype_and_type'));
			}
		}

		$this->object = $object;
		return $this->object;
	}

	/**
	 * Set the input fields
	 *
	 * @param array $input_options
	 *
	 * 	'internalname' => 'string'	The internalname of the field
	 *
	 * 	'type' => 'string'			The field type to be setted, egg: longtext, dropdown, text ...
	 *
	 * 	'options' => 'array'		The view field options that recive the view 'input/something.
	 *
	 * 	'default_value' => 'string'	Default value on form ...
	 *
	 * 	'wrapper_class' => 'string'	The container field classname.
	 *
	 * 	'input_class' => 'string'	The container field classname.
	 * 
	 * 	'container_group' => 'string' The grouped value, by default is b because if you want to order first one value before the default
	 *
	 * 	'label' => boolean|'string'	If TRUE will set a label, default value is TRUE, if is a string, will set the string value
	 *
	 * 	'info_text' => boolean|'string'	If TRUE will set an info text, default value is TRUE, if is a string, will set the string value.
	 *
	 * 	'process_as' => string	this will say how to process the input field, for now we have only 'process_as' => 'array' that will convert comma sepparated words to array.
	 * 
	 *  'validators' => array()		Set an array of validators, egg, array('required', 'min_lenght')
	 * 
	 * security_input => bool set the security saving input
	 */
	public function setInput($input_options = array()) {
		$defaults = array(
			 'internalname' => '',
			 'type' => '',
			 'options' => array(), //Elgg view options: Eg: options_values, value, etc.
			 'default_value' => '',
			 'wrapper_class' => '',
			 'input_class' => '',
			 'container_group' => 'b',
			 'label' => TRUE,
			 'info_text' => FALSE,
			 'process_as' => NULL, //the only supported value for now, is 'array'
			 'validators' => array(), // An array of validators, Eg: array('required' => TRUE, 'max_lenght' => 6, 'numeric'),
			 'security_input' => FALSE,
		);


		$input_options = array_merge($defaults, $input_options);

		if (!(array_key_exists('internalname', $input_options) && !empty($input_options['internalname']))) {
			throw new GDriveBaseInputException(elgg_echo('gdrive:error:empty:internalname'));
		}

		if (!(array_key_exists('type', $input_options) && !empty($input_options['type']))) {
			throw new GDriveBaseInputException(elgg_echo('gdrive:error:empty:type'));
		}

		$internalname = $input_options['internalname'];
		$input_options['options']['internalname'] = $internalname;

		//Compares, if TRUE then will auto generate the label, otherwise will set the text that is passed
		if (!empty($input_options['label'])) {
			if (is_bool($input_options['label'])) {
				$input_options['label'] = elgg_echo("gdrive:{$this->getPluginName()}:label:{$input_options['internalname']}");
			} else {
				$input_options['label'] = $input_options['label'];
			}
		}

		//Compares, if TRUE then will auto generate the info_text, otherwise will set the text that is passed
		if ($input_options['info_text']) {
			if (is_bool($input_options['info_text'])) {
				$input_options['info_text'] = elgg_echo("gdrive:{$this->getPluginName()}:info_text:{$input_options['internalname']}");
			} else {
				$input_options['info_text'] = $input_options['info_text'];
			}
		}

		//Default value.
		$default_value = '';
		/* if(array_key_exists('default_value', $input_options)) {
		  $default_value = $input_options['default_value'];
		  } */

		$value = get_input($input_options['internalname'], $default_value, $input_options['security_input']);

		/**
		 * process_as is the way that will process the value, for example, if we have
		 * tags, and you put process_as array, then it will strip tags. 
		 * 
		 * For now is setted array only, should be good, to have more of those types.
		 * 
		 */
		if (isset($value) && !is_null($value)) { //This comparision is correct ?
			if (array_key_exists('process_as', $input_options) && !empty($input_options['process_as'])) {
				if ($input_options['process_as'] == 'array' && !is_array($value)) {
					$value = string_to_tag_array($value);
				}
			}

			$input_options['options']['value'] = $value;
		}


		//Input class is the css classname that will be inside the input field
		if (isset($input_options['input_class'])) {
			$input_class = $input_options['input_class'];
			if (!empty($input_class)) {
				$input_options['options']['class'] = $input_class;
			}
		}

		/**
		 * Set the validators as array. and then check if we have required fields
		 * required fields are used to preview some help text on the form.
		 * 
		 * We have to compare if there is some required file, because this is a different behavior. 
		 */
		if (isset($input_options['validators'])) {
			$validators = $input_options['validators'];
			if (is_array($validators)) {
				if (isset($validators['required']) && $validators['required'] != FALSE) {
					$this->has_required_fields = TRUE;
				} else {
					if (array_key_exists('file', $validators)) {
						if (array_key_exists('required', $validators['file'])) {
							if ($validators['file']['required'] == TRUE) {
								$this->has_required_fields = TRUE;
							}
						}
					}
				} //end else
			}
		}


		//start to build the form inputs, setting values, classname, etc
		return $this->__setField($input_options);
	}

	/**
	 * Set the field on the class and store the value on the session
	 *
	 * @param array $field
	 * @return boolean|array
	 */
	protected function __setField($field = array()) {
		if (!empty($field)) {
			$internalname = $field['internalname'];

			$val = get_input($internalname);

			//FIX
			/**
			 * this fix the form fields remembering when a form field have the same
			 * name of one setted input, then that caused bugs in the action, making the form
			 * to forgive the fields values in the session
			 * 
			 * KTODO: CHECK THIS FIX IN SOME FUTURE
			 */
			$is_action = get_input('action', FALSE);
			if ($is_action) {
				$this->__setSessionField($internalname, $val);
			}
			//endfix

			return $this->form_fields[$internalname] = $field;
		} else {
			return FALSE;
		}
	}

	/**
	 * Set an array of fields, instead use setInput for each field.
	 * 
	 * You can use a plugin hook here to set custom fields in any part.
	 *
	 * @param array $form_fields
	 */
	public function setFields($form_fields = array()) {

		$plugin_hook_name = $this->getPluginHookName();

		$form_fields = elgg_trigger_plugin_hook('gdrive:fields', $plugin_hook_name, NULL, $form_fields);

		if (empty($form_fields)) {
			return FALSE;
		}

		foreach ($form_fields as $internalname => $field) {
			$input = array();

			$input['internalname'] = $internalname;
			$input = array_merge($input, $field);

			$this->setInput($input);
		}

		return $this->getFormFields();
	}

	/**
	 * Set the form variables on the view 'input/form'
	 *
	 * @global stdClass $CONFIG
	 * @param array $form_vars
	 *
	 * 		'body' => '' is the form string body
	 *
	 * 		'method' => 'POST', Is the method of the form, POST or GET
	 *
	 * 		'enctype' => '',  Set an enctype for the form
	 *
	 * 		'action' => '',	 Set an action of the form
	 *
	 * 		'js' => '',	Any JS code
	 *
	 * 		'internalid' => '', any ID of the form
	 *
	 * 		'internalname' => '', some internalname for the form
	 *
	 * 		'disable_security' => FALSE, disable form tokens
	 * 
	 * 		'form_group_labels' => array, for example, array('group_a' => 'This is my label')
	 *
	 * 	@return array
	 */
	public function setFormVars($form_vars = array()) {
		global $CONFIG;
		$defaults = array(
			 'body' => '',
			 'method' => 'POST',
			 'enctype' => '',
			 'action' => '',
			 //We add a custom JS function here, to know when the post is submitted, so we could disable the submit button when is clicked once.	
			 'js' => 'onsubmit="javascript:return gdrive_ktform_process_submit(this);"',
			 'internalid' => '',
			 'internalname' => '',
			 'enctype' => '',
			 'disable_security' => FALSE,
			 'form_group_labels' => array('b' => FALSE),
			 'ajax_support' => FALSE,
		);

		$form_vars = array_merge($defaults, $this->form_vars, $form_vars);
		$custom_rel = GDrive_st_AJAX_REL_ATTR;

		if (isset($form_vars['ajax_support'])) {
			if ($form_vars['ajax_support'] == TRUE) {
				$form_vars['js'] = $form_vars['js'] . "rel='{$custom_rel}'";
			}
		}

		$this->form_vars = $form_vars;
		return $this->form_vars;
	}

	/**
	 * Set the body to the form
	 *
	 * @param string $body
	 * @return string
	 */
	private function setFormBody($body) {

		$options = array(
			 'body' => $body,
		);

		return $this->setFormVars($options);
	}

	/**
	 * Return the subtype or the type of the form save.
	 *
	 * @return string.
	 */
	public function setClass($class = '') {

		$type = $this->getType();

		switch ($type) {
			case 'group':
				$default = 'ElggGroup';
				break;

			default:
				$default = 'ElggObject';
				break;
		}

		//If class not exists, set default elgg object class.
		if (class_exists($class)) {
			$this->class = $class;
		} else {
			$this->class = $default;
		}

		return $this->class;
	}

	/**
	 * Set the form action, if you wish to override the defaults actions
	 *
	 * @param string $action_url
	 * @return string
	 */
	public function setFormAction($action_url) {

		$options = array(
			 'action' => $action_url,
		);

		return $this->setFormVars($options);
	}

	/**
	 * Set the css classname of the container div inside the view input/gdrive_submit.
	 * 
	 * @param type $classname
	 * @return $string 
	 */
	public function setSubmitButtonClassname($classname) {
		$options = array(
			 'submit_classname' => $classname,
		);

		return $this->setFormVars($options);
	}

	/**
	 * This method will add file support for the form, sets 'multipart/form-data' on the form headers
	 *
	 * @return array
	 */
	public function setFormFileSupport() {
		$options = array(
			 'enctype' => 'multipart/form-data',
		);

		return $this->setFormVars($options);
	}

	/** 	
	 * Set Form groups labels, by default the group will be "B"
	 *
	 * 
	 * @param array $labels the key is the group and the value is the label text.
	 * 
	 * 	array('b' => This is my group label text)
	 * 
	 * @return array 
	 */
	public function setFormGroupLabels($labels = array()) {
		$defaults = array(
			 'b' => FALSE,
		);

		$labels = array_merge($defaults, $labels);

		return $this->setFormVars(array('form_group_labels' => $labels));
	}

	/**
	 * Set the saver classname, used to manage the way that the object is saved.
	 * 	
	 *
	 * @param type $saver
	 * @return string | FALSE if no success 
	 */
	public function setSaver($saver) {
		if (empty($saver)) {
			return FALSE;
		}

		$this->saver = $saver;

		return $this->saver;
	}

	/**
	 * Set the validator classname, used to manage the way that the object is validated.
	 * 
	 * @param string $validator
	 * @return string | FALSE
	 */
	public function setValidator($validator) {
		if (empty($validator)) {
			return FALSE;
		}

		$this->validator = $validator;
	}

	/**
	 * Unset a field or fields of the form
	 * @param string|array $field_keys
	 * @return GDriveBaseForm 
	 */
	public function unsetField($field_keys) {
		$form_fields = $this->getFormFields();


		if (is_string($field_keys)) {
			if (array_key_exists($field_keys, $form_fields)) {
				unset($form_fields[$field_keys]);
			}
		}

		if (is_array($field_keys)) {
			foreach ($field_keys as $key) {
				if (array_key_exists($key, $form_fields)) {
					unset($form_fields[$key]);
				}
			}
		}


		$this->form_fields = $form_fields;
		return $this;
	}

	/**
	 * Sets an array of rendered fields
	 *
	 * @param array $rendered_fields
	 * @return array
	 */
	protected function __setRenderedFields($rendered_fields) {
		$this->rendered_fields = $rendered_fields;
		//$this->__clearSession();
		return $this->rendered_fields;
	}

	/**
	 * Gets the array of rendered fields, with values, types, etc, ready to be printed
	 *
	 * @param array $render_options
	 * @return array
	 *
	 * 	_header_ => array('header', 'footer', 'submit', clear_session)
	 */
	public function renderFieldsToArray($render_options = array()) {
		/**
		 * Trigger plugin hook
		 */
		global $CONFIG;

		$form_fields = $this->getFormFields();

		$plugin_hook_name = $this->getPluginHookName();


		$form_vars = $this->getFormVars();

		//Build action url.
		$type = $this->getType();
		$subtype = $this->getSubType();
		$plugin_name = $this->getPluginName();
		$object = $this->getObject();

		//if we have not setted an action on the form, then this will auto generate an action depending on the object status (new|edit)	
		if (empty($form_vars['action'])) {
			//$action = 'actions/plugin_name/sybtype/add|edit';
			$action = "{$CONFIG->url}action/{$plugin_name}/";

			if ($subtype) {
				$action = $action . $subtype . '/';
			} else {
				if ($type) {
					$action = $action . $type . '/';
				}
			}

			if ($subtype || $type) {
				//If we have and object, we are editing.
				if ($object) {
					$action = $action . 'edit/';
				} else {
					$action = $action . 'add/';
				}
			}

			$form_vars['action'] = $action;
		}

		//If we have setted up and object, we suppose thate we are editing and we should add the guid to the action.
		if ($object) {
			$components = array(
				 'guid' => $object->getGUID(),
			);

			$form_vars['action'] = elgg_http_add_url_query_elements($form_vars['action'], $components);
		}
		
		
		$page_owner_entity = elgg_get_page_owner_entity();
		if ($page_owner_entity instanceof ElggObject || $page_owner_entity instanceof ElggGroup || $page_owner_entity instanceof ElggUser) {
			$form_vars['action'] = elgg_http_add_url_query_elements($form_vars['action'], array('container_guid' => $page_owner_entity->getGUID()));
		}


		$plugin_name = $this->getPluginName();

		if (isset($form_vars['internalname']) && !isset($form_vars['name'])) {
			$form_vars['name'] = $form_vars['internalname'];
		}

		//If clear session is TRUE, then it will clear the session, this may be usefull if we want to keep the values on session.	
		$plugin_name_views = self::$BUNDLE_NAME;
		$defaults = array(
			 'header' => elgg_view("{$plugin_name_views}/input/form_header", $form_vars),
			 'footer' => elgg_view("{$plugin_name_views}/input/form_footer", $form_vars),
			 'submit' => FALSE,
			 'clear_session' => TRUE,
			 'ignore_inputs' => FALSE,
			 'ignore_marked_required' => FALSE,
		);

		$render_options = array_merge($defaults, $render_options);
		$render_options['form_group_labels'] = $form_vars['form_group_labels'];

		$submit_text = '';

		$submit_text_elgg = "gdrive:{$plugin_name}:label:submit:send";

		$editing_entity = FALSE;

		if ($render_options['submit']) {
			$submit_text = $render_options['submit'];
		} else {
			if ($this->__isNewEntity()) {
				$submit_text = elgg_echo("$submit_text_elgg");
			} else {
				$editing_entity = TRUE;
				$submit_text = elgg_echo("{$submit_text_elgg}:editing");
			}
		}

		//This is a custom view to add text plus submit button.	
		$render_options['submit'] = elgg_view("{$plugin_name_views}/input/kt_form_submit", array('value' => $submit_text, 'name' => "submit_{$plugin_name}", 'name' => "submit_{$plugin_name}", 'rel' => elgg_echo("{$submit_text_elgg}:loading"), 'has_required_fields' => $this->has_required_fields, 'form_vars' => $form_vars, 'editing_entity' => $editing_entity, 'entity' => $object));

		$rendered_fields = array(
			 '_render_' => $render_options,
		);

		$has_required_fields = FALSE;


		/**
		 * This block of code, try to get the fields values, depending on:
		 *   Session, Object, Input and Default Value.
		 * 
		 * Also set some form views css styles and some an "*" to required fields
		 */
		foreach ($form_fields as $field) {

			$label = $field['label'];

			$value = '';
			//Try to get from session.
			$session_value = $this->__getSessionValue($field['internalname']);

			if ($session_value) {
				$value = $session_value;
			} else {
				//Try to get from input.
				$value = '';
				if (isset($render_options['ignore_inputs']) && $render_options['ignore_inputs'] == FALSE) {
					$value = get_input($field['internalname'], '');
				}
				if ($value == '') {
					//Try to get from object.
					$value = $this->getObjectValue($field['internalname']);

					//Try to get from default value.
					if ($value == '' && isset($field['default_value']) && $field['default_value'] != '') {
						$value = $field['default_value'];
					}

					if ($value == '' && isset($field['options']['value']) && $field['options']['value'] != '') {
						$value = $field['options']['value'];
					}
				}
			}

			if ($value) {
				$field['options']['value'] = $value;
			}

			$field['options']['entity'] = $this->getObject();

			if ($render_options['ignore_marked_required'] == FALSE && !empty($label)) {
				if (!empty($field['validators']) && is_array($field['validators'])) {
					if ($field['validators']['required']) {
						$label = "{$label} <span class='required'>*</span>";
						$has_required_fields = TRUE;
					} else {
						if (array_key_exists('file', $field['validators'])) {
							if (array_key_exists('required', $field['validators']['file'])) {
								if ($field['validators']['file']['required'] == TRUE && $this->__isNewEntity()) {
									$label = "{$label} <span class='required'>*</span>";
									$has_required_fields = TRUE;
								}
							}
						}
					} //end else
				}
			}

			//if($field['internalname']=='title'){
			if ($field['type'] == 'text') {
				if (is_array($field['options'])) {
					if ($field['internalname'] == 'title') {
						$js_max_length_input = 'maxlength=' . GDrive_st_MAX_LENGHT_TITLE;
					} else {
						$js_max_length_input = 'maxlength=' . GDrive_st_MAX_LENGHT_TEXT;
					}
					if (array_key_exists('js', $field['options'])) {
						$field['options']['js'].=$js_max_length_input;
					} else {
						$field['options']['js'] = $js_max_length_input;
					}
				}
			}

			if (!empty($field['options']['internalname']) && empty($field['options']['name'])) {
				$field['options']['name'] = $field['options']['internalname'];
			}

			$rended_field_view = elgg_view("{$plugin_name_views}/input/{$field['type']}", $field['options']);
			if (empty($rended_field_view)) {
				$rended_field_view = elgg_view("input/{$field['type']}", $field['options']);
			}

			$rended_field = array(
				 'field' => $rended_field_view,
				 'label' => $label,
				 'info_text' => $field['info_text'],
				 'container_group' => $field['container_group'],
			);

			$wrapper_class = 'ktFormWrapper';
			if ($field['wrapper_class']) {
				$wrapper_class = $field['wrapper_class'];
			}

			$input_class = 'ktFormInput';
			if ($field['input_class']) {
				$input_class = $field['input_class'];
			}


			$rended_field['wrapper_class'] = $wrapper_class;
			$rended_field['input_class'] = $input_class;

			$rendered_fields[$field['internalname']] = $rended_field;
		}

		if ($render_options['clear_session']) {
			$this->__clearSession();
		}

		return $this->__setRenderedFields($rendered_fields);
	}

	/**
	 * Get the exportable array with label and value
	 * 
	 * This uses the output/{field_type} to render outputs.
	 *
	 * @param array $include_exclude excludes fields to exporable
	 * @param int|ElggEntity $object if you didnt setted an object, then you can do it here
	 * @return array an array with the fields
	 */
	public function getObjectValues($include_exclude = array(), $object = TRUE) {

		if (is_string($include_exclude)) {
			$include_exclude = string_to_tag_array($include_exclude);
		}

		if (empty($include_exclude)) {
			$include_exclude = array();
		}

		if ($object) {
			$object = $this->setObject($object);
		} else {
			$object = $this->getObject();
		}

		$form_fields = $this->getFormFields();

		$exportable_fields = array();
		foreach ($form_fields as $internalname => $field) {
			$internalname = $field['internalname'];
			if ($object) {
				$object_value = $object->$internalname;
			} else {
				$object_value = $form_fields[$internalname]['options']['value'];
			}

			$skip_export = FALSE;

			if ($object_value != '') {
				$type = $field['type'];

				$options = array(
					 'value' => $object_value,
					 'entity' => $object
				);

				$options = array_merge($field['options'], $options);
				$options['name'] = $options['internalname'];

				switch ($type) {
					case 'tags';
						$options['tag_names'] = $internalname;
						break;
					case 'radio';
					case 'dropdown':
					case 'pulldown':
						$options['value'] = GDriveBaseMain::get_values_for_outputs_with_options($options, FALSE);
						break;
					case 'checkboxes':
						$options['value'] = GDriveBaseMain::get_values_for_outputs_with_options($options);
						break;

//					case 'pulldown':
//					case 'dropdown':
//						if (isset($options['options_values']) && $options['options_values'][$options['value']]) {
//							$options['option_key'] = $options['value'];
//							$options['value'] = $options['options_values'][$options['value']];
//						}
//						break;

					case 'keetup_categories':
						if (empty($options['value'])) {
							$skip_export = TRUE;
						}
						break;
				} //endswitch


				$plugin_name_views = self::$BUNDLE_NAME;
				$exportable_field_view = elgg_view("{$plugin_name_views}/output/{$type}", $options);

				if (empty($exportable_field_view)) {
					$exportable_field_view = elgg_view("output/{$type}", $options);
				}

				if ($skip_export == FALSE) {

					$exportable_fields[$internalname] = array(
						 'label' => $field['label'],
						 'value' => $exportable_field_view,
					);
				}
			} //endif
		} //endforeach

		foreach ($include_exclude as $key => $value) {
			if (is_array($value)) {
				switch ($key) {
					case 'exclude':
						foreach ($value as $exclude) {
							if (array_key_exists($exclude, $exportable_fields)) {
								unset($exportable_fields[$exclude]);
							}
						}
						break;
					case 'include':
						foreach ($exportable_fields as $field_key => $field) {
							if (!in_array($field_key, $value)) {
								unset($exportable_fields[$field_key]);
							}
						}
						break;
				}
			} else {
				if (array_key_exists($value, $exportable_fields)) {
					unset($exportable_fields[$value]);
				}
			}
		}


		return $exportable_fields;
	}

	/**
	 * This function retrieve the array of fields grouped and sorted by container_group
	 * 
	 * @param array $render_options an array of options
	 * @return array 
	 */
	public function getOrderedGroupFields($render_options = array()) {

		$fields = $this->renderFieldsToArray($render_options);
		$grouped_fields = array();

		foreach ($fields as $field_key => $field) {
			if ($field_key == '_render_') {
				$grouped_fields['_render_'] = $field;
			} else {
				$grouped_fields[$field['container_group']][$field_key] = $field;
			}
		}


		ksort($grouped_fields);

		return $grouped_fields;
	}

	/**
	 *  Render only one group of fields, egg, a,b,c ...
	 *
	 * @param string $group group name
	 * @return array of form fields
	 */
	public function renderGroupFields($group) {
		//we dont want to clear all the session form, only for the group of fields.	
		$fields = $this->getOrderedGroupFields(array('clear_session' => FALSE));

		if (!array_key_exists($group, $fields)) {
			return FALSE;
		}
		//Clean the session for each value
		foreach ($fields[$group] as $field_key => $field) {
			$this->__clearSessionField($field_key);
		}

		return $fields[$group];
	}

	/**
	 * Render a form grouping the fields
	 *
	 * @param array $render_options: disable_form_wrapper | rendered_fields_only
	 * @param string $before_footer_string
	 * @return type string
	 */
	public function render($render_options = array(), $before_footer_string = '') {
		$rendered_group_fields = $this->getOrderedGroupFields($render_options);

		$body_form_class = GDriveBaseMain::ktform_camelize_string($this->getPluginName(), FALSE);
		$disable_form_wrapper = (array_key_exists('disable_form_wrapper', $render_options) && $render_options['disable_form_wrapper'] == TRUE);
		if ($disable_form_wrapper != TRUE) {
			$body = '<div class="ktFrm ' . $body_form_class . '">';
		}

		$body .= $rendered_group_fields['_render_']['header'];

		$form_group_labels = $rendered_group_fields['_render_']['form_group_labels'];

		if (!is_array($form_group_labels)) {
			$form_group_labels = array();
		}

		$content = '';
		
		$extraClass = '';
		if (elgg_get_plugin_setting('profile_label_above', 'gdrive') == 'yes') {
			$extraClass = ' breakline';
		}
		
		foreach ($rendered_group_fields as $rendered_group => $rendered_fields) {
			if ($rendered_group == '_render_') {
				continue;
			}
			$content .= "<div class='ktFormWrapperGroup {$rendered_group}'>";

			$is_inline = (bool) strstr($rendered_group, GDrive_st_INLINE_GROUP_STRING);
			$title = '';

			if (array_key_exists($rendered_group, $form_group_labels)) {
				if (!empty($form_group_labels[$rendered_group])) {
					if ($is_inline) {
						$title .= "<label>$form_group_labels[$rendered_group]</label>";
					} else {
						$content .= "<h3>$form_group_labels[$rendered_group]</h3>";
					}
				}
			}


			if ($is_inline) {
				$content .= "<div class='ktFormWrapper'>";
				$content .= $title;
				$info_text = '';

				$content .= "<div class='frmField'>";
				foreach ($rendered_fields as $field_key => $field) {
					$content .= "{$field['field']}";

					if (!empty($field['info_text'])) {
						$info_text = "<p class='ktFormP'>{$field['info_text']}</p>";
					}
				}

				$content .= "<div class='clearfloat'>&nbsp;</div> </div> <div class='clearfloat'>&nbsp;</div>";

				if ($info_text) {
					$content .= $info_text;
				}


				$content .= "</div>";
			} else {

				foreach ($rendered_fields as $field_key => $field) {
					$content .= "<div class='{$field['wrapper_class']}$extraClass'>";
					if (!empty($field['label'])) {
						$content .= "<label>{$field['label']}</label>";
					}

					//KTODO: agregué un clear al final de cada div (después del input o lo que haya), y un wrappper para el field/textarea o lo que haya... revisar si está correcto esto, porque tal vez va en otro lado
					//KTODO: en el caso de que haya varios inputs en frmField (por ejemplo si son de los que ocupan un 50%, 33%, etc.), el último item tiene que tener la clase nmRig, así no tiene margen a la derecha y no se va para aba
					$content .= "
									<div class='frmField'>
										{$field['field']}
										<div class='clearfloat'>&nbsp;</div>
									</div>";
					$content .= '<div class="clearfloat">&nbsp;</div>';

					if (!empty($field['info_text'])) {
						$content .= "<p class='ktFormP'>{$field['info_text']}</p>";
					}
					$content .= "</div>";
				}
			}

			$content .= '<div class="clearfloat">&nbsp;</div>';
			$content .= "</div>";
		}

		if (array_key_exists('rendered_fields_only', $render_options) && $render_options['rendered_fields_only'] == TRUE) {
			return $content;
		}
		//Add content.
		$body .= $content;

		if (!empty($before_footer_string)) {
			$body .= $before_footer_string;
		}

		$body .= $rendered_group_fields['_render_']['submit'];

		$body .= $rendered_group_fields['_render_']['footer'];
		if ($disable_form_wrapper != TRUE) {
			$body .= '</div>';
		}
		return $body;
	}

	/**
	 * @deprecated now we use the default render by group
	 * Renders the form to a string
	 *
	 *
	 * @param  array $render_options
	 * @param string $before_footer_string  will set a string inside the form
	 * @return string
	 */
	public function __render($render_options = array(), $before_footer_string = '') {
		$rendered_fields = $this->renderFieldsToArray($render_options);

		$body = '';
		$body .= $rendered_fields['_render_']['header'];

		foreach ($rendered_fields as $field_key => $field) {

			$body .= "<div class='{$field['wrapper_class']}'>";

			if (!empty($field['label'])) {
				$body .= "<label>{$field['label']}</label>";
			}

			$body .= "
					<div class='frmField'>
						{$field['field']}
						<div class='clearfloat'>&nbsp;</div>
					</div>";
			$body .= '<div class="clearfloat">&nbsp;</div>';

			if (!empty($field['info_text'])) {
				$body .= "<p class='ktFormP'>{$field['info_text']}</p>";
			}
			$body .= "</div>";
		}



		if (!empty($before_footer_string)) {
			$body .= $before_footer_string;
		}

		$body .= $rendered_fields['_render_']['submit'];

		$body .= $rendered_fields['_render_']['footer'];

		return $body;
	}

	/**
	 * Save and validate the object
	 *
	 * @param boolean $register_errors, if true it will register the errors with the elgg core system (register_error function)
	 * else you could use the getErrors method to retrieve all the errors in the action
	 *
	 * @param array $override_data, an array to override the save method, so we can store pre processed values
	 *
	 * @return boolean|guid
	 */
	public function save($register_errors = TRUE, $override_data = array()) {

		$form_fields = $this->getFormFields();

		$success = $this->validate($register_errors);

		$type = $this->getType();
		$subtype = $this->getSubType();
		$class = $this->getClass();

		if ($success != FALSE && ($type || $subtype)) {

			$guid = $this->getObject();
			//$saver = new GDriveBaseSave($type, $subtype, $class);
			$saver = $this->getSaverObj($type, $subtype, $class);
			if ($saver == FALSE) {
				return FALSE;
			}

			$form_fields = $this->getFormFields();


//			$data_defaults = array(
//				'guid',
//				'title',
//				'description',
//				'container_guid',
//				'access_id',
//				'owner_guid',
//			);



			$data = array();
			$entity_options = array();

			$guid = get_input('guid');

			switch ($type) {
				case 'group':
					if (array_key_exists('name', $form_fields)) {
						$data['name'] = $form_fields['name']['options']['value'];
					}
					$data_defaults = array(
						 'guid',
						 'name',
						 'description',
						 'container_guid',
						 'access_id',
						 'owner_guid',
					);
					break;

				default:
					if (array_key_exists('title', $form_fields)) {
						$data['title'] = $form_fields['title']['options']['value'];
					}
					$data_defaults = array(
						 'guid',
						 'title',
						 'description',
						 'container_guid',
						 'access_id',
						 'owner_guid',
					);
					break;
			}
//			if (array_key_exists('title', $form_fields)) {
//				$data['title'] = $form_fields['title']['options']['value'];
//			}

			if (array_key_exists('description', $form_fields)) {
				$data['description'] = $form_fields['description']['options']['value'];
			}

			if (array_key_exists('container_guid', $form_fields)) {
				$entity_options['container_guid'] = $form_fields['container_guid']['options']['value'];
			}

			if (array_key_exists('access_id', $form_fields)) {
				$entity_options['access_id'] = $form_fields['access_id']['options']['value'];
			}

			if (array_key_exists('owner_guid', $form_fields)) {
				$entity_options['owner_guid'] = $form_fields['owner_guid']['options']['value'];
				if (empty($entity_options['owner_guid'])) {
					$entity_options['owner_guid'] = elgg_get_logged_in_user_guid();
				}
			}

			foreach ($form_fields as $key => $field) {
				if (in_array($key, $data_defaults)) {
					unset($form_fields[$key]);
				} else {
					switch ($field['type']) {
						default:
							$data['metadata'][$key] = $field['options']['value'];
							break;
					} //endswitch
				}
			}


			if (isset($override_data['guid'])) {
				if (!empty($override_data['guid'])) {
					$guid = $override_data['guid'];
					unset($override_data['guid']);
				}
			}

			if (array_key_exists('metadata', $override_data) && is_array($override_data['metadata'])) {
				$data['metadata'] = array_merge($data['metadata'], $override_data['metadata']);
			}

			if (array_key_exists('entity_options', $override_data) && is_array($override_data['entity_options'])) {
				$entity_options = array_merge($entity_options, $override_data['entity_options']);
			}

			if (array_key_exists('entity_data', $override_data) && is_array($override_data['entity_data'])) {
				$data = array_merge($data, $override_data['entity_data']);
			}


			$saved = $saver->save($guid, $data, $entity_options);
			if ($saved) {
				$this->__clearSession();
				return $saved;
			}
		}

		return $success;
	}

	/**
	 * Validate the form model.
	 * 
	 * @param array $register_errors if register errors is enabled, the function will automatically register errors, in elgg system
	 * @return type 
	 */
	public function validate($register_errors = FALSE) {
		$form_fields = $this->getFormFields();

		$validator = $this->getValidatorObj();

		if ($validator == FALSE) {
			$this->setError('validator', "The validator called {$this->getValidator()} NOT EXISTS");
			return FALSE;
		}

		$entity_guid = (int) get_input('guid', FALSE);
		$errors = FALSE;

		foreach ($form_fields as $field) {
			if (!empty($field['validators'])) {
				$label = $field['label'];

				$value = $field['options']['value'];


				if (array_key_exists('file', $field['validators'])) {
					if (array_key_exists('required', $field['validators']['file'])) {
						if ($field['validators']['file']['required'] == TRUE && !empty($entity_guid)) {
							unset($field['validators']['file']['required']);
						}
					}
				}

				$validator->setFieldValidations($label, $field['internalname'], $value, $field['validators']);

				if (!$validator->validate()) {
					$error_msg = $validator->getError($field['internalname']);

					if ($register_errors == TRUE) {
						register_error($error_msg);
					}

					$this->setError($field['internalname'], $error_msg);
					$errors = TRUE;
				}
			}
		}

		if ($errors) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * SESSION STORAGES
	 */

	/**
	 * 	Set a session value
	 * 
	 * @param string $internalname
	 * @param any $value
	 * @return stdClass 
	 */
	private function __setSessionField($internalname, $value) {

		$this->session->$internalname = $value;
		if ($value != '') {
			$_SESSION['gdrive'][$this->getPluginName()] = $this->session;
		}

		return $this->session;
	}

	/**
	 *
	 * Clears only one value on the session.
	 * 
	 * @param string $internalname
	 * @return stdClass
	 */
	private function __clearSessionField($internalname) {
		$this->session->$internalname = NULL;
		$_SESSION['gdrive'][$this->getPluginName()] = $this->session;

		return $this->session;
	}

	/**
	 * Get one field value on the session.
	 * 
	 * @param string $internalname
	 * @return value 
	 */
	private function __getSessionValue($internalname) {
		$session = $_SESSION['gdrive'][$this->getPluginName()];

		if ($session instanceof stdClass) {
			return $session->$internalname;
		} else {
			return FALSE;
		}
	}

	/**
	 * Retrieve all the data in the session, stored by the form
	 * @return type 
	 */
	private function __getSessions() {
		return $_SESSION['gdrive'][$this->getPluginName()];
	}

	/**
	 * Clears the session stored by the form.
	 */
	public function __clearSession() {
		//Force to destroy the session
		$_SESSION['gdrive'][$this->getPluginName()] = NULL;
		unset($_SESSION['gdrive'][$this->getPluginName()]);
	}

}