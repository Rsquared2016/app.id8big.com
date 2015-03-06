<?php
/**
 * Group members sidebar
 *
 * @package ElggGroups
 *
 * @uses $vars['entity'] Group entity
 * @uses $vars['limit']  The number of members to display
 */

$entity = elgg_extract('entity', $vars);

if (!($entity instanceof KtJob)) {
    return;
}

if ($entity->canEdit() == FALSE) {
    return;
}

$limit = elgg_extract('limit', $vars, 14);

$all_link = elgg_view('output/url', array(
	'href' => 'jobs/submissions/'.$entity->getGUID().'/'.  elgg_get_friendly_title($entity->getTitle()),
	'text' => elgg_echo('job:widget:guests:view_all'),
	'is_trusted' => true,
));

//$body = elgg_list_entities_from_relationship(array(
//	'relationship' => 'member',
//	'relationship_guid' => $vars['entity']->guid,
//	'inverse_relationship' => true,
//	'types' => 'user',
//	'limit' => $limit,
//	'list_type' => 'gallery',
//	'gallery_class' => 'elgg-gallery-users',
//	'pagination' => false
//));

$body = elgg_list_entities_from_relationship(array(
    'limit' => $limit,
    'relationship' => SUBMIT_JOB_RELATIONSHIP,
    'relationship_guid' => $entity->guid,
    'inverse_relationship' => FALSE,
    'list_type' => 'gallery',
    'gallery_class' => 'elgg-gallery-users',
    'pagination' => false,
    'types' => 'user',
));

if (empty($body)) {
   $body = elgg_echo('job:submissions:widget:empty_result');
} else {
    $body .= "<div class='center mts'>$all_link</div>";
}

echo elgg_view_module('aside', elgg_echo('jobs:widget:guests:title'), $body);
