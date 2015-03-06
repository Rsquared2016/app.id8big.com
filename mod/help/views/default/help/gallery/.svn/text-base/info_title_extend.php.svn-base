<?php
//$context = elgg_get_context();
$context = HelpBaseMain::ktform_get_subtype($vars);

$entity = FALSE;
if (isset($vars['entity'])) {
	$entity = $vars['entity'];
}

$is_commentable = HelpBaseMain::ktform_get_entity_comments_support($context, $entity);
$is_likeable = HelpBaseMain::ktform_get_entity_likes_support($context);

if ($is_likeable) {
	echo elgg_view('help/behavior/likes', $vars);
}

if ($is_commentable) {
	echo elgg_view('help/behavior/comments', $vars);
}
?>
<div class="clearfloat">&nbsp;</div>