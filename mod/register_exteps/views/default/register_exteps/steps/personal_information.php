<?php
/**
 * Personal Information tab
 */
$form = new userProfileForm();
$fields = $form->renderFieldsToArray();

$user_type = get_input('user_type', 'normal');
$tabs = register_exteps_get_user_tab($user_type);
$form_action = $vars['url'] . 'action/register/step/personal_information/';
?>

<div class="registerInfo nm">
<h3><?php echo elgg_echo('register_exteps:personal_information:info:title'); ?></h3>
</div>

<form action="<?php echo $form_action ?>" method="POST" class="elgg-form elgg-form-alt elgg-form-registerstep-save">
	<?php echo elgg_view('input/securitytoken') ?>
	<fieldset>
	<?php foreach ($fields as $name => $field) { ?>
    	<div class="regExtProf<?php echo ucwords($name); ?>">
    		<label><?php echo $field['label'] ?><?php if ($field['required']) { ?><span class="required">*</span><?php } ?></label>
			<?php echo $field['field'] ?>
            <?php
                if (array_key_exists('max_length', $field)) {
            ?>
            <p class="note"><?php echo elgg_echo('register_exteps:personal_information:max_length', array($field['max_length'])); ?></p>
            <?php
                }
            ?>
   		</div>
		<?php } ?>
	</fieldset>
	<div class="elgg-foot">
		<div class="elgg-subtext mbm"><?php echo elgg_echo('register_exteps:required:fields') ?></div>
		<input name="submit" type="submit" class="elgg-button elgg-button-submit flRig" rel="<?php echo elgg_echo('register_exteps:buttons:next') ?>" value="<?php echo elgg_echo('register_exteps:buttons:next') ?>" />
		<?php 
			/*if(count($tabs) > 1) {
		?>
			<input name="submit" type="submit" tabindex="9000" rel="profile_image" class="elgg-button flLef backButton" value="<?php echo elgg_echo('register_exteps:buttons:back') ?>" />
		<?php 
			}*/
		?>
		<div class="clearfloat"></div>
	</div>
</form>