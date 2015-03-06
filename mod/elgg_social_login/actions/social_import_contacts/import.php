<?php

/*
 * Social Import Contacts
 */

global $CONFIG;
global $HA_SOCIAL_LOGIN_PROVIDERS_CONFIG;

$assets_base_url  = elgg_get_site_url() . "mod/elgg_social_login/";
$assets_base_path = elgg_get_plugins_path() . "elgg_social_login/";

// load hybridauth
require_once( $assets_base_path . "vendors/hybridauth/Hybrid/Auth.php" ); 

// load settings
require_once elgg_get_plugins_path() . "elgg_social_login/settings.php"; 

$contacts = get_input('contacts', '');
//$all_contacts = get_input('all_contacts', '');
$provider = get_input('provider', '');
$body = get_input('body', '', true);

$project_guid = get_input('project_guid', false);

    if ($project_guid) {
    $invite_type = get_input('invite_type');
}
if (empty($contacts)) {
	register_error(elgg_echo('social_import_contacts:error:contacts:empty'));
	forward(REFERER);
}

if (empty($provider)) {
	register_error(elgg_echo('social_import_contacts:error:provider:empty'));
	forward(REFERER);
}

// Config
$config = array();
$config["base_url"]  = $assets_base_url . 'vendors/hybridauth/';
$config["providers"] = array();
$config["providers"][$provider] = array();
$config["providers"][$provider]["enabled"] = true;

// provider application id ?
if( elgg_get_plugin_setting( 'ha_settings_' . $provider . '_app_id', 'elgg_social_login' ) ){
	$config["providers"][$provider]["keys"]["id"] = elgg_get_plugin_setting( 'ha_settings_' . $provider . '_app_id', 'elgg_social_login' );
}

// provider application key ?
if( elgg_get_plugin_setting( 'ha_settings_' . $provider . '_app_key', 'elgg_social_login' ) ){
	$config["providers"][$provider]["keys"]["key"] = elgg_get_plugin_setting( 'ha_settings_' . $provider . '_app_key', 'elgg_social_login' );
}

// provider application secret ?
if( get_plugin_setting( 'ha_settings_' . $provider . '_app_secret', 'elgg_social_login' ) ){
	$config["providers"][$provider]["keys"]["secret"] = elgg_get_plugin_setting( 'ha_settings_' . $provider . '_app_secret', 'elgg_social_login' );
}

// if facebook
if( strtolower( $provider ) == "facebook" ){
	$config["providers"][$provider]["display"] = "popup";
}

// create an instance for Hybridauth
$hybridauth = new Hybrid_Auth( $config );

// try to authenticate the selected $provider
$adapter = $hybridauth->authenticate( $provider );

$site = elgg_get_site_entity();
$user = elgg_get_logged_in_user_entity();
if (empty($body)) {
	$body = elgg_echo('social_import_contacts:message:body', array($site->name, elgg_get_site_url()));
}
$options = array(
	'recipients' => $contacts,
	'subject' => elgg_echo('social_import_contacts:message:subject', array($site->name)),
	'body' => $body,
	'from' => $user->email,
);

$success = FALSE;
try {
    $success = $adapter->sendMessage($options);
} catch (Exception $exc) {
    $error = $exc->getMessage();
	if($error) {
		register_error($error);
	}
}


if ($success) {
	system_message(elgg_echo('social_import_contacts:success:invite:contacts', array($provider)));
    if ($project_guid) {
        forward('social_import_contacts?project_guid='.$project_guid.'&provider='.$provider);
    } else {
        forward('social_import_contacts?provider='.$provider);
    }
}
else {
	register_error(elgg_echo('social_import_contacts:error:invite:contacts', array($provider)));
	forward('social_import_contacts?userimported=1');
}

