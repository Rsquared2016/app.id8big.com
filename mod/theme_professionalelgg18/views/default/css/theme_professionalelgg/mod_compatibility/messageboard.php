<?php
	/* message board styles */
?>
/* message board profile widget */
.elgg-form.elgg-form-messageboard-add {
	margin: 0 0 10px;
	padding: 0 0 10px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-widget-instance-messageboard .elgg-list {
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-widget-content textarea.elgg-input-plaintext.messageboard-input {
	margin-top: 0;
	height: 80px;
}
.elgg-widget-instance-messageboard .elgg-list {
	overflow: auto;
	max-height: 200px;
}
.elgg-widget-instance-messageboard .elgg-list li .elgg-output {
	font-size: <?php echo $vars['css']['widget-list-font-size']; ?>;
	line-height: 1.2;
}
.elgg-widget-instance-messageboard .elgg-list li:last-child {
	margin-bottom: 0;
	border: none;
}
