<?php
/**
 * Help texts sidebar
 */

$page_owner_guid = elgg_get_page_owner_guid();
if (empty($page_owner_guid) && function_exists('groups_get_my_company')) {
	
	$page_owner = groups_get_my_company();
	if ($page_owner) {
		$page_owner_guid = $page_owner->getGUID();
	}
	
}


echo elgg_view('page/elements/comments_block', array(
	'subtypes' => 'help_texts',
	'owner_guid' => $page_owner_guid,
));

echo elgg_view('page/elements/tagcloud_block', array(
	'subtypes' => 'help_texts',
	'owner_guid' => $page_owner_guid,
));
