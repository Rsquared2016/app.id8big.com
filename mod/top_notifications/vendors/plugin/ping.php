<?php 
/**
* top_notifications
*
* @author German Scarel
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

// Get the Elgg engine
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
set_context('admin');
admin_gatekeeper();

$NOTIFICATION_SERVER = "http://www.keetup.com/services/api/rest/php/";
    // Get version information
$version = get_version();
$release = get_version(true);

$email_address = get_input('email_address');
	
$site = get_entity(datalist_get('default_site'));
$sitename = $site->name;

$pluginversion = top_notifications_get_version();
$pluginrelease = top_notifications_get_version(true);
	
send_api_get_call(
	$NOTIFICATION_SERVER,
	array(
		'method' => 'keetup.system.ping',
		
		'pluginname' => 'top_notifications',
		'sitename' => $sitename,
		'url'	  => $site->url,
		'version' => $version,
		'release' => $release,
		'pluginversion' => $pluginversion,
		'pluginrelease' => $pluginrelease,
		'email_address' => $email_address
	),
	array()
);

system_message(elgg_echo('top_notifications:ping:thanks'));


$referer = "";
if (isset($_SERVER['HTTP_REFERER'])) {
	$referer = $_SERVER['HTTP_REFERER'];
}
forward($referer);