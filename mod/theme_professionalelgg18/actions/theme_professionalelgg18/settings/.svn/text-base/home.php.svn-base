<?php

admin_gatekeeper();

//Do not filter content
$body_html = get_input('body_html', '', FALSE);
$restore = get_input('restore', false);

if($restore) {
	$success = elgg_set_plugin_setting('body_html', '', THEME_NAME);
	
	if($success) {
		system_message(elgg_echo('admin:appearance:theme:ok:restore'));
	} else {
		register_error(elgg_echo('admin:appearance:theme:error:empty:style'));
	}
	
} else {
	$success = FALSE;
	
	if($body_html) {
		$success = elgg_set_plugin_setting('body_html', $body_html, THEME_NAME);
	}
	
	if($success) {
		system_message(elgg_echo('admin:appearance:theme:ok:save'));
	} else {
		register_error(elgg_echo('admin:appearance:theme:error:saving'));
	}
}

forward(REFERER);