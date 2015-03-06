<?php

/*
 * Project
 */

$group = elgg_get_page_owner_entity();

if ($group->project_thewire_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "projects/thewire/$group->guid",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
elgg_push_context('thewire_widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'thewire',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$content = elgg_list_entities_from_metadata($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('thewire:noposts') . '</p>';
}

//$new_link = elgg_view('output/url', array(
//	'href' => "blog/add/$group->guid",
//	'text' => elgg_echo('blog:write'),
//	'is_trusted' => true,
//));

// Add form thewire
if ($group->project_thewire_enable == 'yes' && $group->canWriteToContainer()) {
	$form_vars = array('class' => 'thewire-form');
	$thewire_form = elgg_view_form('thewire/add', $form_vars);

	$content = $thewire_form . $content;
}

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('thewire'),
	'content' => $content,
	'all_link' => $all_link,
//	'add_link' => $new_link,
));