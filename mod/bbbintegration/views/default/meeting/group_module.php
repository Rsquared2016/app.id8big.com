<?php
/**
 * Group pages
 *
 * @package ElggPages
 */


$group = elgg_get_page_owner_entity();

if ($group->meeting_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "meeting/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

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

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'meeting',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
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
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('meeting:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "meeting/add/$group->guid",
	'text' => elgg_echo('meeting:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('meeting:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
