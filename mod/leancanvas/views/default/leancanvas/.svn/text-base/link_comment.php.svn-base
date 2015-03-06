<?php

/*
 * Link Comment
 */

$lean_canvas = elgg_extract('lean_canvas', $vars, false);
if (!($lean_canvas instanceof leanCanvas)) {
	return true;
}

$page_owner = $lean_canvas->getProject();
if (!elgg_instanceof($page_owner, 'group', 'project')) {
    return FALSE;
}

$project_gatekeeper = false;
if (is_callable('project_gatekeeper')) {
    $project_gatekeeper = project_gatekeeper(FALSE);
}

$section_id = elgg_extract('section_id', $vars, '');
if (!$section_id) {
	return true;
}

//if ($lean_canvas->canEdit()) {
if ($project_gatekeeper) {
	$count_comments = $lean_canvas->getCommentsForSection($section_id, array('count' => TRUE));
?>
<?php
	if ($count_comments) {
?>
	<div class="columnSectionCommentBubble"><a class="leancanvas_comments" id="leancanvas_comments_<?php echo $section_id; ?>" href="<?php echo $vars['url']; ?>leancanvas/comments/<?php echo $page_owner->getGUID(); ?>/<?php echo $section_id; ?>"><?php echo $count_comments ?></a></div>
<?php
	}
	elseif ($lean_canvas->canEdit()) {
?>
	<a class="leancanvas_comments" id="leancanvas_comments_<?php echo $section_id; ?>" href="<?php echo $vars['url']; ?>leancanvas/comments/<?php echo $page_owner->getGUID(); ?>/<?php echo $section_id; ?>"><?php echo elgg_echo('leancanvas:add:comment'); ?></a>
<?php
	}
?>
<?php
}
