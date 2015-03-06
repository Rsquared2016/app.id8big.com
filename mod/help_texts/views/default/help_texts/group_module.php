<?php
/**
 * List most recent help_texts on group profile page
 *
 * @package Help texts
 */

$group = elgg_get_page_owner_entity();

if ($group->help_texts_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "help_texts/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'help_texts',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('help_texts:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "help_texts/add/$group->guid",
	'text' => elgg_echo('help_texts:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('help_texts:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
