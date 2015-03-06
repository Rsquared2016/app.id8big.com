<?php

$guid = get_input('guid', FALSE);

if (!$guid) {
    forward();
}

$entity = get_entity($guid);

if (!$entity) {
    forward();
}

$logued_in_guid = elgg_get_logged_in_user_guid();

if ($entity->owner_guid != $logued_in_guid && !elgg_is_admin_logged_in()) {
    register_error(elgg_echo('blog_to_news:suggest:no_pemission'));
    forward(REFERER);
}

if (!elgg_instanceof($entity, 'object', 'blog')) {
    register_error(elgg_echo('blog_to_news:suggest:no_blog'));
    forward(REFERER);
}

if ($entity->getAnnotations('suggested_to_news')) {
    register_error(elgg_echo('blog_to_news:suggest:already'));
} else {
    
    $success = create_annotation($guid, 'suggested_to_news', $logued_in_guid);
    
    if ($success) {
        system_message(elgg_echo('blog_to_news:suggest:success'));
    }
}

forward(REFERER);