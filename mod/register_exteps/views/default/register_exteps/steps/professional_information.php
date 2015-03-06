<?php
/**
 * Professional Information tab
 */
//re_validate_next_steps();
$user = ktform_get_user_entity();
?>
<form action="<?php echo $vars['url'] ?>action/register/step/professional_information/" method="POST" class="elgg-form elgg-form-alt elgg-form-registerstep-save">
	<?php echo elgg_view('input/securitytoken'); ?>
	<fieldset>
		<p class="dniHelperText"><?php echo elgg_echo('register:exteps:professional_information:helper') ?></p>
		<div class="dniFields">
			<label for="dni">DNI:</label>
			<?php echo elgg_view('input/text', array('name' => 'dni', 'id' => "dni", 'value' => $user->dni)) ?></div>
		</div>
	</fieldset>
	<div class="elgg-foot">
		<input name="submit" type="submit" rel="personal_information" class="elgg-button flLef" value="<?php echo elgg_echo('register_exteps:buttons:back') ?>" />
		<input name="submit" type="submit" class="elgg-button elgg-button-submit flRig" rel="<?php echo elgg_echo('register_exteps:buttons:next') ?>" value="<?php echo elgg_echo('register_exteps:buttons:next') ?>" />
		<div class="clearfloat"></div>
	</div>
</form>