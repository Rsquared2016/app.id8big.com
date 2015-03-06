<?php
/**
 * Manage group invitation requests.
 *
 * @package ElggGroups
 */

gatekeeper();
elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

$user = elgg_get_logged_in_user_entity();

$title = elgg_echo('kt_groups:invitations');

$area2 = elgg_view_title($title);

if ($user) {
	// @todo temporary workaround for exts #287.
	$invitations = ktgroups_get_invited_groups($user->getGUID());
	
	$area2 .= elgg_view('groups/invitationrequests',array('invitations' => $invitations));
	elgg_set_ignore_access($ia);
} else {
	$area2 .= elgg_echo("groups:noaccess");
}

$body = elgg_view_layout('two_column_left_sidebar', '', $area2);

$vars = array(
	 'area2' => $area2,
);

$body = elgg_view_layout("two_column_left_sidebar", $vars);

elgg_view_page($title, $body);
					 
					 
					 