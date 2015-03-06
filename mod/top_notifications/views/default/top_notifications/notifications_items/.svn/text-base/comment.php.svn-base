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
$annotation = FALSE;
$owner_annotation = FALSE;

$entity = get_entity($notification->object_guid);
$annotation = elgg_get_annotation_from_id($notification->annotation_id);

if ($annotation) {
	$owner_annotation = get_entity($annotation->owner_guid);
}

if (!$entity || !$annotation || !$owner_annotation) {
	return false;
}

$owner_entity = $entity->getOwnerEntity();
if (!$owner_entity) {
	return false;
}

$class_newest_notification = '';
if (isset($notification->read_notification) && $notification->read_notification == 0) {
	$class_newest_notification = 'newestTopNotifications';
}
?>
<div class="reqItem <?php echo $class_newest_notification; ?>">
	<div class="img"><a href="<?php echo $owner_annotation->getURL(); ?> "><img src="<?php echo $owner_annotation->getIconURL('small'); ?>" alt="" /></a></div>
	<div class="txt">
		<p class="nm">
			<a href="<?php echo $owner_annotation->getURL(); ?>"><?php echo $owner_annotation->name; ?></a> <?php echo elgg_echo('top_notifications:activity:action:2'); ?> 
			<a href="<?php echo $entity->getURL() ?>">
				<?php
				$title = $entity->title;
				
				if (empty($title)) {
					$title = elgg_echo('top_notifications:activity:action:this:element');
					
					if (elgg_instanceof($entity, NULL, NULL, 'ElggObject')) {
						switch ($entity->getSubtype()) {
							case 'image':
								$title = elgg_echo('top_notifications:activity:action:4:1');

								if ($entity->getOwnerGUID() == elgg_get_logged_in_user_guid()) {
									$title = elgg_echo('top_notifications:activity:action:4:2');
								}
							break;
							
							case 'thewire':
								$title = elgg_echo('top_notifications:activity:action:thewire:status');

								if ($entity->getOwnerGUID() == elgg_get_logged_in_user_guid()) {
									$title = elgg_echo('top_notifications:activity:action:thewire:your_status');
								}
							break;

							default:
								if ($entity->getOwnerGUID() == elgg_get_logged_in_user_guid()) {
									$title = elgg_echo('top_notifications:activity:action:your:element');
								}
							break;
						}
					}
				}

				echo $title;
				?>
			</a>
		</p>
		<div class="activityListDescription ico2">
			<?php echo elgg_view_friendly_time($notification->posted) ?> <?php echo elgg_echo('top_notifications:activity:time'); ?>
		</div>
	</div>
	<div class="cThis">&nbsp;</div>
</div>