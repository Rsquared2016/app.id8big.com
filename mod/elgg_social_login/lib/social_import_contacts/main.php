<?php

/*
 * Social Import Contacts Lib
 */

//function social_import_contacts_is_available() {
//	
//	global $CONFIG;
//	global $HA_SOCIAL_LOGIN_PROVIDERS_CONFIG;
//	
//	require_once elgg_get_plugins_path() . "elgg_social_login/settings.php"; 
//	
//	$available = false;
//	
//	if (elgg_is_active_plugin('invitefriends')) {
//		$available = true;
//	}
//	else {
//		foreach ($HA_SOCIAL_LOGIN_PROVIDERS_CONFIG as $item ) {
//			$provider_id     = @ $item["provider_id"];
//			$provider_name   = @ $item["provider_name"];
//
//			if (elgg_get_plugin_setting('ha_settings_' . $provider_id . '_import_contacts', 'elgg_social_login')) {
//				$available = true;
//				break;
//			}
//		}
//	}
//	
//	return $available;
//	
//}

function social_import_contacts_get_invite_url(ElggUser $user) {
	
	if (!elgg_instanceof($user, 'user')) {
		$user = elgg_get_logged_in_user_entity();
	}
	
	$url = elgg_get_site_url();
	
	if (elgg_instanceof($user, 'user')) {
		if (elgg_get_config('allow_registration')) {
			$url .= 'register';
		}
		
		$elements = array(
			'friend_guid' => $user->getGUID(),
			'invitecode' => generate_invite_code($user->username),
		);
        $project_guid = get_input('project_guid', false);

        if ($project_guid) {
            $invite_type = get_input('invite_type');
            $elements['project_guid'] = $project_guid;
            $elements['invite_type'] = $invite_type;
        }
		$url = elgg_http_add_url_query_elements($url, $elements);
	}
	
	return $url;
	
}

function social_import_contacts_list_invited_contacts($options = array()) {
	
	$content = '';
	
	$user_logged_in_guid = elgg_get_logged_in_user_guid();
	
	$default = array(
		'guid' => $user_logged_in_guid,
		'annotation_owner_guids' => $user_logged_in_guid,
		'offset' => get_input('annoff', 0),
		'limit' => 5,
	);
	if (!is_array($options)) {
		$options = array();
	}
	$options = array_merge($default, $options);
	
	if (!isset($options['annotation_names'])) {
		return $content;
	}
	
	$content = elgg_list_annotations($options);
	
	return $content;
	
}