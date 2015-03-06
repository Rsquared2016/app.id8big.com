<?php

/**
 * Item Gallery
 */

$picture = $vars['picture'];
$url = $vars['item_url'];
$class = $vars['class'];

if (!$class) {
	$class = "";
}

$title = $vars['title'];
if (!$title) {
	$title = "";
}

$item_size = $vars['item_size'];
if (preg_match("/\<img/", $picture)) {
	$img = $picture;
}
else {
	$img = "<img alt=\"$title\" src=\"$picture\" />";
}
	
if ($picture) {
?>
	<li class="<?php echo $class ?> <?php echo "pic-$item_size"?>">
<?php 
	if ($url) {
?>
		<a href="<?php echo $url ?>" title="<?php echo $title ?>" <?php if($vars['subtype'] == 'izap_videos') { echo 'class="izapACont"'; } ?>>
<?php 
	}
	echo $img;
	if($vars['subtype'] == 'izap_videos') {
		echo '<span class="izapPlay"></span>';
	}
?>
<?php 
	if ($url) {
?>		
		</a>
<?php 
	}
?>	
	</li>
<?php
}
