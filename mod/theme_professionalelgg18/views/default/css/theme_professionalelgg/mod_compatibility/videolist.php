<?php
	/* videolist styles */
?>
.elgg-widget-instance-videolist .elgg-image-block .elgg-image {
	width: 100px;
	height: 75px;
	position: relative;
	z-index: 10;
}
.elgg-widget-instance-videolist .elgg-image-block .elgg-image a,
.elgg-widget-instance-videolist .elgg-image-block .elgg-image img {
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
}
.elgg-widget-instance-videolist .elgg-image-block .elgg-image a {
	background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>img-play-video.png) 50% 50% no-repeat;
}
.elgg-widget-instance-videolist .elgg-image-block .elgg-image img {
	z-index: -1;
}