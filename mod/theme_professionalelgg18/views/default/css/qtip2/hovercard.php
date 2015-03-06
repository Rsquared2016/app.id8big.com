<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
.hoverCardCont {
	min-width: 195px;
}
.usrHovPicture,
.usrHovPicture a,
.usrHovPicture a img {
	width: 85px;
	height: 85px;
	background-size: 85px 85px;
	-moz-background-size: 85px 85px;
	-webkit-background-size: 85px 85px;
	display: block;
}
.usrHovPicture {
	margin: 0 10px 0 0;
}
.usrHovMenu {
	width: 100px;
}
.usrHovMenu h2 {
	margin: 0 0 4px;
	font-size: 12px;
	line-height: 14px;
	font-weight: bold;
}
.hsrHovOptions {
	margin: 0 0 10px;
}
.hsrHovOptions li.elgg-state-selected a {
	background: none;
	color: <?php echo $vars['css']['page-mn-sel-background-color']; ?>;
}

.hsrHovOptions li,
.hsrHovOptions li a {
	font-size: 11px;
	line-height: 14px;
}
.hsrHovOptions li a {
	padding: 0;
	text-decoration: none;
	display: inline;
}
.hsrHovOptions li a:hover {
	background: none;
	text-decoration: underline;
}
.hsrHovOptions li a,
.hsrHovOptions li a:hover {
	color: <?php echo $vars['css']['base-light-text-color']; ?>
}
.usrHovBottom .elgg-button {
	margin: 0 8px 0 0;
	font-size: 11px;
}