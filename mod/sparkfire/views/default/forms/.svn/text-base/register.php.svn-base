<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

$password = $password2 = '';
$username = get_input('u');
$email = get_input('e');
$name = get_input('n');

if (elgg_is_sticky_form('register')) {
	extract(elgg_get_sticky_values('register'));
//	elgg_clear_sticky_form('register');
}

?>
<h3 class="stdFrmTitle"><?php echo elgg_echo('register'); ?></h3>
<div class="rFrm clearfix">
	<label><?php echo elgg_echo('register:first_name'); ?> *</label>
	<?php
	echo elgg_view('input/text', array(
		'name' => 'first_name',
		'value' => $first_name,
		'class' => 'elgg-autofocus',
	));
	?>
</div>
<div class="rFrm clearfix">
	<label><?php echo elgg_echo('register:last_name'); ?> *</label>
	<?php
	echo elgg_view('input/text', array(
		'name' => 'last_name',
		'value' => $last_name,
	));
	?>
</div>
<div class="rFrm clearfix">
	<label><?php echo elgg_echo('email'); ?> *</label>
	<?php
	echo elgg_view('input/text', array(
		'name' => 'email',
		'value' => $email,
	));
	?>
</div>
<div class="rFrm clearfix">
	<label><?php echo elgg_echo('username'); ?> *</label>
	<?php
	echo elgg_view('input/text', array(
		'name' => 'username',
		'value' => $username,
	));
	?>
</div>
<div class="rFrm clearfix">
	<label><?php echo elgg_echo('password'); ?> *</label>
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password',
		'value' => $password,
	));
	?>
</div>
<div class="rFrm clearfix">
	<label><?php echo elgg_echo('passwordagain'); ?> *</label>
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password2',
		'value' => $password2,
	));
	?>
</div>
<?php
	// view to extend to add more fields to the registration form
	echo elgg_view('register/extend', $vars);
	// Add captcha hook
	echo elgg_view('input/captcha', $vars);
?>
<div class="rFrm clearfix">
	<label>&nbsp;</label>
	<div class="rBtn flRig clearFix">
		<?php
			if(elgg_is_active_plugin('profile_manager')) {
		?>
		<div class="elgg-subtextnm flLef"><?php echo elgg_echo('profile_manager:register:mandatory'); ?></div>
		<?php
		}
		else {
		?>
		<div class="elgg-subtext flLef"><?php echo elgg_echo('theme:register:infotext'); ?></div>
		<?php
			}
		?>
		<?php
			echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('register'), 'class' => 'elgg-button-submit flRig'));
		?>
	</div>
	<?php
        echo elgg_view('input/hidden', array('name' => 'name','value' => $vars['name']));
		echo elgg_view('input/hidden', array('name' => 'friend_guid', 'value' => $vars['friend_guid']));
		echo elgg_view('input/hidden', array('name' => 'invitecode', 'value' => $vars['invitecode']));
	?>
</div>
<?php
	echo elgg_view('register/after/extend', $vars);
    
if (elgg_is_sticky_form('register')) {
	elgg_clear_sticky_form('register');
}
?>
