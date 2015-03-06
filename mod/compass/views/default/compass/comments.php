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

$comment_type = elgg_extract('comment_type', $vars);
$entity_guid = elgg_extract('entity_guid', $vars);
$entity = get_entity($entity_guid);
if (!elgg_instanceof($entity, 'object', 'lean_objective')) {
    return FALSE;
}

$form_comment = '';
if ($entity->canEdit()) {
    $action = 'compass/add_comment';
    $body_vars = array(
        'entity_guid' => $entity_guid,
        'comment_type' => $comment_type,
        'page_owner' => $page_owner->getGUID(),
    );
    $form_comment = elgg_view_form($action, array(), $body_vars);
}
$comment_type = elgg_extract('comment_type', $vars, '');
?>
<div class="commentsCompassWrapper">
    <h3><?php echo elgg_echo("compass:comments:{$comment_type}:add"); ?></h3>
    <?php if (!empty($form_comment)) { ?>
	<div class="commentFormWrapper">
		<?php echo $form_comment; ?>
	</div>
    <?php } ?>
	<div class="commentsWrapper">
		<?php echo $comments; ?>
	</div>
</div>