<?php

/**
 * leancanvas/comments
 */

// Page owner
$page_owner = elgg_extract('page_owner', $vars, elgg_get_page_owner_entity());
if (!($page_owner instanceof ProjectGroup)) {
	return false;
}

// Get comments
$comments = elgg_extract('comments', $vars, '');

// Lean canvas
$lean_canvas = new leanCanvas($page_owner);

// Section
$section_id = elgg_extract('section_id', $vars, '');
$section = $lean_canvas->getSection($section_id);
if (empty($section)) {
	return false;
}

$form_comment = '';
if ($lean_canvas->canEdit()) {
    $action = 'leancanvas/add_comment';
    $body_vars = array(
        'section_id' => $section_id,
        'page_owner' => $page_owner->getGUID(),
    );
    $form_comment =  elgg_view_form($action, array(), $body_vars);
}
?>
<div class="commentsLeanCanvasWrapper">
    <?php
        if (!empty($form_comment)) {
    ?>
	<div class="commentFormWrapper">
		<?php echo $form_comment; ?>
	</div>
    <?php
        }
    ?>
	<div class="commentsWrapper">
		<?php echo $comments; ?>
	</div>
</div>