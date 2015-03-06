<?php
/*
 * Compass Column
 */
$entities = elgg_extract('entities', $vars, array());

foreach($entities as $entity) {
	echo elgg_view('compass/compass_item', array('entity' => $entity));
}