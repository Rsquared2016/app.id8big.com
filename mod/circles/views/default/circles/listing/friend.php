<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$friend = false;
if (isset($vars['friend'])) {
	$friend = $vars['friend'];
}

$circle = false;
if (isset($vars['circle'])) {
	$circle = $vars['circle'];
}

$listed = '';
if (isset($vars['listed'])) {
	$listed = $vars['listed'];
}

$size = 'medium';

if (elgg_instanceof($friend, 'user')) {
?>
	<div class="cFriend">
	<?php
		if ($listed == 'friends') {
	?>
			<h5 class="nameFriend"><?php echo elgg_get_excerpt($friend->name, 10); ?></h5>
	<?php
		}
	?>
		<div class="img">
			<img src="<?php echo $friend->getIconURL($size); ?>" title="<?php echo $friend->name; ?>" />
		</div>
		<?php
			if ($listed == 'circles' && $circle) {
		?>
					<div class="deleteFriendCont">
						<a class="deleteFriend" href="<?php echo $vars['url']; ?>mod/circles/endpoint/deletefriend.php?callback=1&circle_id=<?php echo $circle->id; ?>&friend_id=<?php echo $friend->getGUID(); ?>">
							<?php echo elgg_echo('circles:remove') ?>
						</a>
					</div>
		<?php
			}
		?>
		<input type="hidden" class="friendId" value="<?php echo $friend->getGUID(); ?>" />
	</div>
<?php
}
?>