<?php
	/* static top menu */
?>
/* top menu */
#mnSiteTop .elgg-menu-site-default {
    background: <?php echo $vars['css']['site-mn-base-color']; ?>;
    border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
    -moz-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
    -webkit-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
    height: 34px;
    list-style: none;
    margin: 0 0 14px;
    padding: 0;
    position: relative;
    z-index: 12;
    display: block;
}
#mnSiteTop .elgg-menu-site-default > li {
	margin: 0;
	float: left;
	border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
}
#mnSiteTop .elgg-menu-site-default > li a {
	color: <?php echo $vars['css']['site-mn-font-color']; ?>;
	display: block;
    font-size: 12px;
    line-height: 32px;
    padding: 0 12px;
    text-align: center;
    text-decoration: none;
    border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    border-left: none;
    margin: 0;
}
#mnSiteTop .elgg-menu-site-default  a {
	outline: none;
}
#mnSiteTop .elgg-menu-site-default .elgg-state-selected a,
#mnSiteTop .elgg-menu-site-default a:hover,
#mnSiteTop .elgg-menu-site-default.mainMnOn a {
	background-color: <?php echo $vars['css']['site-mn-background-color-hover']; ?>;
    border-color: <?php echo $vars['css']['base-border-color']; ?>;
    color: <?php echo $vars['css']['site-mn-font-color-hover']; ?>;
}
#mnSiteTop .elgg-menu-site-default > li:first-child,
#mnSiteTop .elgg-menu-site-default > li:first-child a {
	border-radius: <?php echo $vars['css']['site-mn-radius']; ?> 0 0 <?php echo $vars['css']['site-mn-radius']; ?>;
	-moz-border-radius: <?php echo $vars['css']['site-mn-radius']; ?> 0 0 <?php echo $vars['css']['site-mn-radius']; ?>;
	-webkit-border-radius: <?php echo $vars['css']['site-mn-radius']; ?> 0 0 <?php echo $vars['css']['site-mn-radius']; ?>;
}
#mnSiteTop .elgg-menu-site-default > li:first-child a {
	border-left: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
#mnSiteTop .elgg-menu-site-default li.elgg-more {
    margin-right: 0;
    width: 144px;
}
/* drop down menu */
body #mnSiteTop .elgg-menu-site-default > li:last-child,
body #mnSiteTop .elgg-menu-site-default > li:last-child > a {
	border-radius: 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?> 0;
	-moz-border-radius: 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?> 0;
	-webkit-border-radius: 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?> 0;
}
#mnSiteTop .elgg-menu-site-default > li.elgg-state-selected:last-child,
#mnSiteTop .elgg-menu-site-default > li.elgg-state-selected:last-child > a {
	border-radius: 0 <?php echo $vars['css']['site-mn-radius']; ?> 0 0;
	-moz-border-radius: 0 <?php echo $vars['css']['site-mn-radius']; ?> 0 0;
	-webkit-border-radius: 0 <?php echo $vars['css']['site-mn-radius']; ?> 0 0;
}
#mnSiteTop .elgg-menu-site-default li li,
#mnSiteTop .elgg-menu-site-default li.elgg-state-selected li a {
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
}
#mnSiteTop .elgg-menu-site-default li li:last-child,
#mnSiteTop .elgg-menu-site-default li li:last-child a {
	border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-moz-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-webkit-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	border: none!important;
}
#mnSiteTop .elgg-menu-site-default li li a,
#mnSiteTop .elgg-menu-site-default li.elgg-state-selected li a {
	border: none;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	color: <?php echo $vars['css']['mn-font-color']; ?>;
	font-size: <?php echo $vars['css']['mn-font-size']; ?>;
	line-height: <?php echo $vars['css']['mn-line-height']; ?>;
	display: block;
	padding: <?php echo $vars['css']['mn-item-height']; ?>;
	text-align: left;
}
#mnSiteTop .elgg-menu-site-default li li a:hover,
#mnSiteTop .elgg-menu-site-default li li.elgg-state-selected a {
	background: <?php echo $vars['css']['mn-background-color-hover']; ?>;
	color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
	text-decoration: none;
}
#mnSiteTop .elgg-menu-site-default.mainMnOn li:last-child,
#mnSiteTop .elgg-menu-site-default.mainMnOn li:last-child a {
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
}
#mnSiteTop .elgg-menu-site-default > li {
	width: 141px;
	border-top: none;
	border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-moz-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-webkit-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	padding: 0;
	box-shadow: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	margin: 0;
}
#mnSiteTop .elgg-menu-site-default > li,
#mnSiteTop .elgg-menu-site-default .elgg-menu-site-more {
	width: 141px;
}
#mnSiteTop .elgg-menu-site-default .elgg-menu-site-more {
	padding: 0;
	right: 0;
	width: 143px;
	min-width: 0;
	margin-left: 0;
	margin-top: -1px;
	box-shadow: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-moz-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-webkit-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
}