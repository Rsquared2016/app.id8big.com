<?php
/**
 * Elgg forgotten password.
 *
 * @package Elgg
 * @subpackage Core
 */
?>
<h3 class="stdFrmTitle"><?php echo elgg_echo('user:password:lost'); ?></h3>
<div class="rFrm rFrmTxt">
	<?php echo elgg_echo('user:password:text'); ?>
</div>
<div class="rFrm nmBot">
	<label><?php echo elgg_echo('loginusername'); ?></label>
	<div class="inputBtn">
		<?php echo elgg_view('input/text', array(
			'name' => 'username',
			'class' => 'elgg-autofocus flLef txtFrm',
			));
		?>
		<?php
			echo elgg_view('input/submit', array(
				'value' => elgg_echo('request'),
				'class' => elgg_echo('flLef btnSubmit elgg-button-submit'),
			));
		?>
		<div class="clearfloat"></div>
	</div>
</div>
<?php echo elgg_view('input/captcha'); ?>