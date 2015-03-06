<?php
/**
 * Elgg event widget
 *
 * @package Events
 */

$page_owner = elgg_get_page_owner_entity();

$widget = false;
if (isset($vars['entity'])) {
	$widget = $vars['entity'];
}

$max = 5;
if ($widget instanceof ElggWidget) {
	$max = (int) $widget->num_display;
}

$options = array(
	'type' => 'object',
	'subtype' => 'event',
	'limit' => $max,
	'full_view' => FALSE,
	'pagination' => FALSE,
);

if ($widget instanceof ElggWidget) {
	$options['owner_guid'] = $widget->owner_guid;
}

$time = time();
$options['metadata_name_value_pairs'][] = array(
				'name' => 'end_event_date_time',
				'value' => $time,
				'operand' => '>=',
);
$options['order_by_metadata'] = array(
	'name' => 'star_event_date_time',
	'direction' => 'ASC',
	'as' => 'integer',
);

$content = elgg_list_entities_from_metadata($options);

echo $content;

if ($content) {
	$url = "events/";
	if (elgg_in_context('profile') && elgg_instanceof($page_owner, 'user')) {
		$url = "events/owner/" . $page_owner->username;
	}
	$more_link = elgg_view('output/url', array(
		'href' => $url,
		'text' => elgg_echo('events:more'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('events:none');
}
