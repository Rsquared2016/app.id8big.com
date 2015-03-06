<?php

/**
 * KtFilter
 *
 * This class set the form filter model, so we can know which objects filters and how to apply the action.
 *
 * @author Diego Gallardo and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

/**
 * Below an extended class as example
 * @example ../docs/example/classes/KtBlogFormFilter.php
 */
class NewsBaseFilter Extends NewsBaseForm {

	public function __construct($form_vars = array()) {

		parent::__construct($form_vars);

		global $CONFIG;
		/**
		 * @important, this should be added on the class that will extends the form filter
		 */
		$plugin_name = $this->getPluginName();
		// At least is needed to set a plugin name ...
		$this->setPluginName("{$plugin_name}_filter");


		$this->setFormVars(array('method' => 'GET', 'disable_security' => TRUE));

		//$this->setFormAction($CONFIG->url.''.$plugin_name.'/search');
		$this->setFormAction(current_page_url());

		/** END IMPORTANT * */
		//This field is used to know if we are searching or not.
		$fields = array(
			"searching_{$plugin_name}" =>
			array(
				'type' => 'hidden',
				'default_value' => 'true',
				'container_group' => 'hiddenInput no'
			),
		);

		//Add default fields.			
		$extra_fields = array(
			"keyword" =>
			array(
				'filter_type' => 'keyword',
				'type' => 'text',
				'container_group' => 'ktG50',
				'input_class' => 'txtFrm txtFrm100',
				 'options' => array(
					  'placeholder' => elgg_echo('news:news_filter:label:keyword'),
				 ),
				 'label' => FALSE,
			),
			"owner" =>
			array(
				'filter_type' => 'owner',
				'type' => 'text',
				'container_group' => 'ktG50 right',
				'input_class' => 'txtFrm txtFrm100',
				 'options' => array(
					  'placeholder' => elgg_echo('news:news_filter:label:owner'),
				 ),
				'label' => FALSE,
				 
			),
		);

		$fields = array_merge($extra_fields, $fields);

		//Set the fields.
		$this->setFields($fields);

		$fields_count = count($fields);
		$classNumElements = 1;
		//Add a custom class to the submit button, so we could put it at the bottom line of the last
		//search element field.
		if ($fields_count) {
			$classNumElements = floor($fields_count / 2);
		}

		//This value is depending on how many search column we have, in this case, we have 2 groups, then submit button have to go on bottom
		$this->setSubmitButtonClassname("rBtnSrchFrm mTop$classNumElements"); //mTop3, mTop4, mTop5 ... etc, etcs
	}

	/**
	 * We override the default save, because we dont need it
	 * @param type $register_errors
	 * @param type $override_data
	 * @return type 
	 */
	public function save($register_errors = TRUE, $override_data = array()) {
		return FALSE;
	}

	/**
	 * Get the parsed filter values, retrieve the filter type ( owner, keywords, for egg ), the internalname and the value
	 * 
	 * @return array
	 */
	public function getFilterValues() {
		$form_fields = $this->getFormFields();

		$filter_options = array();

		foreach ($form_fields as $field_key => $field) {
			$tmp_filter = array();
			//Value of the search.
			if (array_key_exists('value', $field['options'])) {
				if ($field['options']['value'] != '') {
					$tmp_filter['value'] = $field['options']['value'];
				}
			}

			$tmp_filter['internalname'] = $field_key;
			
			if (array_key_exists('filter_type', $field) && !empty($tmp_filter['value'])) {
				//Extra filter params.
				if (array_key_exists('filter_options', $field)) {
					if ($field['filter_options']) {
						$tmp_filter['filter_options'] = $field['filter_options'];
					}
				}
				
				//Filter Type.
				if (!empty($field['filter_type'])) {
					$tmp_filter['filter_type'] = $field['filter_type'];
					switch ($tmp_filter['filter_type']) {
						case 'keetup_categories':
							$tmp_filter['value'] = get_input('category_id');
							break;

						case 'calendar_start':

							$calendar_start = $tmp_filter['value'];
							

							if (is_numeric($calendar_start) && strlen($calendar_start) == 13) {
								$calendar_start = floor($calendar_start / 1000);
							}

							$calendar_start = NewsBaseMain::ktform_get_default_dates($calendar_start);

							if (is_array($calendar_start)) {
								if(date('Y',$calendar_start['calendar_start']) <= 1971){
									set_input($field_key, time());
									$calendar_start['calendar_start']=time();
								}
								$tmp_filter['value'] = $calendar_start['calendar_start'];
							}

							break;

						case 'calendar_end':
							$calendar_end = $tmp_filter['value'];

							if (is_numeric($calendar_end) && strlen($calendar_end) == 13) {
								$calendar_end = floor($calendar_end / 1000);
							}

							$calendar_end = NewsBaseMain::ktform_get_default_dates($calendar_end);

							if (is_array($calendar_end)) {
								if(date('Y',$calendar_end['calendar_end']) <= 1971){
									set_input($field_key, time());
									$calendar_end['calendar_end']=time();
								}
								$tmp_filter['value'] = $calendar_end['calendar_end'];
							}

							break;

						case 'location':
							//Do we need a special input ?
							//Check if comes the 'gelokation' input.
							$geolokation = get_input('geolokation', '');
							
							if($geolokation) {
								//Try to validate if it is a valid (lat, long) input.
								$geo_comp = geolokation_coordinates2array($geolokation);
								if($geo_comp['lat'] && $geo_comp['long']) {
									$tmp_filter['value'] = $geolokation;
								}
							}
														
							break;
						
						case 'metadata':
							//KTODO: Implement the metadata filter.
							break;
					}
				}
			}

			if (count($tmp_filter) > 1) {
				$filter_options[$field_key] = $tmp_filter;
			}
		}
		return $filter_options;
	}

}