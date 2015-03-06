<?php

$forwarding_login_val = get_input('forwarding_login');

$forwarding_logo_off_val = get_input('forwarding_logo_off');
$forwarding_logo_in_val = get_input('forwarding_logo_in');


elgg_set_plugin_setting('forwarding_login', $forwarding_login_val, THEME_NAME);
elgg_set_plugin_setting('forwarding_logo_off', $forwarding_logo_off_val, THEME_NAME);
elgg_set_plugin_setting('forwarding_logo_in', $forwarding_logo_in_val, THEME_NAME);

system_message(elgg_echo('admin:appearance:theme:ok:save'));

forward(REFERER);