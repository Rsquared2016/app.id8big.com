<?php
/**
 * NewsBaseValidators
 *
 * Set of methods to validate inputs values of our form model.
 *
 * @author BOrtoli German and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

class NewsBaseValidators {
	protected $field_label = ''; //The field label, so it is used to throws clear exceptions
	protected $field_value = ''; //The value you want to validate.
	protected $field_internalname = '';
	protected $validators = array(); //The validations you want to pass the value.
	
	protected $errors = array();
	
	public function __construct() {
		//Do nothing.
	}
	
	/*
	 * Getters and Setters.
	 * */
	/**
	 * Set the input data to validate.
	 * @param string $field_label
	 * @param mixed values $field_value
	 * @param array $validators
	 * 
	 */
	public function setFieldValidations($field_label, $field_internalname, $field_value, $validators = array()) {
		$default = array(
			//Posible validations options.
			'required' => FALSE,
			'min_length' => '', //Should be a number like: 100
			'max_length' => '', //Should be a number like: 200
			'value_type' => '', //integer, float, percent.
			'value_filter' => '', /*array(
										'operator' => '=', //= , !=, in
										'values' => '' //string or number (==, !=), array (in),
									) */
			'file' => '', //array('required', 'mimetype', 'max_size')
			'date_range' => '',
			'period_range' => '',
			'video' => '', //This validates for a valid video url.
			'url' => '', //This validates for a valid url.
		);
		
		$validators = array_merge($default, $validators);

		//Set the info.
		$this->field_label = $field_label;
		$this->field_value = $field_value;
		$this->validators = $validators;
		$this->field_internalname = $field_internalname;
	}
	
	/**
	 * Get the current validators.
	 * 
	 * return array.
	 */
	public function getValidators() {
		return $this->validators;
	}
	
	/**
	 * Get the current field label.
	 * 
	 * return string.
	 */
	public function getFieldLabel() {
		return $this->field_label;
	}

	/**
	 * Get the current field value.
	 * 
	 * return mixed values.
	 */
	public function getFieldValue() {
		return $this->field_value;
	}
	
	/**
	 * Get Internalname Field
	 * 
	 * @return string
	 */
	
	public function getFIeldInternalname() {
		return $this->field_internalname;
	}
	
	
	/**
	 * Get single error depending on the field internalname
	 * 
	 * @param string $internalname
	 * @return string
	 */	
	
	public function getError($internalname) {
		$error = $this->errors[$internalname];
		if (!empty($error)) {
			return $error;
		} else {
			return FALSE;
		}
	}

	/**
	 * Get an array of errors
	 * 
	 * @return array
	 */
	public function getErrors()  {
		return $this->errors;
	}
	
	/**
	 * Set a single error
	 * 
	 * @param string $internalname the internalname of the field
	 * @param mixed $value the value of the field
	 * @return string error 
	 */
	public function setError($internalname, $value) {
		if (!empty($value)) {
			$this->errors[$internalname] = $value;
			return $this->errors[$internalname];
		}
	}
	
	
	/**
	 * Validate the current input field based on the value and validators.
	 * 
	 * @throws Exception
	 * 
	 * return boolean
	 */
	public function validate() {
		$validators = $this->getValidators();
		$field_label = $this->getFieldLabel();
		$field_value = $this->getFieldValue();
		$field_internalname = $this->field_internalname;
		
		foreach($validators as $validation => $option) {
			$function = 'validate'.ucfirst($validation);
			if($option) {
			 	if (is_callable(array($this, $function))) {
					$result = $this->$function($field_value, $option, $field_label, $field_internalname);
					
					if(!$result['status']) {
						if ($validation == 'required' || $validation == 'file' || $validation == 'date_range' || $validation == 'period_range' || $validation == 'non_empty_array') {
							
							$error_msg = elgg_echo('news_ktform:validation:required:not:valid:value');
							$error = sprintf($error_msg,
								$field_label,
								$result['message']
							);
						} else {
							$error_msg = elgg_echo('news_ktform:validation:not:valid:value');
							
							$error_value = $field_value;
							if (is_array($error_value)) {
								$error_value = implode(', ', $error_value);
							}
							
							$error = sprintf($error_msg,
								$field_label,
								$error_value, 
								$result['message']
							);
							
						}
						
						//throw new NewsBaseValidationException($error);
						
						$this->setError($field_internalname, $error);
					}
				} else {
					$error = sprintf(elgg_echo('news_ktform:validation:undefined:validation'),
						$validation,
						$field_label
					);
					//throw new NewsBaseValidationException($error);
					$this->setError($field_internalname, $error);
				}
			}
		}
		
		$errors = $this->getErrors();
		if (count($errors) > 0) {
			return FALSE;
		}
		
		return TRUE;
	}
	
	/*
	 * Validations functions section
	 * 
	 * */

	/**
	 * Validate a required value.
	 * @param mixed value $value
	 * @param boolean $required
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateRequired($value, $required = FALSE, $field_label = '') {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		if($required && empty($value)) {
			$result['status'] = false;
			$result['message'] = elgg_echo('news_ktform:validation:required:text');
		}
		
		return $result;
	}

	/**
	 * Validate a min length value.
	 * 
	 * @param mixed value $value
	 * @param integer $length
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateMin_length($value, $length = 0, $field_label = '') {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		if($value && $length && strlen($value) < $length) {
			$result['status'] = false;
			$result['message'] = sprintf(elgg_echo('news_ktform:validation:min_length:text'), $length);
		}
		
		return $result;
	}
	
	/**
	 * Validate a max length value.
	 * 
	 * @param mixed value $value
	 * @param integer $length
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateMax_length($value, $length = 0, $field_label = '') {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		if($value && $length && strlen($value) > $length) {
			$result['status'] = false;
			$result['message'] = sprintf(elgg_echo('news_ktform:validation:max_length:text'), $length);
		}
		
		return $result;
	}
		
	/**
	 * Validate a value type. Posible value types: integer, float, percent.
	 * 
	 * @param mixed value $value
	 * @param string $type
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateValue_type($value, $type = '', $field_label = '') {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		if($value && $type) {
			$sucess = true;
			switch($type) {
				case 'integer':
						//Validate > 0
						if($value == strval(intval($value)) && $value > 0) {
							$sucess = true;
						} else {
							$sucess = false;
						}
					break;
					
				case 'float':
						if($value == strval(floatval($value)) && $value > 0) {
							$sucess = true;
						} else {
							$sucess = false;
						}
					
					break;
					
				case 'percent':
						//Validate first integer.
						$top_value = 100;
						$bottom_value = 0;

						if($value == strval(floatval($value)) && $value > $bottom_value && $value < $top_value) {
							$sucess = true;
						} else {
							$sucess = false;
						}
						
						
					break;
					
				default:
					$error = sprintf(elgg_echo('news_ktform:validation:value_type:text'), $type, $field_label);
					throw new NewsBaseValidationException($error);					 

			}
			
			if(!$sucess) {
				$result['status'] = false;
				$result['message'] = sprintf(elgg_echo('news_ktform:validation:value_type:text'), $type);
			}
		}
		
		return $result;
	}
	
	/**
	 * Validate a value based on a filter.
	 * 	This is used to check the current value match another value with:
	 * 		* Logic operators: == , !=
	 * 		* Range operators: in  
	 * 		* Expresions: eg: '10 < [input_value] < 15'
	 * 
	 * 
	 * @param mixed value $value
	 * @param array $type
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateValue_filter($value, $option = array(), $field_label = '') {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);

		$default = array(
			'operator' => '', //= , !=, in
			'values' => '', //string or number (==, !=), array (in),
			'exp' => '' , //'exp' => '10 < [input_value] < 15' //Eval(exp); Contemplar arreglos. value 1 > value 2 && value3 > 10 		
		);
		
		$option = array_merge($default, $option);
		
		//Validate operators.						
		$posible_operators = array(
			'=', '!=', 'in',
		);
		
		//Set default operator, if the operator if not in posibles operator.
		if($option['operator'] && in_array($option['operator'], $posible_operators) === FALSE) {
			$option['operator'] = '=';
		}
		
		$status = TRUE;
		//KTODO: Validations: Chequear mensajes de error de value filter.
		$message = '';
		if($value && is_array($option)) {
			//First try to evaluate an exp.
			if($option['exp']) {
				
				if (is_array($value)) {
					foreach($value as $to_match_value) {
						if (!preg_match("/{$option['exp']}/", $to_match_value)) {
							$status = FALSE;
							break;
						}
					}
				} else {
					$status = preg_match("/{$option['exp']}/", $value);
				}
				
				if (!$status) {
					$message = sprintf(elgg_echo('news_ktform:validation:value_filter:text'), $option['exp']);
				}
				
			} else if ($option['operator'] && $option['values']) {
				if($option['operator'] == 'in') {
					if(!is_array($option['values'])) {
						$option['values'] = array($option['values']);
					}
					
					if(in_array($value, $option['values']) === FALSE) {
						$status = false;
						$message = sprintf(elgg_echo('news_ktform:validation:value_filter:text:in'), $evaluate);
					}
					
				} else {
					$evaluate = "$value {$option['operator']} {$option['values']}"; 
					if($status = !eval($evaluate)) {
						$message = sprintf(elgg_echo('news_ktform:validation:value_filter:text:operand'),
									$option['operator'],
									$option['values']
									);
					}
				}
			}
			
			$result['status'] = $status;
			$result['message'] = $message;
		}
		
		return $result;
	}
	
	/**
	 * Validate a required value.
	 * 
	 * @param mixed value $value
	 * @param boolean $required
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateFile($value, $options, $field_label = '', $internalname) {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);

		$defaults = array(
			'required' => FALSE,
			'mimetype' => NULL,
			'max_size' => 0,
		);

		$web_images_types = array(
			'image/jpeg',
			'image/pjpeg',
			'image/png',
			'image/x-png',
			'image/gif',
		);

		/**
		 * Minimal validation
		 */
		if (!is_array($options)) {
			if (is_bool($options)) {
				$options = array('required' => $options);
			} else {
				$options = array('required' => TRUE);
			}
		}

		$options = array_merge($defaults, $options);
		
		$success = TRUE;


		/**
		 *  FILES RETURNS
		 * 
		 * [name] => image_name.png
		  [type] => image/png
		  [tmp_name] => /some/directory/tmpfile
		  [error] => 0
		  [size] => xxxXXX
		 * 
		 */
		$file = NULL;
		if (array_key_exists($internalname, $_FILES)) {
			$file = $_FILES[$internalname];
		}

		if ($options['required'] == TRUE) {
			
			if (empty($file) || empty($file['name'])) {
				$result['status'] = false;
				$result['message'] = elgg_echo('news_ktform:validation:required:text');
				return $result;
			}
		}

		if (!empty($options['mimetype']) && !empty($file['type'])) {
			
			$success_mime = TRUE;
			/**
			 * Simple image validation alias for web images
			 */
			if ($options['mimetype'] == 'web_images') {
				if (!in_array($file['type'], $web_images_types)) {
					$success_mime = FALSE;
				}
			} else {
				$validation_result = $this->validateValue_filter($file['type'], array('exp' => $options['mimetype']), $field_label);

				if ($validation_result['status'] == FALSE) {
					$success_mime = FALSE;
				}
				
			}
			
			if ($success_mime == FALSE) {
				$result['status'] = false;
				$result['message'] = elgg_echo('news_ktform:validation:file:mimetype');
				return $result;
			}
		}
		
		if (!empty($options['max_size'])) {
			if (in_array('size', $file)) {
				if ($file['size'] > $options['max_size']) {
					$result['status'] = false;
					$result['message'] = elgg_echo('news_ktform:validation:file:maxfilesize');
					
					return $result;					
				}
			}
		}


		
		return $result;
	}
	
	public function validateDate_range($value, $options, $field_label = '', $internalname) {
		
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		$defaults = array(
			'from' => array(
				'internalname' => 'calendar_start',
			),
			'to' => array(
				'internalname' => 'calendar_end',
			),
		);
		
		$options = array_merge($defaults, $options);
		
		$options['from']['value'] = get_input($options['from']['internalname'], FALSE);
		$options['to']['value'] = get_input($options['to']['internalname'], FALSE);

		$current_date = NewsBaseMain::ktform_get_default_dates();
		$valid_range = FALSE;
		
		if (is_numeric($options['from']['value']) && strlen($options['from']['value']) >= 13) {
			$options['from']['value'] = $options['from']['value'] / 1000;
		}

		if (is_numeric($options['to']['value']) && strlen($options['to']['value']) >= 13) {
			$options['to']['value'] = $options['to']['value'] / 1000;
		}		
		
		if (($options['from']['value'] >= $current_date['calendar_start']) && ($options['to']['value'] >= $options['from']['value'])) {
			$valid_range = TRUE;
		}
		
		if ($valid_range == FALSE) {
			$result['status'] = false;
			$error = elgg_echo('news_ktform:validate:date_range:error');
			$result['message'] = $error;
			return $result;
		} 
		
		return $result;
	}
	
	public function validatePeriod_range($value, $options, $field_label = '', $internalname) {
		
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		$fields_required = array(
		    'month_from' => TRUE,
		    'year_from' => TRUE,
		    'month_to' => TRUE,
		    'year_to' => TRUE,
		);
		
		$period_valid_fields = array(
		    'month_min' => 1,
		    'month_max' => 12,
		    'year_min' => 1900,
		    'year_max' => date('Y'),
		);
		
		$defaults = array(
			//Structure of period range
			/*'month_from' => '',
			'year_from' => '',
			'month_to' => '',
			'year_to' => '',*/
			
			'period_range' => array(
				'internalname' => 'period',
			),
			'currently_now' => array(
				'internalname' => 'currently_now',
			),
			'validate_month' => TRUE,
		);
		
		$options = array_merge($defaults, $options);
		
		$period_range = get_input($options['period_range']['internalname'], FALSE);
		$currently_now = get_input($options['currently_now']['internalname'], FALSE);
		$validate_month = $options['validate_month'];

		if(isset($currently_now[0]) && $currently_now[0]) {
		    unset($fields_required['month_to']);
		    unset($fields_required['year_to']);
		    unset($period_range['month_to']);
		    unset($period_range['year_to']);
		}
		else {
			if (empty($period_range['month_to']) && empty($period_range['year_to'])) {
				$period_range['month_to'] = date('n');
				$period_range['year_to'] = date('Y');
				set_input($options['period_range']['internalname'], $period_range);
			}
		}
		
		if(!$validate_month) {
		    unset($fields_required['month_from']);
		    unset($fields_required['month_to']);
		    unset($period_range['month_from']);
		    unset($period_range['month_to']);
		}
		
		$valid_range_required = FALSE;
		$valid_range = FALSE;
		
		//Validate required fields.
		foreach($fields_required as $key_name => $validate) {
		    if(array_key_exists($key_name, $period_range) && $period_range[$key_name]) {
			$valid_range_required = TRUE;
		    } else {
			$valid_range_required = FALSE;
			break;
		    }
		}
		
		$error_custom = '';
		//Validate if range from is minor to range to.
		if($valid_range_required) {
		    $valid_min_date = mktime(0, 0, 0, $period_valid_fields['month_min'], 1, $period_valid_fields['year_min']);
		    $valid_max_date = mktime(0, 0, 0, $period_valid_fields['month_max']+1, 0, $period_valid_fields['year_max']);
		    
		    $month_from = ($period_range['month_from'])? $period_range['month_from'] : 1;
		    $year_from = $period_range['year_from'];
		    $month_to = ($period_range['month_to'])? $period_range['month_to'] : date('n');
		    $year_to = ($period_range['year_to'])? $period_range['year_to'] : $period_valid_fields['year_max'];
		    
		    $date_range_min = mktime(0, 0, 0, $month_from, 1, $year_from);
		    $date_range_max = mktime(0, 0, 0, $month_to, 1, $year_to);

		    // $valid_min_date <= $date_range_min <= $date_range_max <= $valid_max_date
		    if($date_range_min >= $valid_min_date && 
			    $date_range_max >= $date_range_min && 
			    $valid_max_date >= $date_range_max) {
			
			$valid_range = TRUE;
		    }
		    
		    if(!$valid_range) {
			$error_custom .= sprintf(elgg_echo('news_ktform:validate:period_range:error:date'), 
				date('F Y', $valid_min_date), 
				date('F Y', $valid_max_date));
		    }
		    /*foreach($fields_required as $key_name => $validate) {
			switch($key_name) {
			    case 'month_from':
			    case 'month_to':
				    if($period_range[$key_name] >= $period_valid_fields['month_min'] && 
					    $period_range[$key_name]<= $period_valid_fields['month_max']) {
					$valid_range = TRUE;
				    } else {
					$valid_range = FALSE;
					$error_custom .= sprintf(elgg_echo('news_ktform:validate:period_range:error:month'), $period_valid_fields['month_min'], $period_valid_fields['month_max']);
				    }
				break;
			    case 'year_from':
			    case 'year_to':
				    if($period_range[$key_name] >= $period_valid_fields['year_min'] &&
					    $period_range[$key_name]<= $period_valid_fields['year_max']) {
					$valid_range = TRUE;
				    } else {
					$valid_range = FALSE;
					$error_custom = sprintf(elgg_echo('news_ktform:validate:period_range:error:year'), $period_valid_fields['year_min'], $period_valid_fields['year_max']);
				    }

				break;
			}
			//If not valid exit.
			if(!$valid_range) {
			    break;
			}
		    }*/
		    
		}
		
		//If is invalid with some fields, or the dates are invalid.
		if (!$valid_range_required || !$valid_range) {
			$result['status'] = false;
			$error = elgg_echo('news_ktform:validate:period_range:error') . $error_custom;
			$result['message'] = $error;
			return $result;
		} 
		
		return $result;
	}	
	
	/**
	 * Validate a required value.
	 * @param mixed value $value
	 * @param boolean $required
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateUrl($value, $option, $field_label, $field_internalname) {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		if(!filter_var($value, FILTER_VALIDATE_URL)) {
			$result['status'] = FALSE;
			$result['message'] = elgg_echo('news_ktform:validation:invalid:url');
		}
		
		return $result;
	}	
	
	/**
	 * Validate a required value.
	 * @param mixed value $value
	 * @param boolean $required
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateVideo($value, $option, $field_label, $field_internalname) {
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		if(is_callable(array('NewsBaseUrlFeed', 'validateUrl'))) {
			$urlFeed = new NewsBaseUrlFeed();
			
			$type = $urlFeed->validateUrl($value);
			if(!$type) {
				$sites = implode(', ', $urlFeed->getSupportedSites());
				$result['status'] = false;
				$result['message'] = sprintf(elgg_echo('news_ktform:validation:invalid:video:url'), $sites);
			}
		}
		
		
		return $result;
	}
	

	/**
	 * Validate a required value.
	 * @param mixed value $value
	 * @param boolean $required
	 * @param string $field_label
	 * 
	 * @return array array('status' => boolean, 'message' => string) //Message is only returned in case of error. 
	 */
	public function validateNon_empty_array($value, $required = FALSE, $field_label = '') {
	

		if (is_array($value)) {
			$filtered = array_filter($value, 'NewsRemoveEmptyItems');
		} else {
			$filtered = array($value);
		}
		
		$result = array(
			'status' => TRUE,
			'message' => '',
		);
		
		if($required && empty($filtered)) {
			$result['status'] = false;
			$result['message'] = elgg_echo('news_ktform:validation:array:required:text');
		}
		
		return $result;
	}	
	

}

/**
 * Function to remove the empty items in a recursive way
 * 
 * @param mix $item
 * @return array 
 */
function NewsRemoveEmptyItems($item) {
	if (is_array($item)) {
		return array_filter($item, 'removeEmptyItems');
	}

	if (!empty($item)) {
		return true;
	}
}