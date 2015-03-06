<?php

/*
 * Form Events Invite
 */

$entity = elgg_extract('entity', $vars, null);
if (!elgg_instanceof($entity, '', '', 'Events')) {
	return false;
}

$logged_in_user = elgg_get_logged_in_user_entity();
//$friends = $logged_in_user->getFriends("", 9999);
$friends = $logged_in_user->getFriendsOf("", 9999);
?>
<div class="elgg-user-picker">
	<form class="elgg-form" action="<?php echo $vars['url'] . 'action/events/event/invite'; ?>" id="formEventsInvite" method="POST">
		<?php echo elgg_view('input/securitytoken'); ?>
		<fieldset>
			<div>
				<label><?php echo elgg_echo('events:form:invite:users'); ?></label>
				<div class="clearfloat"></div>
				<?php
//					echo elgg_view('input/invite_users', $vars);
					echo elgg_view('input/friendspicker', array_merge($vars, array(
						'entities' => $friends,
						'name' => 'user_destination',
						'highlight' => 'all',
					)));
				?>
				<div class="clearfloat"></div>
			</div>
			<div class="elgg-foot">
				<?php
					echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->getGUID()));
					echo elgg_view('input/submit', array('name' => 'invite', 'class' => 'elgg-button elgg-button-submit', 'value' => elgg_echo('events:form:invite:invite')));
				?>
			</div>
		</fieldset>
		<?php /* holds selected users' list */ ?>
		<?php /*<ul class="elgg-user-picker-list"></ul>*/ ?>
	</form>
</div>