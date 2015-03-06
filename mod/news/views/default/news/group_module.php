<?php
/**
 * Group pages
 *
 * @package ElggPages
 */


$group = elgg_get_page_owner_entity();

if ($group->news_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "news/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));


//elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'new',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 10,
	'full_view' => false,
//	'pagination' => true,
);
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('news:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "news/add/$group->guid",
	'text' => elgg_echo('news:add'),
	'is_trusted' => true,
	'class' => 'elgg-button elgg-button-submit flRig',
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('news:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
