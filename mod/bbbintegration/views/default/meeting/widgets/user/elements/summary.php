<?php

/**
 * OpenTok
 */

/**
 * User summary
 *
 * @uses $vars['entity']    ElggEntity
 * @uses $vars['title']     Title link (optional) false = no title, '' = default
 * @uses $vars['metadata']  HTML for entity metadata and actions (optional)
 * @uses $vars['subtitle']  HTML for the subtitle (optional)
 * @uses $vars['tags']      HTML for the tags (optional)
 * @uses $vars['content']   HTML for the entity content (optional)
 */

$entity = $vars['entity'];
if (!elgg_instanceof($entity, 'user')) {
    return false;
}

$name = $entity->name;

if (!elgg_in_context('meeting')) {
    $name = elgg_get_excerpt($name, 18);
}
$title = "<a class='link-name-user' href=\"" . $entity->getUrl() . "\" $rel>" . $name . "</a>";
$title .= elgg_view('meeting/widgets/user/talk', $vars);
$vars['title'] = $title;
$vars['subtitle'] = '';

echo elgg_view('object/elements/summary', $vars);