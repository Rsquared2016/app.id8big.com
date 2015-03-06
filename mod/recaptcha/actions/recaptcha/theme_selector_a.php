<?php 

$theme = get_input('theme', recaptcha_get_custom_theme());
elgg_set_plugin_setting('theme', $theme, 'recaptcha');

system_message(elgg_echo('admin:appearence:theme:setting:saved'));