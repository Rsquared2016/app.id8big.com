<?php

$internalname = elgg_extract('name', $vars, '');

$entity = elgg_extract('entity', $vars);

if (empty($internalname) || !elgg_instanceof($entity)) {
	return FALSE;
}

$value = $entity->$internalname;

$search_entity = get_entity($value);

if (elgg_instanceof($search_entity)) {
	
	$title = $search_entity->title;
	$name = $search_entity->name;
	
	if (empty($title)) {
		$value = $name;
	} else {
		$value = $title;
	}
	
}

echo $value;