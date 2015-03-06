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
$owner_tagged = FALSE;

$entity = get_entity($notification->object_guid);
if ($entity) {
	// OLD
//	$annotations = get_annotations($entity->getGUID(), 'object', 'image', 'phototag');
	
	$options = array(
		'guid' => $entity->getGUID(),
		'type' => 'object',
		'subtype' => 'image',
		'annotation_name' => 'phototag',
	);
	$annotations = elgg_get_annotations($options);
	if ($annotations) {
		foreach ($annotations as $annot) {
			$object = unserialize($annot->value);
			if ($object && $object->value == $notification->subject_guid) {
				$owner_tagged = get_entity($annot->owner_guid);
				break;
			}
		}
	}
}

if (!$entity || !$owner_tagged) {
	return false;
}

$class_newest_notification = '';
if (isset($notification->read_notification) && $notification->read_notification == 0) {
	$class_newest_notification = 'newestTopNotifications';
}
?>
<div class="reqItem <?php echo $class_newest_notification; ?>">
	<div class="img"><a href="<?php echo $owner_tagged->getURL(); ?> "><img src="<?php echo $owner_tagged->getIconURL('small'); ?>" alt="" /></a></div>
	<div class="txt">
		<p class="nm">
			<a href="<?php echo $owner_tagged->getURL(); ?>"><?php echo $owner_tagged->name; ?></a> <?php echo elgg_echo('top_notifications:activity:action:4'); ?> 
			<a href="<?php echo $entity->getURL() ?>">
				<?php
					$title = $entity->title;
					if (empty($title)) {
						$title = elgg_echo('top_notifications:activity:action:4:1');
						if ($entity->getOwnerGUID() == elgg_get_logged_in_user_guid()) {
							$title = elgg_echo('top_notifications:activity:action:4:2');
						}
					}
					echo $title;
				?>
			</a>
		</p>
		<div class="activityListDescription ico4">
		  <?php echo elgg_view_friendly_time($notification->posted) ?> <?php echo elgg_echo('top_notifications:activity:time'); ?>
		</div>
	</div>
	<div class="cThis">&nbsp;</div>
</div>