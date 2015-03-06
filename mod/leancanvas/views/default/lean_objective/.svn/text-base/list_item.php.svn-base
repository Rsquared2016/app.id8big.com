<?php

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof leanObjective)) {
	return;
}

$entity_guid = $entity->getGUID();
$task_description = $entity->getTitle();
$task_color = $entity->getColor();
$section = $entity->getSection();
$container_guid = $entity->getContainerGUID();

$delete_url = $entity->getDeleteURL();

$compass_status = $entity->compass_status;
$compass_status_class = '';
if($compass_status) {
	$compass_status_class = $compass_status;
	switch ($compass_status) {
		case 'validated':
			$compass_status_item = elgg_view_icon('checkmark');
			break;
		case 'unvalidated':		
			$compass_status_item = elgg_view_icon('delete');
			break;
	}
}

?>
<div class="canvasItem objective_<?php echo $task_color; ?>" id="lean_objective_<?php echo $entity_guid ?>" data-guid="<?php echo $entity_guid; ?>" data-color="<?php echo $task_color; ?>" data-section="<?php echo $section ?>" data-container-guid="<?php echo $container_guid; ?>">
	<div class="canvasItemDescription"><?php echo $task_description ?></div>
	<?php if($compass_status_class) {  ?>
	<div class="canvasItemDone flRig <?php echo $compass_status_class; ?>">
		<?php echo $compass_status_item; ?>
	</div>
	<?php } ?>
	<?php if ($entity->canEdit()) { ?>
		<div class="canvasItemActions flRig">
			<a class="delete_objective flRig aEditObj" href="<?php echo $delete_url ?>" title="<?php echo elgg_echo('leancanvas:objective:delete'); ?>">x</a>
			<a class="edit_objective flRig aEditObj" href="javascript:void(0);" title="<?php echo elgg_echo('leancanvas:objective:edit'); ?>"></a>
		</div>
		<div class="clearfloat"></div>
	<?php } ?>
</div>
