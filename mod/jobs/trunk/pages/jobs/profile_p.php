<?php

/**
 * View a bookmark
 *
 * @package ElggBookmarks
 */

elgg_load_js('lightbox');
elgg_load_css('lightbox');

$entity = get_entity(get_input('guid'));
if (!($entity instanceof KtJob)) {
    register_error(elgg_echo('noaccess'));
    $_SESSION['last_forward_from'] = current_page_url();
    forward('');
}

if ($entity->canSubmitJob()) {
    elgg_register_menu_item('title', array(
        'name' => 'Apply',
        'href' => "jobs/apply/{$entity->getGUID()}",
        'text' => elgg_echo("jobs:button:apply"),
        'link_class' => 'elgg-button elgg-button-action',
         'id' => 'apply_job_button',
    ));
}


$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

elgg_push_breadcrumb(elgg_echo('jobs'), 'jobs/last');

if (elgg_instanceof($page_owner, 'group')) {
    elgg_push_breadcrumb($crumbs_title, "jobs/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb($crumbs_title, "jobs/owner/$page_owner->username");
}


$title = $entity->title;

if (!$title) {
    $title = get_class($entity);
}

$has_title_method = is_callable(array($entity, 'getTitle'));
if ($has_title_method) {
    $title = $entity->getTitle();
}

elgg_push_breadcrumb($title);

$content = elgg_view_entity($entity, array('full_view' => true));

//$content .= elgg_view_comments($entity);
$sidebar = elgg_view('jobs/sidebar/applies', array('entity' => $entity));
$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    
    'sidebar' => $sidebar,
        ));

echo elgg_view_page($title, $body);

