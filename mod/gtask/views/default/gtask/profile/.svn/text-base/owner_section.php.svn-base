<?php
//$context = elgg_get_context();
$context = GtaskBaseMain::ktform_get_subtype($vars);

$entity = FALSE;
if (isset($vars['entity'])) {
	$entity = $vars['entity'];
}

$is_commentable = GtaskBaseMain::ktform_get_entity_comments_support($context, $entity);
$is_likeable = GtaskBaseMain::ktform_get_entity_likes_support($context);

$behaviors_elements = array();

if ($is_likeable) {
	$behaviors_elements[] = elgg_view('gtask/behavior/actions/likes', $vars);
}

if ($is_commentable) {
	$behaviors_elements[] = elgg_view('gtask/behavior/actions/comments', $vars);
}

echo implode('',$behaviors_elements)
?>
<div class="clearfloat">&nbsp;</div>