<?php

$entity_subtype = ''; //None default.

if(array_key_exists('entity_subtype', $vars)) {
	$entity_subtype = $vars['entity_subtype'];
}

$internalname = 'user_guid'; //Default
if(!array_key_exists('internalname', $vars)) {
	$vars['internalname'] = $internalname;
}

$vars['search_options'] = array(
		'entity_type' => 'user', 
		'entity_subtype' => $entity_subtype,
	  );


echo elgg_view('input/ajax/autocomplete', $vars);
 
