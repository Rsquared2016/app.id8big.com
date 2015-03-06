<?php
/**
 * File CSS extender 
 * 
 * @package ElggFile
 */
?>
.bodyFile .elgg-main .file-photo {
	text-align: center;
	margin-bottom: 15px;
}
.bodyFile .threeCol .elgg-main .file-photo img {
	max-width: 516px;
}
/* gallery display */
.bodyFile .elgg-main ul.elgg-gallery {
	margin: 0;
	overflow: hidden;
}
.bodyFile .elgg-main ul.elgg-gallery li.elgg-item,
.bodyFile .elgg-main .file-gallery-item {
	overflow: hidden;
	height: 150px;
	float: left;
}
.bodyFile .threeCol .elgg-main ul.elgg-gallery li.elgg-item,
.bodyFile .threeCol .elgg-main .file-gallery-item {
	height: 135px;
}
.bodyFile .elgg-main ul.elgg-gallery li.elgg-item {
	margin-bottom: 20px;
	padding: 0 0 8px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.bodyFile .twoCol .elgg-main ul.elgg-gallery li.elgg-item {
	margin-right: 17px;
	width: 145px;
}
.bodyFile .twoCol .elgg-main ul.elgg-gallery li.elgg-item:nth-child(5n) {
	margin-right: 0;
}
.bodyFile .threeCol .elgg-main ul.elgg-gallery li.elgg-item {	/* less margin when we are using three columns */
	margin-right: 53px;
	width: 235px;
}
.bodyFile .threeCol .elgg-main ul.elgg-gallery li.elgg-item:nth-child(2n) {
	margin-right: 0;
}
.bodyFile .elgg-main .file-gallery-item {
	text-align: left;
	width: 100%;
}
.bodyFile .elgg-main .file-gallery-item h3 {
	font-size: 12px;
	line-height: 15px;
	height: 15px;
	font-weight: bold;
	text-overflow: ellipsis;
	-o-text-overflow: ellipsis;
	-webkit-text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	margin: 0 0 10px;
}
.bodyFile .elgg-main .file-gallery-item > a {
	display: block;
	text-align: center;
	height: 80px;
	margin: 0 0 8px;
	overflow: hidden;
}
.bodyFile .elgg-main .file-gallery-item > a,
.bodyFile .elgg-main .elgg-item .file-gallery-item > a img {
	max-height: 100%;
	max-width: 100%;
}
.bodyFile .elgg-main .elgg-item .file-gallery-item > a img {
	width: auto;
	height: auto;
	display: inline;
}
.bodyFile elgg-main .file-gallery-item p.subtitle {
	margin: 0;
	font-size: 11px;
	line-height: 13px;
	height: 26px;
}
.bodyFile .threeCol .elgg-main .file-gallery-item p.subtitle {
	height: 13px;
}