<?php

/*
 * Elgg topbar extend
 */
if(!elgg_is_logged_in()) {
	return FALSE;
}

$user_loggedin = elgg_get_logged_in_user_entity();

$is_active_theme = elgg_is_active_plugin('theme_professionalelgg18');

?>
<?php
  // We should return an li element.
?>
<ul class="topNotifications">
<?php
	// INIT NOTIFICATIONS
	if(TOP_NOTIFICATIONS_NOTIFICATIONS_ENABLED) {
?>
	<li class="reqIco ico2">
		<div class="divIco icoNotifications">
		<?php
			$count_activity = top_notifications_get_notifications(array('unread' => TRUE, 'count' => TRUE));
			$activity = top_notifications_get_notifications(array('limit' => 5));
			
			$class_extra = '';
			if (!$count_activity) {
				$class_extra = 'no';
			}
		?>
			<span class="count <?php echo $class_extra; ?>">
				<span class="counter"><?php echo $count_activity; ?></span>
			</span>
		</div>
		<div class="reqList listNotifications mnHideShow <?php if (!$is_active_theme) { echo 'noTheme'; } ?>">
			<div class="reqListInner">
				<h2><?php echo elgg_echo('top_notifications:activity:title'); ?></h2>
				<?php
					if ($activity) {
						foreach ($activity as $act) {
							echo elgg_view($act->view, array('notification' => $act));
						}
					} else {
				?>
					<div class="riEmpty">
						<div class="reqItemEmpty">
							<p><?php echo elgg_echo('top_notifications:activity:empty'); ?></p>
						</div>
					</div>
				<?php
					}
				?>
				<?php // View all ?>
				<div class="viewAll">
					<p><a href="<?php echo $vars['url'] ?>top_notifications/notifications"><?php echo elgg_echo('top_notifications:activity:view_all'); ?></a></p>
				</div>
			</div>
		</div>
	</li>
<?php
	}
	// FIN NOTIFICATIONS
?>
<?php
	// INI MESSAGES
	$enabled_messages = elgg_is_active_plugin('messages');
	if ($enabled_messages && TOP_NOTIFICATIONS_MESSAGES_ENABLED) {
		$limit_messages = 5;
		$count_messages = top_notifications_get_messages(array('unread' => TRUE, 'count' => TRUE));
		$messages = top_notifications_get_messages(array('limit' => $limit_messages));
?>
	<li class="reqIco ico0 messageListTop">
		<div class="divIco">
		<?php
			if($count_messages) {
		?>
			<span class="count">
				<span class="counter"><?php echo $count_messages; ?></span>
			</span>	
		<?php
			}
		?>
		</div>
		<div class="reqList mnHideShow <?php if (!$is_active_theme) { echo 'noTheme'; } ?>">
			<div class="reqListInner">
				<h2><?php echo elgg_echo('top_notifications:messages:title'); ?></h2>
				<?php
					if ($messages) {
						$ts = time();
						$token = generate_action_token($ts);
						
						foreach ($messages as $m) {
							$user_from = get_entity($m->fromId);
							
							if (elgg_instanceof($user_from, NULL, NULL, 'ElggUser') || elgg_instanceof($user_from, null, null, 'ElggSite')) {
								$class_newest_notification = '';
								if (empty($m->readYet)) {
									$class_newest_notification = 'newestTopNotifications';
								}
				?>
						<div class="reqItem <?php echo $class_newest_notification; ?>">
							<?php if(elgg_instanceof($user_from, null, null, 'ElggUser')) { ?>
							<div class="img"><a href="<?php echo $user_from->getURL(); ?>"><img src="<?php echo $user_from->getIconURL('small'); ?>" alt="" /></a></div>
							<?php } ?>
							<div class="txt">
								<p class="notMessage">
									<a href="<?php echo $m->getURL(); ?>">
									<?php
										echo sprintf(elgg_echo('top_notifications:messages:notification:from'), $user_from->name);
									?>
									</a>
								</p>
								<div class="activityListDescription descMessage">
									<?php echo elgg_get_excerpt($m->description, 30); ?>
								</div>
							</div>
							<div class="cThis">&nbsp;</div>
						</div>
				<?php
							}
						}
					} else {
						// No messages
				?>
					<div class="riEmpty">
						<div class="reqItemEmpty">
							<p><?php echo elgg_echo('top_notifications:messages:empty'); ?></p>
						</div>
					</div>
				<?php
					}
				?>
				<?php // View all ?>
				<div class="viewAll">
					<p><a href="<?php echo $vars['url'] ?>messages/inbox/<?php echo $user_loggedin->username; ?>"><?php echo elgg_echo('top_notificatinos:messages:view_all'); ?></a></p>
					<?php
						if ($limit_messages < $count_messages) {
					?>
						<p class="pUnanswered"><?php echo $count_messages; ?> <?php echo elgg_echo('top_notifications:messages:unread'); ?></p>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</li>
<?php
	}
	// FIN MESSAGES
?>
<?php
	// INI FRIEND REQUEST
	$enabled_friend_request = elgg_is_active_plugin('friend_request');
	if ($enabled_friend_request && TOP_NOTIFICATIONS_FRIEND_REQUIEST_ENABLED) {
		$limit_friend_request = 5;
		$count_friend_request = top_notifications_get_friend_request(array('count' => TRUE));
		$friend_request = top_notifications_get_friend_request(array('limit' => $limit_friend_request));
?>
	<li class="reqIco ico1">
		<div class="divIco">
		<?php
			if ($count_friend_request) {
		?>
			<span class="count">
				<span class="counter"><?php echo $count_friend_request; ?></span>
			</span>
		<?php
			}
		?>
		</div>
		<div class="reqList mnHideShow <?php if (!$is_active_theme) { echo 'noTheme'; } ?>">
			<div class="reqListInner">
				<h2><?php echo elgg_echo('top_notifications:friend_request:title'); ?></h2>
				<?php
					if ($count_friend_request) {
						$ts = time();
						$token = generate_action_token($ts);
						foreach ($friend_request as $fr) {
				?>
						<div class="reqItem">
							<div class="img"><a href="<?php echo $fr->getURL(); ?>"><img src="<?php echo $fr->getIconURL('small'); ?>" alt="" /></a></div>
							<div class="txt">
								<p><a href="<?php echo $fr->getURL(); ?>"><?php echo $fr->name; ?></a> 
								<?php
									$message = elgg_echo('top_notifications:friend_request:notification');
									echo $message;
								?>
								</p>
								<div class="buttons">
									<a href="<?php echo $vars['url']; ?>action/friend_request/approve?guid=<?php echo $fr->guid; ?>&__elgg_ts=<?php echo $ts; ?>&__elgg_token=<?php echo $token; ?>" class="aYes"><?php echo elgg_echo('top_notifications:friend_request:approve'); ?></a>
									<a href="<?php echo $vars['url']; ?>action/friend_request/decline?guid=<?php echo $fr->guid; ?>&__elgg_ts=<?php echo $ts; ?>&__elgg_token=<?php echo $token; ?>" class="aNo"><?php echo elgg_echo('top_notifications:friend_request:decline'); ?></a>
									<div class="cThis">&nbsp;</div>
								</div>
							</div>
							<div class="cThis">&nbsp;</div>
						</div>
				<?php
						}
					} else {
						// No friend requests
				?>
					<div class="riEmpty">
						<div class="reqItemEmpty">
							<p><?php echo elgg_echo('top_notifications:friend_request:empty'); ?></p>
						</div>
					</div>
				<?php
					}
				?>
				<?php // View all ?>
				<div class="viewAll">
					<p><a href="<?php echo $vars['url'] ?>friend_request"><?php echo elgg_echo('top_notificatinos:friend_request:view_all'); ?></a></p>
					<?php
						if ($limit_friend_request < $count_friend_request) {
					?>
						<p class="pUnanswered"><?php echo $count_friend_request; ?> <?php echo elgg_echo('top_notifications:friend_request:unanswered'); ?></p>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</li>
<?php
	}
	// FIN FRIEND REQUEST
?>
</ul>