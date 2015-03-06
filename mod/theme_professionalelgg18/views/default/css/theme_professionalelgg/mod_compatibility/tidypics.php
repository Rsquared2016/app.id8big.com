<?php
	/* tidypics styles */
?>
/* tidypics profile widget */
.elgg-widget-instance-latest_photos .tidypics-gallery-widget {
	overflow: hidden;
	margin: 0 0 5px;
}
.elgg-widget-instance-latest_photos .tidypics-gallery-widget li {
	float: left;
	width: 64px;
	height: 64px;
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	padding: 1px;
	margin: 0 7px 7px 0;
}
.elgg-widget-instance-latest_photos .tidypics-gallery-widget li:nth-child(4n) {
	margin-right: 0;
	padding: 0 0 0 2px;
}
.elgg-widget-instance-latest_photos .tidypics-gallery-widget li .elgg-body > a:first-child { /* why is there an empty <a>? */
	display: none;
}
.elgg-widget-instance-latest_photos .elgg-module-tidypics-image {
	width: auto;
	margin: 0;
	padding: 0;
}
.elgg-widget-instance-latest_photos .elgg-module-tidypics-image a,
.elgg-widget-instance-latest_photos .elgg-module-tidypics-image .elgg-photo {
	display: block;
	text-decoration: none;
	height: 100%;
	width: 100%;
	max-width: none;
}
.elgg-widget-instance-latest_photos .tidypics-gallery-widget li .elgg-head {
	display: none;
}
