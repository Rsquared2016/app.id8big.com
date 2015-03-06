<?php

/**
 * OpenTok
 */

$limit = 10;
$offset = get_input('offset', 0);

$page_owner_guid = get_input('page_owner_guid', elgg_get_logged_in_user_guid());
$page_owner = get_entity($page_owner_guid);
$is_project = ($page_owner instanceof ProjectGroup);
if ($is_project) {
	elgg_set_page_owner_guid($page_owner_guid);
}

// Get title
$title = elgg_echo('meeting:online:users:title');
if ($page_owner instanceof ProjectGroup) {
    $title = elgg_echo('meeting:online:team:title');
}

// Get online users
$options = array(
    'offset' => $offset,
    'limit' => $limit,
    'count' => TRUE,
);
if ($is_project) {
//	$options['relationship'] = 'collaborator';
	$options['relationship'] = 'member';
	$options['relationship_guid'] = $page_owner_guid;
	$options['inverse_relationship'] = TRUE;
}
$count = meeting_get_online_users($options);
$options['count'] = FALSE;
$users = meeting_get_online_users($options);

// Push context 'meeting_widgets_user_online' and 'widgets'
elgg_push_context('meeting_widgets_user_online');
elgg_push_context('widgets');

$content = elgg_view_entity_list($users, array(
    'size' => 'small',
    'count' => $count,
    'limit' => $limit,
    'full_view' => false,
    'view_toggle_type' => false,
    'pagination' => true,
));

elgg_pop_context();
elgg_pop_context();

if (!$content) {
    $content = elgg_echo('meeting:online:users:empty');
    if ($page_owner instanceof ProjectGroup) {
        $content = elgg_echo('meeting:online:team:empty');
    }
}

$body = elgg_view_layout('content', array(
    'title' => $title,
    'content' => $content,
    'filter_override' => '',
));

echo elgg_view_page($title, $body);