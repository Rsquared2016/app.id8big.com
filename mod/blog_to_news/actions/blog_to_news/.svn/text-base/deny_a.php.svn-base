<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$guid = get_input('guid', FALSE);

if (!$guid) {
    forward();
}

$entity = get_entity($guid);

if (!$entity) {
    forward();
}

if (!elgg_instanceof($entity, 'object', 'blog')) {
    register_error(elgg_echo('blog_to_news:suggest:no_blog'));
    forward(REFERER);
}


$success = false;
$success = $entity->deleteAnnotations('suggested_to_news');

if ($success) {
    system_messages(elgg_echo('blog_to_news:deny:message'));
} else {
    error_message(elgg_echo('blog_to_news:deny:message:error'));
}

forward(REFERER);




forward(REFERER);