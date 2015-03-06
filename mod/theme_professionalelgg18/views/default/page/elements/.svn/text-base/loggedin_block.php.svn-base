<?php

elgg_push_context('loggedin_block');

// groups and other users get owner block
$logged_in_user = elgg_get_logged_in_user_entity();
$owner_entity = elgg_get_page_owner_entity();

if (elgg_instanceof($logged_in_user, 'user')) {
	$header = elgg_view('user/logged_in_block_entity', array('full_view' => FALSE, 'entity' => $logged_in_user));
//	$header = elgg_view_entity($logged_in_user, array('full_view' => FALSE));
	$body = '';
	if (elgg_instanceof($owner_entity, 'group')) {
		$body = elgg_view_menu('owner_block', array('entity' => $owner_entity));
		$body .= elgg_view('page/elements/owner_block/extend', $vars);
	}

	echo elgg_view('page/components/module', array(
		'header' => $header,
		'body' => $body,
		'class' => 'elgg-loggedin-block',
	));
}

elgg_pop_context();