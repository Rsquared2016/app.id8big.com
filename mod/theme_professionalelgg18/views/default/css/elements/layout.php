<?php
/**
 * Page Layout
 *
 * Contains CSS for the page shell and page layout
 *
 * Default layout: 990px wide, centered. Used in default page shell
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* DEFAULT LAYOUT */
.elgg-page-default {
	min-width: 320px;
}
.limitWidth,
.elgg-system-messages li p,
.topbarContainer {
    width: <?php echo $vars['css']['cont-width'];?>;
    max-width: <?php echo $vars['css']['cont-max-width'];?>;
	margin: 0 auto;
}
.bodyHome .limitWidth,
.bodyHome .elgg-system-messages li p,
.bodyHome .topbarContainer {
    max-width: 990px;	/* use a fixed MAX WIDTH for the home page (fluid design or not) */
}
/* PAGE MESSAGES */
.elgg-system-messages {
	left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 20000;
}
.elgg-system-messages li {
	margin: 0;
    cursor: pointer;
}
.elgg-system-messages li p {
	font-size: 12px;
    line-height: 22px;
}
/* header */
body .elgg-page-header {
	position: relative;
    z-index: 123;
    height: <?php echo $vars['css']['header-height']; ?>;
	background: <?php echo $vars['css']['header-background-color']; ?>;
	padding: 0;
}
body .elgg-page-header .limitWidth {
	padding-left: <?php echo $vars['css']['cont-padding']; ?>;
	padding-right: <?php echo $vars['css']['cont-padding']; ?>;
}
<?php
	//Default logo.
	$logo_url = THEME_GRAPHICS_CUSTOM . 'logo.png';

	//Get custom logo.
	$theme_logo = elgg_get_plugin_setting('theme_logo', THEME_NAME);
	if($theme_logo) {
		$logo_url = $theme_logo;
	}

	// get logo dimensions
	list($width, $height, $type, $attr) = getimagesize($logo_url);
?>
#headerLef {
    margin: 0;
    float: left;
    height: <?php echo $vars['css']['header-height']; ?>;
}
#headerLef,
#headerLef h1,
#headerLef h1 a {
	display: block;
	position: relative;
	width: <?php echo $width; ?>px;
	margin: 0;
}
#headerLef h1,
#headerLef h1 a {
	height: 100%;
}
#headerLef h1 a {
	background: url(<?php echo $logo_url; ?>) 50% 50% no-repeat;
	text-decoration: none;
}
.headRig {
    margin: 16px 0 0;
    padding: 0;
    position: relative;
    z-index: 123;
}
/* page body layout */
.elgg-layout {
	min-height: 360px;
	position: relative;
	z-index: 1;
	background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>fon-main-body-lines.png) 100px 0 repeat-y;
}
.bodyOwner_block .elgg-layout,
.bodyLogin .elgg-layout,
.bodyRegister .elgg-layout,
.bodyForgotpassword .elgg-layout {
	background: none;
}
.elgg-layout-error {
	margin-top: 20px;
}
.elgg-sidebar {
	position: relative;
	float: left;
	margin: 0;
	z-index: 123;
}
.elgg-sidebar,
h2 .elgg-sidebar {
	width: 180px;
}
.elgg-sidebar-alt {
	position: relative;
	padding: 20px 10px;
	float: left;
	width: 160px;
	margin: 0 10px 0 0;
}
.elgg-layout-one-column .elgg-main {
	width: auto;
}
.elgg-main {
	width: auto;
	position: relative;
	min-height: 360px;
	margin: 0 0 0 295px;
	padding-top: 15px;
}
.elgg-main,
.sideBarsContainer {
	padding-bottom: 25px;
}
.sideBarsContainer {
	position: absolute;
}
.threeCol .elgg-main {
	margin: 0;
	padding: 0;
	width: 523px;
}
.bodyOwner_block .elgg-main,
.bodyProfile .elgg-main,
.bodyLogin .elgg-main,
.bodyRegister .elgg-main,
.bodyForgotpassword .elgg-main {
	margin: 0 0 0 110px;
}
.bodyOwner_block .elgg-main,
.bodyProfile .elgg-main {
	max-width: 880px;
}
.elgg-main > .elgg-head,
.elgg-main.elgg-body > h2 {
	padding-bottom: 7px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	margin-bottom: 10px;
	position: relative;
}
.bodyActivity .elgg-main,
.bodyMembers .elgg-main,
.bodyFriends .elgg-main,
.bodySearch .elgg-main,
.bodyBanners .elgg-main {	/* there are no breadcrumbs on these sections, so we have to align the title manually... */
	padding-top: 13px;
}
.elgg-main > .elgg-head h2,
.elgg-main.elgg-body > h2 {
	font-size: 16px;
	line-height: 18px;
	font-weight: normal;
}
.elgg-main > .elgg-head h2 .titleTxt,
.elgg-main.elgg-body > h2 .titleTxt {
	font-weight: bold;
}
.elgg-page-body {
    position: relative;
    z-index: 12;
    background: #fff;
    padding-left: <?php echo $vars['css']['cont-padding']; ?>;
	padding-right: <?php echo $vars['css']['cont-padding']; ?>;
}
.bodyHome .elgg-page-body {
	background: none;
}
/* right sidebar */
#three_column_right_sidebar {
	float: right;
	width: 250px;
}
.bodyActivity #three_column_right_sidebar {
	padding-top: 6px;
}
/* footer */
.elgg-page-footer {
	position: relative;
	height: <?php echo $vars['css']['footer-height']; ?>;
	overflow: hidden;
	padding-left: <?php echo $vars['css']['cont-padding']; ?>;
	padding-right: <?php echo $vars['css']['cont-padding']; ?>;
	padding-top: 15px;
	padding-bottom: 15px;
	background: <?php echo $vars['css']['footer-background-color']; ?>;
}
