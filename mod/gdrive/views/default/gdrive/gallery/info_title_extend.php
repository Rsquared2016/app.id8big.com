<?php
//$context = elgg_get_context();
$context = GDriveBaseMain::ktform_get_subtype($vars);

$entity = FALSE;
if (isset($vars['entity'])) {
	$entity = $vars['entity'];
}

$is_commentable = GDriveBaseMain::ktform_get_entity_comments_support($context, $entity);
$is_likeable = GDriveBaseMain::ktform_get_entity_likes_support($context);

if ($is_likeable) {
	echo elgg_view('gdrive/behavior/likes', $vars);
}

if ($is_commentable) {
	echo elgg_view('gdrive/behavior/comments', $vars);
}
?>
<div class="clearfloat">&nbsp;</div>