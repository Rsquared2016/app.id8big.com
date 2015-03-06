<?php
	/* responsive CSS */
?>
/*  main body */
.bodyActivity #three_column_right_sidebar {
	display: block;
	padding: 0;
	float: none;
	width: auto;
}
/* right sidebar modules */
.elgg-main ul.ulGallery {
	list-style: none;
}
ul.ulGallery li {
	margin: 0 7px 7px 0;
}
ul.ulGallery li.pic-25,
ul.ulGallery li.pic-25 a,
ul.ulGallery li.pic-25 img {
	width: 25px;
	height: 25px;
}
/* site menu */
.elgg-page-default .elgg-page-body > .elgg-inner {
	position: relative;
}
#mnSiteResponsive,
#mnSiteResponsive ul {
	background-color: #f9f9f9;
}
#mnSiteResponsive {
	width: 100px;
	padding: 16px 0 0 0;
}
#mnSiteResponsive .elgg-menu-site-default { /* this is for the left menu */
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>sep-sidebar-mn.png);
	background-position: 0 0;
	background-repeat: repeat-x;
	padding-top: 2px;
}
#mnSiteResponsive .elgg-menu-site-default > li {
	float: none;
	display: block;
	margin: 0;
	background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>sep-sidebar-mn.png) 0 100% repeat-x;
	padding-bottom: 2px;
}
#mnSiteResponsive .elgg-menu-site-default > li,
#mnSiteResponsive .elgg-menu-site-default > li > a {
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
    outline: none;
}
#mnSiteResponsive .elgg-menu-site-default > li > a {
	display: block;
	text-align: center;
	font-size: 11px;
	line-height: 1.2;
	height: 24px;
	padding: 45px 10px 0;
	margin: 0;
	background-repeat: no-repeat;
	background-position: 50% 0;
	text-transform: capitalize;
}
#mnSiteResponsive .elgg-menu-site-default > li > a,
#mnSiteResponsive .elgg-menu-site-default > li > a:hover,
#mnSiteResponsive .elgg-menu-site-default > li.elgg-state-selected > a,
#mnSiteResponsive .elgg-menu-site-default > li.elgg-state-selected > a:hover {
	color: <?php echo $vars['css']['base-light-text-color'] ; ?>;
	text-decoration: none;
}
#mnSiteResponsive .elgg-menu-site-default > li > a:hover,
#mnSiteResponsive .elgg-menu-site-default > li.elgg-state-selected > a,
#mnSiteResponsive .elgg-menu-site-default > li.elgg-state-selected > a:hover {
	background-color: #efefef;
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-state-selected a {
	cursor: default;
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-activity a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-activity.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-members a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-members.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-groups a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-groups.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-bookmarks a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-bookmarks.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-file a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-file.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-blog a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-blog.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-pages a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-pages.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-menu-item-thewire a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-thewire.png);
}
#mnSiteResponsive .elgg-menu-site-default > li.elgg-more > a {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-sidebar-mn-more.png);
}
/* sidebar "more" sub menu */
#mnSiteResponsive .elgg-more .elgg-menu-site-more li > a {
	background: <?php echo  $vars['css']['mn-background-color']; ?>;
	color: <?php echo $vars['css']['mn-font-color']; ?>;
	cursor: pointer;
}
#mnSiteResponsive .elgg-more .elgg-menu-site-more li > a:hover {
 	background: <?php echo  $vars['css']['mn-background-color-hover']; ?>;
    color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
}
#mnSiteResponsive .elgg-more .elgg-menu-site-more li:first-child,
#mnSiteResponsive .elgg-more .elgg-menu-site-more li:first-child > a {
	border-radius: <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?> 0 0;
}
#mnSiteResponsive .elgg-more .elgg-menu-site-more li:last-child,
#mnSiteResponsive .elgg-more .elgg-menu-site-more li:last-child > a {
	border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
}
/* sidebar avatar */
.imgProfileContainerSidebar .elgg-avatar {
	margin: 0 auto 15px;
}
.imgProfileContainerSidebar .elgg-avatar,
.imgProfileContainerSidebar .elgg-avatar a,
.imgProfileContainerSidebar .elgg-avatar img {
	width: 74px;
	height: 74px;
	display: block;
}
.imgProfileContainerSidebar .elgg-avatar img {
	background-size: 74px 74px!important;
}
/* header site menu */
#mnRespHeaderCont {
    display: none;
    margin: 5px 20px 0 0;
    position: relative;
    z-index: 1234;
}
#mnRespHeaderCont,
#mnRespHeaderCont a.titleShowSiteMn {
    width: 28px;
    height: 28px;
}
#mnRespHeaderCont a.titleShowSiteMn {
    padding: 0;
    width: 28px;
    height: 28px;
    display: block;
}
#mnRespHeaderCont .titleShowSiteMn span {
    display: block;
    height: 100%;
    width: 100%;
    background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-top-mn.png);
    background-position: 50% 50%;
    background-repeat: no-repeat;
    cursor: pointer;
}
#mnSiteResponsiveHeader ul {
    position: absolute;
    top: 35px;
    left: 0;
    width: 180px;
    background: <?php echo $vars['css']['mn-background-color']; ?>;
    border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
    -moz-border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
    -webkit-border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
    box-shadow: <?php echo $vars['css']['mn-shadow']; ?>;
    -webkit-box-shadow: <?php echo $vars['css']['mn-shadow']; ?>;
    -moz-box-shadow: <?php echo $vars['css']['mn-shadow']; ?>;
    display: none;
}
#mnRespHeaderCont.on ul {
    display: block;
}
#mnRespHeaderCont.on ul ul {
    display: none;
}
#mnSiteResponsiveHeader li {
    float: none;
    margin: 0;
}
#mnSiteResponsiveHeader li,
#mnSiteResponsiveHeader li a {
    border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    margin: 0;
}
#mnSiteResponsiveHeader li a {
    color: <?php echo $vars['css']['mn-font-color']; ?>;
    font-size: <?php echo $vars['css']['mn-font-size']; ?>;
    line-height: <?php echo $vars['css']['mn-line-height']; ?>;
    padding: <?php echo $vars['css']['mn-item-height']; ?>;
}
#mnSiteResponsiveHeader li a:hover {
    background: <?php echo $vars['css']['mn-background-color-hover']; ?>;
    color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
}
#mnSiteResponsiveHeader li.elgg-state-selected a,
#mnSiteResponsiveHeader li.elgg-state-selected a:hover {
    color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
    background: <?php echo $vars['css']['mn-background-color-sel']; ?>;
}
#mnSiteResponsiveHeader ul > li:first-child,
#mnSiteResponsiveHeader ul > li:first-child a {
    border-radius: <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?> 0 0;
    -moz-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?> 0 0;
    -webkit-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?> 0 0;
}
#mnSiteResponsiveHeader ul > li:last-child,
#mnSiteResponsiveHeader ul > li:last-child a {
    border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
    -moz-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
    -webkit-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
}
/* page sidebar menu */
.elgg-page ul.elgg-menu.elgg-menu-page {
    border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    padding: 0;
}
.elgg-page .elgg-menu-page li {
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-page .elgg-menu-page li > a {
    background: none;
    display: block;
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
    padding: 15px 6px 15px 10px;
}
.elgg-page .elgg-menu-page li > a,
.elgg-page ul.treeview,
.elgg-page .treeview ul {
    font-size: 11px;
    line-height: 1.2;
}
.elgg-page .elgg-menu-page li.elgg-state-selected > a {
    border-right: 1px solid #fff;
    padding-right: 5px;
}
.elgg-page .elgg-menu-page li > a:hover,
.elgg-page .elgg-menu-page li.elgg-state-selected > a {
	color: <?php echo $vars['css']['base-link-color']; ?>;
}
.elgg-page .elgg-menu-page li.elgg-state-selected > a {
	cursor: default;
}
/* extras menu (RSS, etc.) */
.elgg-page .elgg-sidebar .elgg-menu-extras {
	padding-left: 8px;
}
/* sidebar lists */
.elgg-page .elgg-sidebar .elgg-list {
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	padding: 9px 0;
}
.elgg-page .elgg-sidebar .elgg-list li {
	padding-left: 10px;
	padding-right: 10px;
}
.elgg-page .elgg-sidebar .elgg-list li span.elgg-subtext {
    display: block;
}
/* sidebar gallery  modules */
.elgg-page .elgg-sidebar .elgg-gallery {
	padding: 0 10px;
	overflow: hidden;
}
.elgg-page .elgg-sidebar .elgg-gallery li,
.elgg-page .elgg-sidebar .elgg-gallery li .elgg-avatar > a,
.elgg-page .elgg-sidebar .elgg-gallery li .elgg-avatar > a img {
	display: block;
	width: 25px;
	height: 25px;
}
.elgg-page .elgg-sidebar .elgg-gallery li .elgg-avatar > a img {
	background-size: 25px 25px!important;
}
.elgg-page .elgg-sidebar .elgg-gallery li {
	float: left;
	margin: 0 8px 8px 0;
}
.elgg-page .elgg-sidebar .elgg-gallery li:nth-child(5n) {
	margin-right: 0;
}
/* sidebar module's fixes */
.elgg-page .elgg-sidebar .elgg-tagcloud,
.elgg-page .elgg-sidebar p.small,
.elgg-page .elgg-sidebar .elgg-body > p,
.elgg-page .elgg-sidebar .elgg-body > .mts:last-child {
	padding: 0 10px;
}
.elgg-page .elgg-sidebar p.small,
.elgg-page .elgg-sidebar .elgg-body > p {
	margin: 0;
}
.elgg-page .elgg-sidebar .elgg-body > p {	/* "no contents" text */
	font-style: italic;
}
/* breadcrumbs */
.elgg-main .elgg-breadcrumbs {
    width: auto;
}
.elgg-main > .elgg-head,
.elgg-main.elgg-body > h2 {
    border: none;
    margin-bottom: 15px;
    padding: 0;
}
/* profile */
.mnUserProfileResponsive {
	display: none;
}
/* main title menu */
ul.elgg-menu.elgg-menu-title {
	top: -4px;
}
/* left menu show / hide */
#mnSiteResponsive a.elgg-button {
	display: none;
}
/* main title show / hide sidebar button */
.titleShowSiteMn {
	display: none;
}
/* title inner sidebar */
h2 .elgg-sidebar {
	display: none;
}
/* sub header button */
.btnSubHeader {
	background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>btn-sub-header.png) 50% 50% no-repeat #333;
    width: 30px;
    height: 30px;
    cursor: pointer;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    display: none;
    margin: 7px 0 0 0;
    box-shadow: 0 0 2px rgba(255, 255, 255, 0.3);
}
/* header subsections */
.elgg-page-header .headerSubsections {
    width: 100%;
    top: <?php echo $vars['css']['header-height-responsive']; ?>;
    left: 0;
    height: 40px;
    background: #444;
    position: absolute;
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.5), inset 0 3px 5px rgba(0, 0, 0, 0.2);
    z-index: 1;
    display: none;
}
.headerSubsections.on {
    display: none;
}
<?php
	if (THEME_RESPONSIVE_SUPPORT) {
?>
/* common code for iPad + iPhone (portrait)  */
@media only screen
and (min-width : 320px)
and (max-width : 785px) {
	/* hide left sidebar */
    .elgg-sidebar {
		display: none;
	}
    /* show alternative sidebar */
    .h2titleShowSidebar {
        display: block;
    }
    /* background lines removal */
    .elgg-layout {
        background: none;
    }
    /* right header elements */
    .headRig {
        margin-top: 5px;
    }
    .isLoggedIn .headRig {
        display: none;
        float: none!important;
        position: absolute;
        top: 52px;
        right: 10px;
        margin: 0;
    }
    .headRig.hOn {
        display: block;
    }
    /* sub header button */
    .btnSubHeader {
        display: block;
    }
    .headerSubsections.on {
        display: block;
    }
	/* main contents */
    .elgg-main {
    	margin-left: 115px;
	}
    /* hide / show sidebar title button */
	.elgg-main > .elgg-head h2,
	.elgg-main.elgg-body > h2 {
		position: relative;
	}
	.elgg-main > .elgg-head h2 .titleTxt,
	.elgg-main.elgg-body > h2 .titleTxt {
		display: block;
		padding: 0;
		position: relative;
		z-index: 1;
	}
	.elgg-main > .elgg-head h2:first-child .titleTxt,
	.elgg-main.elgg-body > h2:first-child .titleTxt {
		padding-left: 40px;
	}
	.h2titleShowSidebar {
		display: none;
		position: absolute;
		z-index: 12;
		cursor: pointer;
		width: 17px;
		height: 11px;
		top: 3px;
		left: 6px;
		background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>btn-sidebar-title.png) 0 0 no-repeat;
	}
	.elgg-main > .elgg-head h2:first-child .h2titleShowSidebar,
	.elgg-main.elgg-body > h2:first-child .h2titleShowSidebar {
		display: block;
	}
	/* title sidebar */
	h2.mainContentsTitle.on .elgg-sidebar {
		display: block;
	}
	.elgg-page h2 .elgg-sidebar {
		position: absolute;
		margin: 0;
		float: none;
		left: 3px;
		top: 25px;
		background: #fff;
		padding: 0 0 10px;
		-webkit-box-shadow: <?php echo $vars['css']['mn-shadow']; ?>;
	    -moz-box-shadow: <?php echo $vars['css']['mn-shadow']; ?>;
    	box-shadow: <?php echo $vars['css']['mn-shadow']; ?>;
		border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
		-moz-border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
		-webkit-border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
	}
	.elgg-page h2 .elgg-sidebar ul.elgg-menu-page li:first-child {
		border-top: none;
	}
	/* header */
	body .elgg-page-header,
    #headerLef {
		height: <?php echo $vars['css']['header-height-responsive']; ?>;
	}
    /* footer */
	ul.ulFoot {
		width: auto;
	}
	.footerSlogans {
		float: right;
		margin: 0 auto;
        width: auto;
	}
    .footerSlogans .fs1 {
        margin-right: 12px;
        width: 48px;
    }
    .footerSlogans .fs2 {
        margin-right: 0;
        width: 52px;
    }
    .footerSlogans .fs1,
    .footerSlogans .fs2 {
        background-position: 100% 0;
    }
	/* logo */
	<?php
		// Default logo.
		$logo_url = THEME_GRAPHICS_CUSTOM . 'logo-mobile.png';
		// get logo dimensions
		list($width, $height, $type, $attr) = getimagesize($logo_url);
	?>
	#headerLef,
	#headerLef h1,
	#headerLef h1 a {
		width: <?php echo $width; ?>px;
	}
	#headerLef h1 a {
		background: url(<?php echo $logo_url; ?>) 50% 50% no-repeat;
	}
	/* right sidebar */
	#three_column_right_sidebar {
		display: none;
	}
    /* home */
    .bodyHome .elgg-page-default {
        background: #fff;
    }
    .homeTxtCont {
        height: auto;
    }
    .homeImg.flRig {
        float: none!important;
        width: auto;
        text-align: center;
        margin-bottom: 15px;
    }
    .homeTxt.flLef {
        float: none!important;
        height: auto;
        width: auto;
        padding: 0 3.90625% 30px;
    }
    .homeContactTxtCont {
        padding: 25px 3.90625%;
        border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
        background: #f4f8fb;
        height: auto;
    }
}
/* code for resolution <= 1023 (landscape) */
@media only screen
and (min-width : 320px)
and (max-width : 1023px) {
    /* profile */
	#profileTitle {
		overflow: hidden;
		margin-bottom: 7px;
	}
	.titleAndStatus {
		min-height: 95px;
	}
	.elgg-page .profile.elgg-col-2of3,
	.elgg-page #cols2and3 {
    	width: 100%;
		float: none;
		clear: both;
	}
	.elgg-page #profile-details h2 {
		font-size: 14px;
		line-height: 1.2;
	}
	#profile-owner-block {
		position: relative;
	}
	#profile-owner-block,
	.imgProfileContainer,
	.imgProfileContainer .elgg-avatar.elgg-avatar-large,
	.elgg-avatar-large > a > img {
		width: 100px;
	}
	.imgProfileContainer,
	.imgProfileContainer .elgg-avatar.elgg-avatar-large,
	.elgg-avatar-large > a > img {
		height: 100px;
		margin: 0;
	}
	.elgg-avatar-large > a > img {
		background-size: 100px 100px!important;
	}
	#profile-details {
		float: none;
		width: auto;
		margin: 0 0 0 110px;
		min-height: 0;
		padding: 5px 0 0 0;
		overflow: visible;
		border: none;
	}
	.wire-status {
		padding: 10px;
		min-height: 39px;
		overflow: hidden;
	}
	.allProfileMenus {
		position: absolute;
		width: 180px;
		z-index: 123;
		background: <?php echo $vars['css']['mn-background-color']; ?>;
		border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
		-moz-border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
		-webkit-border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
		box-shadow: <?php echo $vars['css']['mn-shadow']; ?>;
		overflow: auto;
		display: none;
        top: 35px;
        right: -547px;
	}
	.allProfileMenus.on {
		display: block;
	}
	.allProfileMenus .elgg-menu.profile-content-menu:first-child li:first-child,
	.allProfileMenus .elgg-menu.profile-content-menu:first-child li:first-child a {
		border-radius: <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?> 0 0;
		-moz-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?> 0 0;
		-webkit-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?> 0 0;
	}
	.allProfileMenus .elgg-menu.profile-content-menu:last-child li:last-child,
	.allProfileMenus .elgg-menu.profile-content-menu:last-child li:last-child a {
		border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
		-moz-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
		-webkit-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
	}
	.allProfileMenus .elgg-menu.profile-content-menu li a {
		color: <?php echo $vars['css']['mn-font-color']; ?>;
		font-size: <?php echo $vars['css']['mn-font-size']; ?>;
		line-height: <?php echo $vars['css']['mn-line-height']; ?>;
		padding: <?php echo $vars['css']['mn-item-height']; ?>;
		display: block;
	}
	.allProfileMenus .elgg-menu.profile-content-menu li a:hover,
	.allProfileMenus .elgg-menu.profile-content-menu.profile-menu-admin li a:hover {
		color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
		background: <?php echo $vars['css']['mn-background-color-hover']; ?>;
		text-decoration: none;
	}
	.allProfileMenus .elgg-menu.profile-content-menu li.elgg-state-selected a:hover,
	.allProfileMenus .elgg-menu.profile-content-menu li.elgg-state-selected a {
		color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
		background: <?php echo $vars['css']['mn-background-color-sel']; ?>;
	}
	.allProfileMenus .elgg-menu.profile-content-menu.profile-menu-admin li a {
		color: #880000;
	}
	.elgg-menu.profile-content-menu li {
		margin: 0;
	}
	.profileFields {
		margin-left: -110px;
	}
	#profile-details .profileFieldRow,
	.profileFieldRow {
		padding: 5px 10px;
		margin: 0;
	}
	#profile-details .profileFieldRow.odd {
		background: #f7f8f8;
	}
	#elgg-widget-col-1,
	#elgg-widget-col-2,
	#elgg-widget-col-3 {
		min-height: 0!important;
		width: 100%;
	}
	#elgg-widget-col-1,
	#cols2and3 {
		float: none!important;
		clear: both;
	}
	.imgProfileContainer .editProfileIcon a {
		text-indent: -1000000px;
	}
	.imgProfileContainer .editProfileIcon {
		width: 27px;
	}
	.mnUserProfileResponsive {
		display: block;
	}
	.mnUserProfileResponsive .theButton {
		background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>mn-responsive-title-profile.png) 50% 4px no-repeat #f2f4f6;
		width: 49px;
		height: 25px;
		border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
		border-radius: 1px;
		-moz-border-radius: 1px;
		-webkit-border-radius: 1px;
		cursor: pointer;
		margin-top: -3px;
	}
	.mnUserProfileResponsive .theButton.on,
	.mnUserProfileResponsive .theButton:hover {
		background-position: 50% -79px;
	}
	/* widget's fixes */
	.elgg-widget-content textarea.elgg-input-plaintext.messageboard-input {
		float: none;
		display: block;
	}
	.elgg-form-messageboard-add .elgg-button-submit {
		display: block;
		float: none;
	}
    .elgg-menu-widget > .elgg-menu-item-settings {
        display: none;
    }
	/* user menu */
	li.elgg-menu-item-top-profile {
		display: block;
	}
    /* widget controls (do not show) */
	#profileTitle a {
		display: none;
	}
}
/* iPhone and the like */
@media only screen
and (min-width : 320px)
and (max-width : 480px) {
	/* side menu */
    .sideBarsContainer {
        display: none;
    }
    /* main contents */
    .elgg-main {
    	margin-left: 0;
	}
    /* header site menu */
    #mnRespHeaderCont {
		display: block;
	}
    /* user menu */
	.userTopMn .usrIco {
		display: none;
	}
	/* river dashboard */
	.elgg-river-layout .elgg-input-dropdown {
		width: 75px;
	}
	/* pagination */
	.pagination a, ul.elgg-pagination a, ul.elgg-pagination span {
		padding: 0 7px;
		line-height: 30px;
		font-size: 10px;
	}
    /* generic forms */
    .elgg-main .elgg-form input[type="text"],
    .elgg-main .elgg-form input[type="password"],
    .elgg-main .elgg-form textarea,
    .elgg-main .elgg-form-profile-edit input.elgg-input-text[name="name"],
    .elgg-main .ktFormWrapper .elgg-form input[type="text"],				/* some ktform stuff */
    .elgg-main .ktFormWrapper .elgg-form input[type="password"],
    .elgg-main .ktFormWrapper .elgg-form input.txtFrm100,
    .elgg-main .ktFormWrapper .frmField textarea,
    .elgg-main .ktFormWrapper .frmField .elgg-menu-longtext {
        width: 97%;
    }
	/* settings section */
	.rFrmSet label {
		margin: 11px 0 5px 0;
		text-align: left;
		width: auto;
		float: none!important;
	}
    .rFrmSet label:first-child {
        margin-top: 0;
    }
    .elgg-main .elgg-form .rFrmSet input[type="text"],
    .elgg-main .elgg-form .rFrmSet input[type="password"],
    .elgg-main .elgg-form .rFrmSet select {
        float: none;
        width: 96%;
    }
    .elgg-main .elgg-form .rFrmSet select {
        width: 100%;
    }
	.elgg-form-usersettings-save table {
		width: 100%;
	}
    /* common titles */
    .elgg-heading-main,
    h2.elgg-heading-main {
        max-width: 65.3669064748%;
    }
    /* profile */
    .bodyOwner_block .elgg-main,
    .bodyProfile .elgg-main {
        margin-left: 0;
    }
    /* register, login, forgot password */
    .bodyLogin .elgg-main,
    .bodyRegister .elgg-main,
    .bodyForgotpassword .elgg-main {
        margin-left: 0;
    }
    /* footer */
	ul.ulFoot {
		width: auto;
        min-width: 170px;
		margin: 0;
		padding: 0;
        background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>sep-txt-contact-home.png) 100% 0 repeat-y;
	}
	ul.ulFoot li {
		display: block;
		font-size: 10px;
	}
	ul.ulFoot li.sep {
		display: none;
	}
    /* home */
    .homeImg.flRig,
    .homeImg.flRig img {
        margin-left: auto;
        margin-right: auto;
    }
    .homeImg.flRig img {
        max-width: 400px;
    }
    .homeTxt.flLef {
        text-align: center;
    }
    .homeTxt h2 {
        font-size: 16px;
        line-height: 1.2;
    }
    .homeTxt p {
        font-size: 12px;
        line-height: 1.2;
    }
    .homeContactTxt.flLef,
    .homeContactInfo.flLef {
        width: auto;
        float: none!important;
        background: none;
        padding: 0 0 20px;
        margin: 0 0 20px;
    }
    .homeContactTxt.flLef {
        background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>sep-cont-home-horiz.png) 0 100% repeat-x;
    }
    .homeContactInfo.flLef {
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .homeContactTxtCont,
    .homeTxt.flLef{
        padding-left: 2%;
        padding-right: 2%;
    }
}
@media only screen
and (min-width : 320px)
and (max-width : 480px)
and (orientation: landscape) {

}
@media only screen
and (min-width : 320px)
and (max-width : 480px)
and (orientation: portrait) {
    /* generic forms */
    .elgg-main .elgg-form input[type="text"],
    .elgg-main .elgg-form input[type="password"],
    .elgg-main .elgg-form textarea,
    .elgg-main .elgg-form-profile-edit input.elgg-input-text[name="name"],
    .elgg-main .ktFormWrapper .elgg-form input[type="text"],				/* some ktform stuff */
    .elgg-main .ktFormWrapper .elgg-form input[type="password"],
    .elgg-main .ktFormWrapper .elgg-form input.txtFrm100,
    .elgg-main .ktFormWrapper .frmField textarea,
    .elgg-main .ktFormWrapper .frmField .elgg-menu-longtext {
        width: 95%;
    }
    /* register, login, forgot password */
    form.elgg-form.elgg-form-register,
    form.elgg-form.elgg-form-user-requestnewpassword,
    .elgg-body > form.elgg-form.elgg-form-login {
        min-width: 290px;
    }
    /* home */
    .homeImg.flRig img {
        max-width: 300px;
    }
}
<?php
    }
?>
