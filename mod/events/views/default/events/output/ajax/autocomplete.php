<?php

$value = 0;
if (!empty($vars['value'])) {
	$value = $vars['value'];
}

$entity = get_entity($value);
if (empty($entity)) {
	return FALSE;
}


$text = '';
switch($entity->getType()) {
	case 'group':
	case 'user':
		$text = $entity->name;
	break;

	default:
		$text = $entity->title;
	break;
}

if (empty($text)) {
	return FALSE;
}

$display_link = TRUE;
if (array_key_exists('display_link', $vars)) {
	if ($vars['display_link'] == FALSE) {
		$display_link = FALSE;
	}
}

if ($display_link) {
	echo elgg_view('output/url', array('href' => $entity->getURL(),'text' => $text));
} else {
	echo elgg_view('output/text', array('value' => $text));
}