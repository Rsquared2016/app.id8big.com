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
class userProfileForm extends stdClass {

    const MAX_LENGTH_TEXT = 250;
    
	protected $fields;
	protected $action_name;
	protected $user;

	public function __construct() {

		$user = elgg_get_logged_in_user_entity();
		$this->user = $user;

		$profile_fields = $this->getUserFields();

		$fields = array();

		$action_name = get_input('action');
		if ($action_name) {
			$this->action_name = $action_name;
		}

		$required_fields = $this->getRequiredFields();


		$social_email = $user->email;
		if ($this->isSocialUser() && empty($social_email)) {
			if ($social_email == '' && $action_name) {
				$social_email = get_input('email');
			}


			$fields['email']['required'] = TRUE;
			$fields['email']['label'] = elgg_echo('profile:email');
			$fields['email']['value'] = $social_email;
			$fields['email']['field'] = elgg_view("input/email", array('entity' => $user, 'value' => $social_email, 'name' => 'email'));
		}

        $sticky_pi = array();
        $action = get_input('action', '');
        if (elgg_is_sticky_form('personal_information') && $action == '') {
            $sticky_pi = elgg_get_sticky_values('personal_information');
        	elgg_clear_sticky_form('personal_information');
        }

		foreach ($profile_fields as $name => $type) {
            
			$label = elgg_echo("profile:{$name}");

			$value = $user->$name;
			if ($value == '' && $action_name) {
				$value = get_input($name);
			}
            
            if (array_key_exists($name, $sticky_pi)) {
                $value = $sticky_pi[$name];
            }

			$fields[$name]['required'] = FALSE;
			if (in_array($name, $required_fields)) {
				$fields[$name]['required'] = TRUE;
			}

			$fields[$name]['label'] = $label;
			$fields[$name]['value'] = $value;
			$fields[$name]['field'] = elgg_view("input/{$type}", array('entity' => $user, 'value' => $value, 'name' => $name));
            if ($type == 'plaintext') {
                $fields[$name]['max_length'] = self::MAX_LENGTH_TEXT;
            }
		}



		$this->fields = $fields;
	}

	public function getRequiredFields() {
		$returnvalue = array();
		
		$returnvalue = elgg_trigger_plugin_hook('register_exteps', 'get:required:fields', array('user' => $this->user), $returnvalue);

		return $returnvalue;
	}

	public function isSocialUser() {
		$user = $this->user;

		if (elgg_is_active_plugin('elgg_social_login')) {
			$login_provider = elgg_get_plugin_user_setting('provider', $user->getGUID(), 'elgg_social_login');
			return $login_provider;
		}

		return FALSE;
	}

	public function getUserFields() {

		$login_provider = $this->isSocialUser();

		$returnvalue = elgg_get_config('profile_fields');
		
		$returnvalue = elgg_trigger_plugin_hook('register_exteps', 'get:user:fields', array('user' => $this->user, 'login_provider' => $login_provider), $returnvalue);

		return $returnvalue;
	}

	public function __toString() {
		echo "<strong style='color:red;'>TODO __toString method</strong>";
	}

	public function setFormAction($url) {
		//Not used
	}

	public function renderFieldsToArray() {
		return $this->fields;
	}

	public function __clearSession() {
		//Not used yet
	}

	public function save() {
		$guid = $this->user->getGUID();
		$owner = $this->user;

		if (!$owner || !($owner instanceof ElggUser) || !$owner->canEdit()) {
			register_error(elgg_echo('profile:edit:fail'));
			return FALSE;
		}

		// grab the defined profile field names and their load the values from POST.
		// each field can have its own access, so sort that too.
		$input = array();
		$accesslevel = get_input('accesslevel');

		if (!is_array($accesslevel)) {
			$accesslevel = array();
		}

		$profile_fields = $this->getUserFields();
		
		foreach ($profile_fields as $shortname => $valuetype) {
			// the decoding is a stop gap to prevent &amp;&amp; showing up in profile fields
			// because it is escaped on both input (get_input()) and output (view:output/text). see #561 and #1405.
			// must decode in utf8 or string corruption occurs. see #1567.
			$value = get_input($shortname);
			if (is_array($value)) {
				array_walk_recursive($value, 'register_exteps_profile_array_decoder');
			} else {
				$value = html_entity_decode($value, ENT_COMPAT, 'UTF-8');
			}

			// limit to reasonable sizes
			// @todo - throwing away changes due to this is dumb!
			if (!is_array($value) && $valuetype != 'longtext' && elgg_strlen($value) > self::MAX_LENGTH_TEXT) {
				$error = elgg_echo('profile:field_too_long', array(elgg_echo("profile:{$shortname}")));
				register_error($error);
				return FALSE;
			}

			if ($valuetype == 'tags') {
				$value = string_to_tag_array($value);
			}

			$input[$shortname] = $value;
		}

// display name is handled separately
		$name = strip_tags(get_input('name'));
		if ($name) {
			if (elgg_strlen($name) > 50) {
				register_error(elgg_echo('user:name:fail'));
			} elseif ($owner->name != $name) {
				$owner->name = $name;
				$owner->save();
			}
		}

// go through custom fields
		if (sizeof($input) > 0) {
			foreach ($input as $shortname => $value) {
				$options = array(
					'guid' => $owner->guid,
					'metadata_name' => $shortname
				);
				elgg_delete_metadata($options);
				if (isset($accesslevel[$shortname])) {
					$access_id = (int) $accesslevel[$shortname];
				} else {
					// this should never be executed since the access level should always be set
					$access_id = ACCESS_LOGGED_IN;
				}
				if (is_array($value)) {
					$i = 0;
					foreach ($value as $interval) {
						$i++;
						$multiple = ($i > 1) ? TRUE : FALSE;
						create_metadata($owner->guid, $shortname, $interval, 'text', $owner->guid, $access_id, $multiple);
					}
				} else {
					create_metadata($owner->getGUID(), $shortname, $value, 'text', $owner->getGUID(), $access_id);
				}
			}

			$owner->save();

			// Notify of profile update
			elgg_trigger_event('profileupdate', $owner->type, $owner);

			system_message(elgg_echo("profile:saved"));
			return TRUE;
		}

		return TRUE;
	}

}
