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

$area1 = elgg_view('circles/title');
$area2 = elgg_view('forms/circles/search');
$area3 = elgg_view('circles/listing/list_friends');
$area4 = elgg_view('circles/listing/list_circles');

// Title
echo $area1;

// Form Search
echo $area2;

?>
<?php // List friends ?>
<div class="friendsContainer fc1">
	<h3><?php echo elgg_echo('circles:section:friends'); ?></h3>
	<div class="searchResultFriends">
		<?php
			// Result of the search for friends
			echo $area3;
		?>
	</div>
</div>
<?php // List circles ?>
<div class="friendsContainer fc2">
	<h3>
		<span class="flLef"><?php echo elgg_echo('circles:section:circles'); ?></span>
		<span class="flRig"><?php echo elgg_echo('circles:section:circles:note'); ?></span>
	</h3>
	<div class="circlesContainer">
		<?php echo $area4; ?>
		<div class="clearfloat">&nbsp;</div>
	</div>
</div>