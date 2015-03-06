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


$news_object = new News();

$news_object->set('title', $entity->title);
$news_object->set('description', $entity->description);

$news_object->owner_guid = $entity->owner_guid;
$news_object->container_guid = $entity->container_guid;
$news_object->access_id = ACCESS_PUBLIC;
$news_object->save();

$news_object->excerpt = $entity->excerpt;
$tags = $entity->getMetaData('tags');
$news_object->tags = $tags;

create_annotation($news_object->getGUID(), 'from_blog', $entity->getGUID());

//$success = false;
$annotations = $entity->getAnnotations('suggested_to_news',1);
if($annotations) {
    $ann = current($annotations);
    if($ann) {
        //update_annotation($annotation_id, $name, $value, $value_type, $owner_guid, $access_id);
        $ann->value = 'converted';
        $ann->save();
    }
    system_messages(elgg_echo('blog_to_news:accept:message'));
} else {
    error_message(elgg_echo('blog_to_news:accept:message:error'));
}

forward(REFERER);
