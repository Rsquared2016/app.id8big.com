<?php

/**
 * Simple List of all the users that made a job submission 
 */
$entity = get_entity(get_input('guid'));

elgg_set_context('members');

if (!($entity instanceof KtJob) || $entity->canEdit() == FALSE) {
    forward(REFERER);
}


$owner = $entity->getOwnerEntity();
$title = elgg_echo('jobs:widget:guests:title');

elgg_push_breadcrumb(elgg_echo('jobs'), 'jobs/last');
elgg_push_breadcrumb($owner->name, 'jobs/owner/'.$owner->username);
elgg_push_breadcrumb($entity->getTitle(), $entity->getURL());
elgg_push_breadcrumb($title);

$options = array('type' => 'user', 'full_view' => false);
$options['relationship'] = SUBMIT_JOB_RELATIONSHIP;
$options['inverse_relationship'] = FALSE;
$options['relationship_guid'] = $entity->guid;
$options['class'] = 'membersListItem';


$content = elgg_list_entities_from_relationship_count($options);
$num_members = elgg_get_entities_from_relationship(array_merge($options, array('count' => TRUE)));


$params = array(
    'content' => $content,
    'sidebar' => '',
    'title' => $title . " ($num_members)",
    'filter' => FALSE,
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
