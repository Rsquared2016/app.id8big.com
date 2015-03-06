<?php
//$context = elgg_get_context();
$context = EventsBaseMain::ktform_get_subtype($vars);

$entity = FALSE;
if (isset($vars['entity'])) {
	$entity = $vars['entity'];
}

$is_commentable = EventsBaseMain::ktform_get_entity_comments_support($context, $entity);
$is_likeable = EventsBaseMain::ktform_get_entity_likes_support($context);

$behaviors_elements = array();

if ($is_likeable) {
	$behaviors_elements[] = elgg_view('events/behavior/likes_top', $vars);
}

if ($is_commentable) {
	$behaviors_elements[] = elgg_view('events/behavior/comments_top', $vars);
}

echo implode('<span class="sep"></span>',$behaviors_elements)
?>
<div class="clearfloat">&nbsp;</div>