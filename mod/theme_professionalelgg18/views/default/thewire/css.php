<?php
/**
 * The Wire CSS
 */

?>
/* The Wire */
.thewire-form {
	padding: 0 0 10px;
	margin: 0 0 10px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
/* the wire section */
#thewire-textarea {
	height: 40px;
	width: 513px;
	margin: 0 0 10px;
}
.threeCol #thewire-textarea {
	width: 513px;
}
#thewire-characters-remaining,
.thewire-characters-remaining {
	text-align: right;
	float: right;
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
	font-size: 10px;
	line-height: 12px;
	margin: 9px 0 0 0;
}
.thewire-parent {
	margin-left: 40px;
	padding: 12px 0 0 0;
}
/* wire status' on profile section */
.wire-status {
    padding: 8px;
}
.wire-status p {
	margin: 0;
}
.wire-status p,
.wire-status .elgg-body {
	font-size: 11px;
	line-height: 14px;
}
.wire-status .elgg-image-block {
    padding: 0;
}