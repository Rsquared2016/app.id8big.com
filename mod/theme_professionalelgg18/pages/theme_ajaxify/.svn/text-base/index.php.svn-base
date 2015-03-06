<?php

/*
 * Get all comments
 */

$is_xhr = elgg_is_xhr();
if (!$is_xhr) {
	forward();
}

elgg_set_context('activity');

$entity_guid = get_input('entity_guid', 0);
$entity = get_entity($entity_guid);

if ($entity instanceof ElggEntity) {
	$options = array(
		'guid' => $entity->getGUID(),
		'annotation_name' => 'generic_comment',
		'limit' => null,
		'order_by' => 'n_table.time_created desc',
	);
	$comments = elgg_get_annotations($options);
	if ($comments) {
		$comments = array_reverse($comments);
		
		echo elgg_view_annotation_list($comments, array('list_class' => 'elgg-river-comments'));
		
		exit;
	}
}

echo '';
exit;