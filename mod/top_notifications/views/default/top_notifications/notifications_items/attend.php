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
$owner = FALSE;

$entity = get_entity($notification->object_guid);
if ($entity) {
	$owner = get_entity($entity->owner_guid);
}

if (!$entity || !$owner) {
	return false;
}

$title = $entity->title;

$class_newest_notification = '';
if (isset($notification->read_notification) && $notification->read_notification == 0) {
	$class_newest_notification = 'newestTopNotifications';
}
?>
<div class="reqItem <?php echo $class_newest_notification; ?>">
	<div class="img"><a href="<?php echo $owner->getURL(); ?> "><img src="<?php echo $owner->getIconURL('small'); ?>" alt="" /></a></div>
	<div class="txt">
		<p class="nm">
			<a href="<?php echo $owner->getURL(); ?>"><?php echo $owner->name; ?></a>
			<?php
				echo elgg_echo('top_notifications:activity:action:1');
				if (!empty($title)) {
					echo elgg_echo('top_notifications:activity:action:1:1');
				}
			?> 
			<a href="<?php echo $entity->getURL() ?>">
				<?php
					if (empty($title)) {
						$title = elgg_echo('top_notifications:activity:action:1:2');
					}
					echo $title;
				?>
			</a>
		</p>
		<div class="activityListDescription ico1">
		  <?php echo elgg_view_friendly_time($notification->posted) ?> <?php echo elgg_echo('top_notifications:activity:time'); ?>
		</div>
	</div>
	<div class="cThis">&nbsp;</div>
</div>