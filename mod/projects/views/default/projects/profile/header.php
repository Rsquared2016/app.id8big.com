<?php

/**
 * Projects profile header
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ProjectGroup)) {
	return true;
}

// Menu header
//echo elgg_view('projects/profile/menu', $vars);

// Title
$title = elgg_echo('projects:profile:overview');
//$title = elgg_view_title($title, array('class' => 'elgg-heading-main'));

// Menu title
$buttons = elgg_view_menu('title', array(
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

?>
<div class="elgg-head clearfix">
	<?php echo $title.$buttons; ?>
</div>