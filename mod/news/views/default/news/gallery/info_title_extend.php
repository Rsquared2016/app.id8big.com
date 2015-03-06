<?php
//$context = elgg_get_context();
$context = NewsBaseMain::ktform_get_subtype($vars);

$entity = FALSE;
if (isset($vars['entity'])) {
	$entity = $vars['entity'];
}

$is_commentable = NewsBaseMain::ktform_get_entity_comments_support($context, $entity);
$is_likeable = NewsBaseMain::ktform_get_entity_likes_support($context);

if ($is_likeable) {
	echo elgg_view('news/behavior/likes', $vars);
}

if ($is_commentable) {
	echo elgg_view('news/behavior/comments', $vars);
}
?>
<div class="clearfloat">&nbsp;</div>