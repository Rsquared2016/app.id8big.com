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

// Defines the number of friends per row
//$friends_per_row = 6;

if (isset($vars['friends'])) {
	$friends = $vars['friends'];
} else {
	$friends = circles_search_friends();
}
?>
<ul class="listFriends">
<?php
	if ($friends) {
		$break_max = 6;
		$break_count = 0;
		for ($i = 0; $i < count($friends); $i++) {
			$break_count++;
			if ($break_count == $break_max) {
				$break_count = 0;
				echo "<li class='nmRig'>";
			} else {
				echo "<li>";
			}
			echo elgg_view('circles/listing/friend', array('friend' => $friends[$i], 'listed' => 'friends'));
			echo "</li>";
		}
	}
	else {
		echo '<div><p>'.elgg_echo('circles:section:friends:empty').'</p></div>';
	}
?>
	<div class="clearfloat">&nbsp;</div>
</ul>