<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($vars['notification'])) {
	return false;
}
$notification = $vars['notification'];

$entity = FALSE;

$entity = get_entity($notification->object_guid);

if (!$entity) {
	return false;
}

$class_newest_notification = '';
if (isset($notification->read_notification) && $notification->read_notification == 0) {
	$class_newest_notification = 'newestTopNotifications';
}
?>
<div class="reqItem <?php echo $class_newest_notification; ?>">
	<div class="img"><a href="<?php echo $entity->getURL(); ?>"><img src="<?php echo $entity->getIconURL('small') ?>" alt="" /></a></div>
	<div class="txt">
		<p class="nm">
			<a href="<?php echo $entity->getURL(); ?>"><?php echo $entity->name; ?></a> 
			<?php
				echo elgg_echo('top_notifications:activity:action:0');
			?>
		</p>
		<div class="activityListDescription ico0">
		  <?php echo elgg_view_friendly_time($notification->posted) ?> <?php echo elgg_echo('top_notifications:activity:time'); ?>
		</div>
	</div>
<div class="cThis">&nbsp;</div>
</div>