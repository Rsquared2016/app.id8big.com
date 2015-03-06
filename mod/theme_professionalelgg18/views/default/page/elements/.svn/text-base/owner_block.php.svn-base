<?php
/**
 * Elgg owner block
 * Displays page ownership information
 *
 * @package Elgg
 * @subpackage Core
 *
 */


elgg_push_context('owner_block');
// groups and other users get owner block
$owner = elgg_get_page_owner_entity();

if (elgg_in_context('profile')) {
	return FALSE;
}


if ($owner instanceof ElggGroup ||
	($owner instanceof ElggUser && $owner->getGUID() != elgg_get_logged_in_user_guid())) {

	elgg_load_js('hovercard_init.js');
	
/**
 * Obsolete this line
 * $header = elgg_view_entity($owner, array('full_view' => false));
 * 
 * will be replaced by the icon 
 */
	
	$header = elgg_view_entity_icon($owner, 'tiny', array('use_hover' => FALSE));
	
	if (elgg_instanceof($owner, 'user')) {
		
		$hovercard_options = array_merge($vars, array('entity' => $owner));
		
		$header = '<div class="userHoverCard" data-hover-id="'.$owner->getGUID().'">'.$header.'</div>';
		$header .= elgg_view('theme_elements/ownerblock_hovercard', $hovercard_options);
	}
	
	$body = '';
	
/**
 * @TODO: IF the owner block in future has some menu or page, uncomment this lines 
 */
//	$body = elgg_view_menu('owner_block', array('entity' => $owner));
//	$body .= elgg_view('page/elements/owner_block/extend', $vars);
	

	echo elgg_view('page/components/module', array(
		'header' => $header,
		'body' => $body,
		'class' => 'elgg-owner-block',
	));
}

elgg_pop_context();