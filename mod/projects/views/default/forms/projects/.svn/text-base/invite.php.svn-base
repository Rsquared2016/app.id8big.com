<?php
/**
 * Elgg projects invite form
 *
 * @package ElggProjects
 */
$project = $vars['entity'];

if (!($project instanceof ProjectGroup)) {
	return FALSE;
}


$forward_url = $project->getURL();

$invitation_types = project_get_invite_type_options(array('selectable' => FALSE));

?>

<div>
	<label for="invite_types"><?php echo elgg_echo('projects:invite:form:type'); ?></label>
	<?php
	echo elgg_view('input/dropdown', array('name' => 'invite_type', 'options_values' => $invitation_types, 'id' => 'invite_types'));
	?>
</div>
<div>
	<label for="invite_description"><?php echo elgg_echo('projects:invite:form:description'); ?></label>
	<?php
	echo elgg_view('input/longtext', array('name' => 'description', 'id' => 'invite_description' ));
	?>
</div>

<div>
	<label for="userprojectpicker-element"><?php echo elgg_echo('projects:invite:form:users'); ?></label>
	<?php
	echo elgg_view('input/userprojectpicker', $vars);
	?>
</div>



<?php
echo '<div class="elgg-foot">';
echo elgg_view('input/hidden', array('name' => 'forward_url', 'value' => $forward_url));
echo elgg_view('input/hidden', array('name' => 'project_guid', 'value' => $project->guid));
echo elgg_view('input/submit', array('value' => elgg_echo('invite')));
echo '</div>';