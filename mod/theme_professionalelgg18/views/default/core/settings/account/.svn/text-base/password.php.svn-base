<?php
/**
 * Provide a way of setting your password
 *
 * @package Elgg
 * @subpackage Core
 */

$user = elgg_get_page_owner_entity();

if ($user) {
?>
<div class="elgg-module elgg-module-info">
	<div class="elgg-head">
		<h3><?php echo elgg_echo('user:set:password'); ?></h3>
	</div>
	<div class="elgg-body">
		<?php
			// only make the admin user enter current password for changing his own password.
			if (!elgg_is_admin_logged_in() || elgg_is_admin_logged_in() && $user->guid == elgg_get_logged_in_user_guid()) {
		?>
		<div class="rFrmSet">
			<label class="flLef"><?php echo elgg_echo('user:current_password:label'); ?>:</label>
			<?php echo elgg_view('input/password', array('name' => 'current_password')); ?>
			<div class="clearfloat"></div>
		</div>
		<?php } ?>
		<div class="rFrmSet">
			<label class="flLef"><?php echo elgg_echo('user:password:label'); ?>:</label>
			<?php echo elgg_view('input/password', array('name' => 'password')); ?>
			<div class="clearfloat"></div>
		</div>
		<div class="rFrmSet nmBot">
			<label class="flLef"><?php echo elgg_echo('user:password2:label'); ?>:</label>
			<?php echo elgg_view('input/password', array('name' => 'password2')); ?>
			<div class="clearfloat"></div>
		</div>
	</div>
</div>
<?php
}