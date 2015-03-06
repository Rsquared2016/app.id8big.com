<?php

admin_gatekeeper();

//Do not filter content
$theme_logo = get_input('theme_logo', '', FALSE);
$theme_footer_html = get_input('theme_footer_html', '', FALSE);
$theme_favicon = get_input('theme_favicon', '', FALSE);
$restore = get_input('restore', false);

if($restore) {
	$success = elgg_set_plugin_setting('theme_logo', '', THEME_NAME);
	$success = elgg_set_plugin_setting('theme_footer_html', '', THEME_NAME);
	$success = elgg_set_plugin_setting('theme_favicon', '', THEME_NAME);
	
	if($success) {
		system_message(elgg_echo('admin:appearance:theme:ok:restore'));
	} else {
		register_error(elgg_echo('admin:appearance:theme:error:empty:style'));
	}
} else {
	$success = FALSE;
	
	if($theme_logo) {
		$success = elgg_set_plugin_setting('theme_logo', $theme_logo, THEME_NAME);
	}

	if($theme_footer_html) {
		$success = elgg_set_plugin_setting('theme_footer_html', $theme_footer_html, THEME_NAME);
	}

	if($theme_favicon) {
		$success = elgg_set_plugin_setting('theme_favicon', $theme_favicon, THEME_NAME);
	}
	
	if($success) {
		system_message(elgg_echo('admin:appearance:theme:ok:save'));
	} else {
		register_error(elgg_echo('admin:appearance:theme:error:saving'));
	}
}

forward(REFERER);