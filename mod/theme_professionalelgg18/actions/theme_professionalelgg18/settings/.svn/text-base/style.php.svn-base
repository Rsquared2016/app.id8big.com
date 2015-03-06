<?php

admin_gatekeeper();

//Do not filter content
$css = get_input('css', '', FALSE);
$restore = get_input('restore', false);

if($restore) {
	//Clear previus default settings.
	$success = elgg_unset_plugin_setting('theme_default_style', THEME_NAME);
	$success = elgg_unset_plugin_setting('theme_custom_style', THEME_NAME);
	
	system_message(elgg_echo('admin:appearance:theme:ok:restore'));
	
} else if (is_array($css)) {
	$css = serialize($css);
	
	$success = elgg_set_plugin_setting('theme_custom_style', $css, THEME_NAME);
		
	if($success) {
		system_message(elgg_echo('admin:appearance:theme:ok:save'));
	} else {
		register_error(elgg_echo('admin:appearance:theme:error:saving'));
	}
} else {
	register_error(elgg_echo('admin:appearance:theme:error:empty:style'));
}

forward(REFERER);