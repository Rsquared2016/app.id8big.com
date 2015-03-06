<?php
/**
 * Fine_uploaderdable content list item view
 *
 * @uses $vars['entity'] ElggEntity object
 */

$entity = $vars['entity'];
$only_image = elgg_extract('only_image', $vars);

$image = elgg_view_entity_icon($entity, 'small', array('link_class' => 'fine_uploader-insert'));
if ($only_image) {
	echo $image;
	return;
}

$title = $entity->title;
if (!$title) {
	$title = $entity->name;
}

// different entity types have different title attribute names.
$title = isset($entity->name) ? $entity->name : $entity->title;
// don't let it be too long
$title = elgg_get_excerpt($title);

$owner = $entity->getOwnerEntity();
if ($owner) {
	$author_text = elgg_echo('byline', array($owner->name));
	$date = elgg_view_friendly_time($entity->time_created);
	$subtitle = "$author_text $date";
} else {
	$subtitle = '';
}

$params = array(
	'title' => $title,
	'entity' => $entity,
	'subtitle' => $subtitle,
	'tags' => FALSE,
);
$body = elgg_view('object/elements/summary', $params);



echo elgg_view_image_block($image, $body);
