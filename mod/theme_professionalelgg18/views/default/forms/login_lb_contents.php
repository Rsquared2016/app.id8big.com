<?php
	/**
	 * Elgg login form
	 *
	 * @package Elgg
	 * @subpackage Core
	 */
?>
<div class="loginFrmPopup">
	<div class="loginFrmPopupInner">
		<div class="rFrm">
			<label class="titleLabel"><?php echo elgg_echo('login:username'); ?></label>
			<?php echo elgg_view('input/text', array(
				'name' => 'username',
				'class' => 'elgg-autofocus',
				));
			?>
		</div>
		<div class="rFrm">
			<label class="titleLabel"><?php echo elgg_echo('login:password'); ?></label>
			<?php echo elgg_view('input/password', array('name' => 'password')); ?>
		</div>
		<?php echo elgg_view('login/extend'); ?>
		<div class="rLoginBtn">
			<?php echo elgg_view('input/submit', array('value' => elgg_echo('login:button'), 'class' => 'flLef elgg-button-submit')); ?>
		    <?php
				if (isset($vars['returntoreferer'])) {
					echo elgg_view('input/hidden', array('name' => 'returntoreferer', 'value' => 'true'));
				}
			?>
		    <label class="flLef labelRemember">
				<input type="checkbox" name="persistent" value="true" class="flLef" />
				<span class="flLef"><?php echo elgg_echo('login:remember'); ?></span>
				<span class="cThis"></span>
			</label>
			<div class="clearfloat"></div>
		</div>
		<ul class="ulLoginOptions">
			<?php
				if (elgg_get_config('allow_registration')) {
			?>
			<li><a class="regLink" href="<?php echo elgg_get_site_url(); ?>register"><?php echo elgg_echo('login:register'); ?></a></li>
			<li class="sep">|</li>
			<?php
				}
			?>
		    <li><a class="forgotLink" href="<?php echo elgg_get_site_url(); ?>forgotpassword"><?php echo elgg_echo('login:forgot'); ?></a></li>
		</ul>
		<?php
			// Extend view
			$vars['in_login_lightbox'] = true;
			echo elgg_view('forms/login_lb_contents/extend', $vars);
		?>
	</div>
</div>
<?php
/*
<div class="rFrm rFrmUsrName">
	<label><?php echo elgg_echo('homesite:username'); ?></label>
	<div class="inputMask">
		<?php echo elgg_view('input/text', array(
			'value' => '',
			'name' => 'username',
			'class' => 'txtFrm txtFrmUserLogin',
			));
		?>
	</div>
</div>
<div class="rFrm rFrmPass">
	<label><?php echo elgg_echo('homesite:password'); ?></label>
	<div class="inputMask">
		<?php echo elgg_view('input/password', array(
			'value' => '',
			'name' => 'password',
			'class' => 'txtFrm txtFrmPassLogin',
		)); ?>
	</div>
	<?php echo elgg_view('login/extend', $vars); ?>
</div>
<div class="rBtn"><?php echo elgg_view('input/submit', array('value' => elgg_echo('homesite:login'), 'class' => 'btnLogin')); ?></div>
<?php echo elgg_view('login/extend'); ?>
*/
?>