<?php
/**
 * Projects latest project_activity
 *
 * @todo add people joining project to project_activity
 * 
 * @package Projects
 */

if ($vars['entity']->project_activity_enable == 'no') {
	return true;
}

$project = $vars['entity'];
if (!$project) {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "projects/project_activity/$project->guid",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));


elgg_push_context('widgets');
$db_prefix = elgg_get_config('dbprefix');
$content = elgg_list_river(array(
	'limit' => 4,
	'pagination' => false,
	'joins' => array("JOIN {$db_prefix}entities e1 ON e1.guid = rv.object_guid"),
	'wheres' => array("(e1.container_guid = $project->guid)"),
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('projects:project_activity:none') . '</p>';
}

//// Add form thewire
//if ($vars['entity']->project_thewire_enable == 'yes' && $vars['entity']->canWriteToContainer()) {
//	$form_vars = array('class' => 'thewire-form');
//	$thewire_form = elgg_view_form('thewire/add', $form_vars);
//
//	$content = $thewire_form . $content;
//}

?>
<div class="projects-profile-activity projects-profile-box">
	<h3><?php echo elgg_echo('projects:profile:activity'); ?></h3>
<?php
	echo elgg_view('groups/profile/module', array(
//		'title' => elgg_echo('projects:profile:activity'),
		'content' => $content,
		'all_link' => $all_link,
	));
?>
</div>