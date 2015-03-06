<?php

/**
 * welcome_site
 *
 * Class description here or bellow...
 * 
 * @author Bortoli German
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
/* [To delete] 
 *  This is an class example.
 *  This is the MyClass class, an extension of elggObject
 */

/**
 * Class description here
 * @author Bortoli German
 */
class ProfileComplete {

	protected $user;
	protected $complete_percentage;

	public function __construct(ElggUser $user) {
		if (!($user instanceof ElggUser)) {
			$user = elgg_get_logged_in_user_entity();
		}

		if (!($user instanceof ElggUser)) {
			return FALSE;
		}


		$this->user = $user;
		$this->complete_percentage = 0;
		$this->steps_number = 5;
	}

	public function hasProfilePicture() {
		$to_return = FALSE;

		if ($this->user) {
			if ($this->user->icontime) {
				$to_return = TRUE;
			}
		}

		return $to_return;
	}

	public function hasProfileDescription() {
		$description = '';

		if ($this->user) {
			$description = $this->user->description;
		}


		if (empty($description)) {
			return FALSE;
		}

		return TRUE;
	}

	public function isLoginStepComplete() {

		$has_data = $this->user->next_step;
		if ($has_data == 'go_home') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function isLoginStepIncomplete() {
		$completed = $this->isLoginStepComplete();


		if ($completed) {
			return FALSE;
		}

		return TRUE;
	}

	public function loadedImage() {

		$icontime = $this->user->icontime;

		if ($icontime) {
			return TRUE;
		}

		return FALSE;
	}

	public function loadedDni() {
		$user = $this->user;
		$dni = $user->dni;

		if ($dni) {
			return TRUE;
		}

		return FALSE;
	}

	public function loadedBasicData() {

		$user = $this->user;

		$user_profile_form = new userProfileForm();

		$profile_required = $user_profile_form->getRequiredFields();
		$all_profile_fields = $user_profile_form->getUserFields();

		foreach ($all_profile_fields as $field_key => $field_type) {
			if (!in_array($field_key, $profile_required)) {
				unset($all_profile_fields[$field_key]);
			}
		}

		$profile_count = count($all_profile_fields);
		$profile_ammount = 0;

		foreach ($all_profile_fields as $meta_name => $meta_type) {
			$meta_value = $user->$meta_name;
			if ($meta_value) {
				$profile_ammount = $profile_ammount + 1;
			}
		}


		if ($profile_ammount == $profile_count) {
			return TRUE;
		}

		return FALSE;
	}

	public function getPercentageCompleted() {

		$steps_total = $this->steps_number;

		// Empieza de uno porque el primer paso, el registro, esta completado.
		$steps_completed = 1;

		$has_image = $this->loadedImage();
		$has_data = $this->loadedBasicData();
		$has_dni = $this->loadedDni();

		if ($has_image) {
			$steps_completed++;
		}

		if ($has_data) {
			$steps_completed++;
		}

		if ($has_dni) {
			$steps_completed++;
		}

//	if ($this->loadedObra()) {
//	    $steps_completed++;
//	}

		return ($steps_completed / $steps_total) * 100;
	}

	public function getCurrentStep($to_include = array()) {
		$has_image = $this->loadedImage();
		$has_data = $this->loadedBasicData();
//		$has_dni = $this->loadedDni();


		$with_image = elgg_extract('profile_image', $to_include, FALSE);

		if ($with_image) {
			if (!$has_image) {
				return 'profile_image';
			}
		}

		if (!$has_data) {
			return 'personal_information';
		}
	}

	public function getCurrentStepUrl($to_include = array()) {
		$step = $this->getCurrentStep($to_include);

		$url = elgg_get_config('url') . 'register';
		$url = elgg_http_add_url_query_elements($url, array('tab' => $step));

		return $url;
	}

	public function forwardToStep($to_include = array()) {
		forward($this->getCurrentStepUrl($to_include));
	}

	public static function get_user_entity($user = FALSE) {

		if ($user === FALSE) {
			$user = elgg_get_logged_in_user_entity();
		}

		if (is_numeric($user)) {
			$user = get_entity($user);
		}

		if ($user instanceof ElggUser) {
			return $user;
		}

		return FALSE;
	}

}