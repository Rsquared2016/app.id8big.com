<?php

/**
 * Project objectives
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ProjectGroup)) {
	return true;
}

$objectives = array(
	elgg_echo('projects:objectives:create:lean:canvas') => true,
	elgg_echo('projects:objectives:invite:people') => true,
	elgg_echo('projects:objectives:create:discussions') => false,
	elgg_echo('projects:objectives:create:tasks') => true,
);

$content = '<ul class="projectsObjectivesList">';
foreach ($objectives as $obj => $completed) {
	if ($completed) {
		$class = 'icon-ok-sign';
	}
	else {
		$class = 'icon-remove-sign';
	}
	$content .= '<li><span class="' . $class . '"></span>' . $obj . '</li>';
}
$content .= '</ul>';
?>
<div class="projects-project-objectives projects-profile-box">
	<h3><?php echo elgg_echo('projects:profile:objectives'); ?></h3>
	<?php
		echo elgg_view('groups/profile/module', array(
//			'title' => elgg_echo('gtask:group'),
			'content' => $content,
//			'all_link' => $all_link,
//			'add_link' => $new_link,
		));
	?>
</div>