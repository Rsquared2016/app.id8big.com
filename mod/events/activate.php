<?php

$server_timezone = elgg_get_plugin_setting('site_timezone', 'events');
$default_timezone = 'Etc/UTC';

if (empty($server_timezone)) {
	elgg_set_plugin_setting('site_timezone', $default_timezone, 'events');
}