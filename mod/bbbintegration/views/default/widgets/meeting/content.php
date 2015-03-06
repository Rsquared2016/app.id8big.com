<?php
/**
 * Elgg meeting widget
 *
 * @package Meeting
 */

$max = (int) $vars['entity']->num_display;

// Get site timezone
if (is_callable('elgg_timezone_get_timezone_site')) {
    // Function added into this module
    $site_timezone = elgg_timezone_get_timezone_site();
}
else {
    $site_timezone = elgg_get_plugin_setting('site_timezone', 'events');
}
// Get current timezone
$current_timezone = date_default_timezone_get();
// Set site timezone
date_default_timezone_set($site_timezone);
// Get site_end_datetime to compare
$site_end_datetime = time();
// Set current timezone
date_default_timezone_set($current_timezone);

$options = array(
	'type' => 'object',
	'subtype' => 'meeting',
	'owner_guid' => $vars['entity']->owner_guid,
	'limit' => $max,
	'full_view' => FALSE,
	'pagination' => FALSE,
    'metadata_name_value_pairs' => array(
        array(
            'name' => 'site_end_datetime',
            'value' => $site_end_datetime,
            'operand' => '>=',
        ),
    ),
    'order_by_metadata' => array(
        'name' => 'site_start_datetime',
        'direction' => 'ASC',
        'as' => 'integer',
    ),
);
$content = elgg_list_entities_from_metadata($options);

echo $content;

if ($content) {
	$url = "meeting/owner/" . elgg_get_page_owner_entity()->username;
	$more_link = elgg_view('output/url', array(
		'href' => $url,
		'text' => elgg_echo('meeting:more'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('meeting:none');
}
