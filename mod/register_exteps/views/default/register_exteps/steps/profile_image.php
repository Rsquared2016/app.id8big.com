<?php
/**
 * Profile Image tab
 */
$user = ProfileComplete::get_user_entity();

if (!$user) {
    forward();
}

?>
<form action="<?php echo $vars['url'] ?>action/register/step/profile_icon/" class="elgg-form elgg-form-alt elgg-form-register-ex" method="post" enctype="multipart/form-data">
    <?php echo elgg_view('input/securitytoken') ?>
	<div class="registerExImg">
	    <img src="<?php echo $user->getIcon('large') ?>" alt="User Image" />
	</div>
	<div class="registerExImgTxt"><?php echo elgg_echo("register_exteps:register:label:picture") ?></div>
	<div class="registerExFileInput"><?php echo elgg_view('input/file', array('name' => 'avatar', 'class' => 'regExFileInput')) ?></div>
	<div class="elgg-foot">
		<div class="elgg-subtext"><?php echo elgg_echo('register_exteps:profile_icon:note') ?></div>
		<input name="submit" type="submit" class="elgg-button elgg-button-submit flRig" rel="<?php echo elgg_echo('register_exteps:buttons:next') ?>" value="<?php echo elgg_echo('next') ?>">
		<div class="clearfloat"></div>
	</div>
</form>