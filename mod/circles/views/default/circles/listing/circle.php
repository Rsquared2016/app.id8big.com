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

// Define the number of friends per row in a circle
$friends_per_row = 3;

// Define the number of friends to display
$number_of_friends = 6;

$circle = false;
if (isset($vars['circle'])) {
	$circle = $vars['circle'];
}

if ($circle) {
	// Get members of circle
	$friends = get_members_of_access_collection($circle->id, false);
	if ($friends) {
		$count_friends = count($friends);
	}
	else {
		$count_friends = 0;
	}

	if ($count_friends < $number_of_friends) {
		$number_of_friends = $count_friends;
	}
?>
<div class="cCircle <?php echo $vars['break_class']; ?>">
	<h5>
		<?php
			$circle_name = $circle->name;
		?>
		<a href="#" class="circle_name" title="<?php echo $circle_name; ?>">
		<?php
			$max_chars = 17;
			if(strlen($circle_name) > $max_chars) {
				$circle_name = substr($circle->name, 0, $max_chars) . '...';
			}
			echo elgg_echo('circles:section:circles:name', array($circle_name));
		?>
			(<span class="count_friends"><?php echo $count_friends; ?></span>)
		</a>
		<?php
			// Delete circle
			if (can_edit_access_collection($circle->id) && elgg_is_logged_in()) {
				$delete_url = $vars['url'] . 'action/circles/delete?circle_id='.$circle->id;
				$delete_url = elgg_add_action_tokens_to_url($delete_url);
				echo elgg_view('output/confirmlink', array(
					'href' => $delete_url,
					'text' => '-',
					'class' => 'circle_delete',
					'title' => elgg_echo('circles:delete:circle'),
				));
			}
		?>
	</h5>
	<ul class="listFriendsCircle">
		<?php
			if ($friends) {
				$break_max = 3;
				$break_count = 0;
				for ($i = 0; $i < $number_of_friends; $i++) {
					$break_count++;
					if($break_count == $break_max) {
						$break_count = 0;
						echo "<li class='nmRig'>";
					}
					else {
						echo "<li>";
					}

					echo elgg_view('circles/listing/friend', array('friend' => $friends[$i], 'circle' => $circle, 'listed' => 'circles'));
					echo "</li>";
				}
			}
		?>

	</ul>
	<input type="hidden" class="circleId" value="<?php echo $circle->id; ?>" />
</div>
<?php
}