<?php
	/* dynamic top menu */
?>
/* top menu */
#mnSiteTop {
	position: relative;
	z-index: 123;
	margin: 0 0 14px;
}
#mnSiteTop .elgg-menu-site-default {
    background: <?php echo $vars['css']['site-mn-base-color']; ?>;
    border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
    -moz-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
    -webkit-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
    height: 24px;
    list-style: none;
    padding: 5px;
    position: relative;
    z-index: 12;
    display: block;
    margin: 0;
}
#mnSiteTop .elgg-menu-site-default > li {
	margin: 0 3px 0 0;
	float: left;
	border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    max-width: 13.5%;
}
#mnSiteTop .elgg-menu-site-default > li a {
	color: <?php echo $vars['css']['site-mn-font-color']; ?>;
	display: block;
    font-size: 12px;
    line-height: 24px;
    text-align: center;
    text-decoration: none;
    border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
	-moz-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
	-webkit-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
    border: none;
    margin: 0;
    outline: none;
    overflow: hidden;
	text-overflow: ellipsis;
	-o-text-overflow: ellipsis;
	white-space: nowrap;
	width: auto;
	padding: 0 12px;
}
#mnSiteTop .elgg-menu-site-default > li.elgg-more > a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-show-mn-more.png);
	background-position: 88% 50%;
	background-repeat:  no-repeat;
	padding-right: 20px;
}
#mnSiteTop .elgg-menu-site-default .elgg-state-selected a,
#mnSiteTop .elgg-menu-site-default a:hover,
#mnSiteTop .elgg-menu-site-default.mainMnOn a {
	background-color: <?php echo $vars['css']['site-mn-background-color-hover']; ?>;
    color: <?php echo $vars['css']['site-mn-font-color-hover']; ?>;
}
#mnSiteTop .elgg-menu-site-default li.elgg-more,
#mnSiteTop .elgg-menu-site-default li.elgg-more a {
    margin-right: 0;
}