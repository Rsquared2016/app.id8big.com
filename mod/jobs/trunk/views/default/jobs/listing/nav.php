<?php

$logged_in_user = elgg_get_logged_in_user_entity();
if (!$logged_in_user) {
    return;
}

$selected = elgg_extract('selected', $vars, 'all');
$page_owner = elgg_get_page_owner_entity();

$username = '';
$name = '';

if ($page_owner) {
   $username = $page_owner->username;
	$name = $page_owner->name;
}

$tabs = array(
    'last' => array(
        'title' => elgg_echo('jobs:plugin:list:last'),
        'url' => "jobs/last",
        'selected' => $selected == 'last',
    ),
//    'all' => array(
//        'title' => elgg_echo('jobs:plugin:page_owner:list'),
//        'url' => "jobs/all",
//        'selected' => $selected == 'all',
//    ),
    'applies' => array(
        'title' => elgg_echo('jobs:plugin:listing:applies'),
        'url' => "jobs/applies/{$logged_in_user->username}",
        'selected' => $selected == 'applies',
    ),
);

$can_post = JobsSettings::userCanPostJob(elgg_get_logged_in_user_entity());
if($can_post) {
	$tabs['mine'] = array(
        'title' => elgg_echo('jobs_ktform:custom_tabs:mine'),
        'url' => "jobs/owner/{$username}",
        'selected' => $selected == 'mine',
    );
}

if($selected == 'mine' && $username != elgg_get_logged_in_user_entity()->username) {	
	$tabs['mine'] = array(
        'title' => elgg_echo('jobs_ktform:custom_tabs:mine:custom', array($name)),
        'url' => "jobs/owner/{$username}",
        'selected' => $selected == 'mine',
    );	
}
		
echo elgg_view('navigation/tabs', array('tabs' => $tabs));