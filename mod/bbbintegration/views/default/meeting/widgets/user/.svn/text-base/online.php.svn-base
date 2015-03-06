<?php

/**
 * BBBIntegration
 */

if (!elgg_is_logged_in()) {
    return false;
}

$in_context_projects = elgg_in_context('projects');

//if (elgg_get_context() != 'activity') {
//    return false;
//}

// Load library
//elgg_load_library('elgg:opentok');

$limit = 5;
$defaults = array(
    'limit' => $limit,
    'count' => TRUE,
);

$options_online_users = elgg_extract('options_online_users', $vars, array());
if (is_array($options_online_users)) {
	$defaults = array_merge($defaults, $options_online_users);
}

$count = meeting_get_online_users($defaults);
$defaults['count'] = FALSE;
$users = meeting_get_online_users($defaults);

$title = elgg_echo('meeting:widgets:online:users:title');
$subtitle = elgg_echo('meeting:widgets:online:users:subtitle');

// Push context 'opentok_widgets_user_online' and 'widgets'
elgg_push_context('meeting_widgets_user_online');
elgg_push_context('widgets');

$body = elgg_view_entity_list($users, array(
    'size' => 'small',
    'count' => $count,
    'limit' => $limit,
    'pagination' => false,
));
if (empty($body)) {
    $body = '<p>'.elgg_echo('meeting:widgets:online:users:empty').'</p>';
}

elgg_pop_context();
elgg_pop_context();

$href = $vars['url'] . 'meeting/onlineusers/';
if ($in_context_projects) {
	$href .= elgg_get_page_owner_guid();
}
$view_all = elgg_view('output/url', array(
    'text' => elgg_echo('meeting:widgets:online:users:view:all'),
    'href' => $href,
    'class' => 'viewAll',
));
$header = "<h3>$title$view_all</h3>";
$header .= "<h3 class='subtitle'>$subtitle</h3>";
$vars['header'] = $header;

//$vars['class'] = 'online-users-meeting sidebarBox';
$vars['class'] = 'projects-profile-box';

if ($in_context_projects) {
?>
<div class="projects-profile-collaborators projects-profile-box">
	<h3><?php echo $title; ?></h3>
<?php
//	echo elgg_view_module('aside', elgg_echo('projects:collaborators'), $body);
	echo elgg_view('groups/profile/module', array(
//		'title' => elgg_echo('projects:profile:activity'),
		'content' => $body,
		'all_link' => $view_all,
	));
?>
</div>
<?php
}
else {
	echo elgg_view_module('list', $title, $body, $vars);
}