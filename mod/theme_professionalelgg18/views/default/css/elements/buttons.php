<?php
/**
 * CSS buttons
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* dropdown button */
.elgg-button-dropdown {
	padding: 2px 5px;
	text-decoration: none;
	display: block;
	position: relative;
	margin: 0;
    color: <?php echo $vars['css']['button-font-color']; ?>;
	border: <?php echo $vars['css']['button-border']; ?>;
	background: <?php echo $vars['css']['button-background-color']; ?>;
}
.elgg-button-dropdown:hover {
	color: <?php echo $vars['css']['button-font-color-hover']; ?>;
	border: <?php echo $vars['css']['button-border-hover']; ?>;
	background: <?php echo $vars['css']['button-background-color-hover']; ?>;
	text-decoration: none;
}
.elgg-button-dropdown.elgg-state-active {
	background: <?php echo $vars['css']['button-background-color-hover']; ?>;
	outline: none;
	color: <?php echo $vars['css']['button-font-color-hover']; ?>;
	border: <?php echo $vars['css']['button-border-hover']; ?>;
}
