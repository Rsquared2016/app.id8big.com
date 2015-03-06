<?php

$subtype = GDriveBaseMain::ktform_get_subtype($vars);

$entity = FALSE;
if (isset($vars['entity'])) {
	$entity = $vars['entity'];
}

$is_commentable = GDriveBaseMain::ktform_get_entity_comments_support($subtype, $entity);

if ($vars['entity'] && $is_commentable) {
	echo "· " . elgg_view('output/url', array(
		'href' => $vars['entity']->getURL() . '#kt_comment',
		'text' => elgg_echo('gdrive_ktform:behavior:action:comment'),
	));
}