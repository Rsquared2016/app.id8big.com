<?php
require_once(dirname(__FILE__) . "/engine/start.php");

$plugins_to_enable = '';
// if ($_SERVER['argv'][1]) {
// 	$plugins_to_enable = $_SERVER['argv'][1];
// }


$plugins_to_enable = $_REQUEST['p'];

if (empty($plugins_to_enable) || !is_string($plugins_to_enable)) {
	echo "No plugins to enable";
	die;
}

//$plugins_to_enable = 'captcha,garbagecollector,htmlawed,logbrowser,members,messages,notifications,profile,reportedcontent,riverdashboard,search,tinymce,uservalidationbyemail';

$plugins_to_enable = split(',', $plugins_to_enable);
$admin = get_user(2);
login($admin);
foreach ($plugins_to_enable as $plugin) {
	if (!is_plugin_enabled($plugin)){
		$success = enable_plugin($plugin);
		if ($success) {
			system_message("Plugin {$plugin} is now enabled");
		} else {
			register_error("An error occurred while enabling {$plugin}");
		}
	}
}

logout();
echo '<pre>';
print_r($plugins_to_enable);
echo '</pre>';
exit;
