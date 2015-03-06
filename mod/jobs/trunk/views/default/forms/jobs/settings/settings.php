<?php
/**
 * Edit form body for home html.
 * 
 */

$users_types_can_post = JobsSettings::getUsersTypesCanPost();

$users_types_to_post = JobsSettings::getUsersTypesToPost();

?>
<h3>
	<?php /*echo elgg_echo('jobs:admin:settings:title')*/ ?>
</h3>

<div class="mtm">
	<label><?php echo elgg_echo('jobs:admin:settings:allow_users'); ?>:</label>
	<div class="mtmInputWrapper">
		<?php echo elgg_view('input/checkboxes', array(
			'name' => 'users_types_can_post', 
			'value' => $users_types_can_post,
			'options' => $users_types_to_post,
		))?>
		<div class="infoText"><?php echo ''; ?> </div>
	</div>
</div>

<div class="elgg-foot">
<?php 
//Submit
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('save')));
?>
</div>
