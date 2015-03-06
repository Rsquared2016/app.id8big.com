<?php

/*
 * This should add the output of a video.
 */
//Old.
//Youtube iframe url: http://www.youtube.com/embed/GUBf14Bgny8
//Vimoe iframe url: http://player.vimeo.com/video/25945509?title=0&amp;byline=0&amp;portrait=0

$width = 640; //560
$height = 390; //349

if($vars['width']) {
	$width = $vars['width'];
}

if($vars['height']) {
	$height = $vars['height'];
}
if($vars['entity']) {
	$urlFeed = new HelpBaseUrlFeed();
	$video = $urlFeed->getPlayer($vars['entity'], $width, $height);
} else {
	return false;
}
?>

<div class="ktFrmVideo">
	<?php echo $video; ?>
</div>

