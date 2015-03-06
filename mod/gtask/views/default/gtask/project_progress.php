<?php

/**
 * Project progress
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ProjectGroup)) {
	return true;
}

if ($entity->gtask_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "gtask/group/$entity->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

// Get total task
$options = array(
	'type' => 'object',
	'subtype' => 'gtask',
	'container_guid' => $entity->guid,
	'count' => TRUE,
);
$total_gtask = elgg_get_entities($options);
if (empty($total_gtask)) {
	return true;
}

// Get task completed
$options = array(
	'type' => 'object',
	'subtype' => 'gtask',
	'container_guid' => $entity->guid,
	'metadata_name_value_pairs' => array(
		array('name' => 'status', 'value' => 'finished'),
	),
	'count' => TRUE,
);
$gtask_completed = elgg_get_entities_from_metadata($options);

// Get percentage
$percentage = 0;
if ($total_gtask > 0) {
	$percentage = floor($gtask_completed/$total_gtask*100);
}

// Get text
$text = elgg_echo('gtask:projects:progress:text', array(
	$gtask_completed,
	$total_gtask,
	$percentage.'%',
));

$content = <<<___HTML
<div class="gtaskprogressbar">
	<div class="gtaskprogressInner porc$percentage"></div>
</div>
<script type="text/javascript">
	$(document).ready(
		function() {
			$('.gtaskprogressInner').animate({'width': '$percentage%'}, 2000);
		}
	);
</script>
<div class="gtaskprogresstext">
	$text
</div>
___HTML;

?>
<div class="gtask-project-progress projects-profile-box">
	<h3><?php echo elgg_echo('gtask:projects:progress'); ?></h3>
	<?php
		echo elgg_view('groups/profile/module', array(
//			'title' => elgg_echo('gtask:group'),
			'content' => $content,
//			'all_link' => $all_link,
//			'add_link' => $new_link,
		));
	?>
</div>