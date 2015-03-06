<?php
$email_address = get_input('email_address');

if (!is_email_address($email_address)) {
	register_error(elgg_echo('admin:appearance:theme:tabs:ping:error:email'));
	forward(REFERER);
}


$NOTIFICATION_SERVER = "http://www.keetup.com/services/api/rest/php/";
    // Get version information
$version = get_version();
$release = get_version(true);

	
$site = elgg_get_site_entity();
$sitename = $site->name;

$plugin = elgg_get_plugin_from_id(THEME_NAME);

$plugin_manifest = $plugin->getManifest();

$pluginversion = $plugin_manifest->getVersion();
$pluginname = $plugin_manifest->getPluginID();

$pluginrelease = theme_professionalelgg_get_version();

if (!$pluginrelease) {
	$pluginrelease = $plugin_manifest->getTimeUpdated();
}

	
send_api_get_call(
	$NOTIFICATION_SERVER,
	array(
		'method' => 'keetup.system.ping',
		
		'pluginname' => $pluginname,
		'sitename' => $sitename,
		'url'	  => $site->url,
		'version' => $version,
		'release' => $release,
		
		'pluginversion' => $pluginrelease,
		'pluginrelease' => $pluginversion,
		
		'email_address' => $email_address
	),
	array()
);

system_message(elgg_echo('admin:appearance:theme:tabs:ping:thanks'));

forward(REFERER);