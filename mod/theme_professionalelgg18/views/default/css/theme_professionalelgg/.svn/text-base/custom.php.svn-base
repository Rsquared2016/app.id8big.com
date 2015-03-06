<?php
	/* custom CSS */
	/* Only for elgg default elements modifications and additions */
?>
/* general style */
.elgg-page-body .elgg-inner {
	padding: 14px 0 40px 0;
	height: auto;
}
/* footer */
.footerSlogans {
	float: right;
	width: 275px;
}
.footerSlogans .fs1,
.footerSlogans .fs2 {
	float: left;
}
.footerSlogans .fs1 {
    margin-right: 20px;
    width: 120px;
    height: 24px;
    background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>img-powered-by.png) 0 0 no-repeat;
}
.footerSlogans .fs2 {
    margin-right: -1px;
    margin-top: 2px;
    width: 136px;
    height: 20px;
    background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>img-developed-by.png) 0 0 no-repeat;
}
.footerSlogans .fs1 a,
.footerSlogans .fs2 a {
    display: block;
    height: 100%;
    text-decoration: none;
}
ul.ulFoot {
	float: left;
	margin: 4px 0 0 0;
	padding: 0;
	list-style: none;
}
ul.ulFoot li {
	display: inline;
	font-size: 11px;
	line-height: 13px;
}
ul.ulFoot li.sep {
	margin: 0 3px;
}
ul.ulFoot li,
.elgg-page-footer ul.ulFoot a {
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
}
/* top site menu */
#mnSiteTop {
	margin: 0 0 14px;
}
/* drop down menu */
#mnSiteTop .elgg-menu-site-more {
	padding: 0;
	border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
	-moz-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
	-webkit-border-radius: <?php echo $vars['css']['site-mn-radius']; ?>;
	margin: 2px 0 0 0;
	width: 160px;
	left: auto;
	right: -1px;
}
#mnSiteTop .elgg-menu-site-default li li,
#mnSiteTop .elgg-menu-site-default li.elgg-state-selected li a {
	margin: 0;
	padding: 0;
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
}
#mnSiteTop .elgg-menu-site-default li li:first-child,
#mnSiteTop .elgg-menu-site-default li li:first-child a { /* first dropdown menu element */
	border-radius: <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?> 0 0;
	-moz-border-radius: <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?> 0 0;
	-webkit-border-radius: <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?> 0 0;
}
#mnSiteTop .elgg-menu-site-default li li:last-child,
#mnSiteTop .elgg-menu-site-default li li:last-child a { /* last dropdown menu element */
	border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-moz-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
	-webkit-border-radius: 0 0 <?php echo $vars['css']['site-mn-radius']; ?> <?php echo $vars['css']['site-mn-radius']; ?>;
}
#mnSiteTop .elgg-menu-site-default li li a,
#mnSiteTop .elgg-menu-site-default li.elgg-state-selected li a { /* dropdown menu element */
	border: none;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	color: <?php echo $vars['css']['mn-font-color']; ?>;
	font-size: <?php echo $vars['css']['mn-font-size']; ?>;
	line-height: <?php echo $vars['css']['mn-line-height']; ?>;
	display: block;
	padding: <?php echo $vars['css']['mn-item-height']; ?>;
	text-align: left;
	width: auto;
}
#mnSiteTop .elgg-menu-site-default li li:last-child a {
	border: none;
}
#mnSiteTop .elgg-menu-site-default li li a:hover,
#mnSiteTop .elgg-menu-site-default li li.elgg-state-selected a { /* dropdown menu element hover */
	background: <?php echo $vars['css']['mn-background-color-hover']; ?>;
	color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
	text-decoration: none;
}
/* reset some lists */
ul.elgg-list,
ul.elgg-input-radios,
.friends-picker-navigation ul,
ul.elgg-input-checkboxes,
ul.tabGeneric,
ul.profile-action-menu {
    list-style: none;
    margin-left: 0;
    padding-left: 0;
}
/* sidebar modules */
.elgg-module-aside,
.sidebarBox {
    border: none;
    padding: 0;
}
ul.elgg-menu.elgg-menu-page,
.elgg-module-aside,
.sidebarBox,
.elgg-sidebar .elgg-menu-extras {
	margin: 0 0 15px;
	padding: 15px 0 0 0;
}
ul.elgg-menu.elgg-menu-page:last-child,
.elgg-module-aside:last-child,
.sidebarBox:last-child,
.elgg-sidebar .elgg-menu-extras:last-child {
	margin-bottom: 0;
}
.elgg-module-aside,
.sidebarBox,
.elgg-module-aside > .elgg-body,
.sidebarBox > .elgg-body {
	overflow: visible;
}
.elgg-module-aside > .elgg-body > .elgg-form,
.sidebarBox > .elgg-body > .elgg-form {
	padding: 0 10px;
}
/* left column search forms */
.elgg-sidebar .elgg-module-aside form,
.elgg-sidebar .elgg-module-aside fieldset {
	overflow: hidden;
}
.elgg-sidebar .elgg-module-aside .elgg-input-text {
	float: left;
	width: 68.75%!important;
	margin: 0;
}
@media screen and (-webkit-min-device-pixel-ratio:0) {
	/* Safari 3.0 and Chrome rules here */
	.elgg-sidebar .elgg-module-aside .elgg-input-text.elgg-input-search {
		margin-top: 0;
	}
}
.elgg-sidebar .elgg-module-aside .elgg-button.elgg-button-submit {
	float: right;
	max-width: 25%!important;
}
/* upload avatar */
input[type="file"].fileUploadAvatar {
	width: 300px;
}
/* textarea menus (delete editor, etc.) */
ul.elgg-menu-longtext-default {
	display: none;	/* hidden for now, 'til I find a way to put it below the editor */
	margin-top: -22px;
	margin-bottom: 0;
}
/* breadcrumbs avatar */
ul.elgg-breadcrumbs.hasAvatar li {
	line-height: 25px;
}
li.elgg-breadcrumbs-ownerblock {
    float: left;
    height: 25px;
    margin: 0 10px 0 0;
    overflow: hidden;
    width: 25px;
}
/* title buttons */
ul.elgg-menu.elgg-menu-title {
	margin: 0;
	position: absolute;
	top: -8px;
	right: 0;
    max-width: 30%;
}
/* owner block user avatar, name, etc. */
.elgg-owner-block h3 {
	margin: 0;
}
.elgg-loggedin-block {
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	padding: 12px 0 5px 5px;
	margin: 0 0 10px;
}
.bodyActivity .elgg-loggedin-block {
	padding-top: 0;
}
.elgg-loggedin-block .elgg-image {
	width: 25px;
	height: 25px;
	margin: 0 10px 0 0;
}
.elgg-loggedin-block h3 {
	font-size: 12px;
	font-weight: bold;
	margin: 0;
	text-overflow: ellipsis;
	-o-text-overflow: ellipsis;
	-webkit-text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
}
.elgg-loggedin-block ul.elgg-menu,
.elgg-loggedin-block ul.elgg-menu li {
	margin: 0;
	padding: 0;
	text-align: left;
	float: none;
}
.elgg-loggedin-block .elgg-body {
	overflow: visible;
	padding: 7px 0 0 0;
}
/* pages menu (left menu with sub sections) */
ul.elgg-menu.elgg-menu-page {
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	margin: 0 0 10px;
	padding: 0 0 10px;
}
/* members section: We should remove this */
.elgg-list > li .membersListItem h3 {
	float: left;
	max-width: 50%;
	margin: 6px 0 0 0;
	font-size: 11px;
	line-height: 13px;
}
.elgg-list > li .membersListItem .elgg-content {
	max-width: 50%;
	float: right;
	margin: 2px 0 0;
}
.elgg-list > li .membersListItem .elgg-subtext,
.elgg-list > li .membersListItem .elgg-menu.elgg-menu-entity {
	display: none;
}
.elgg-button.list-members {
	min-width: 90px;
	*width: 90px;
}
/* members section: KTODO: Gabi deberias chequear esto */
.bodyMembers .elgg-item .elgg-menu-entity {
	text-align: right;
}
.bodyMembers .elgg-item .elgg-menu-entity li {
	display: block;
}
.bodyMembers .elgg-item .elgg-menu-entity .btn-members-action {
	overflow: hidden;
	margin: 3px 0 4px;
}
.bodyMembers .elgg-item .elgg-menu-entity .btn-members-action a {
	float: right;
	line-height: 13px;
}
/* login popup */
<?php
	$login_btn_height = '30px';
?>
#loginCont {
	position: relative;
	height: <?php echo $login_btn_height; ?>;
}
#loginCont .elgg-module.elgg-module-aside {
	border: none;
    margin: 0;
    overflow: hidden;
    padding: 0;
}
#loginCont .elgg-form-login,
#loginCont .elgg-form-account {
	max-width: none;
}
#loginCont .elgg-body:after,
#loginCont .elgg-col-last:after {
	content: '';
}
.loginBtn,
.loginBtn span {
	display: block;
}
a.loginBtn {
	color: #fff;
	font-size: 13px;
	line-height: <?php echo $login_btn_height; ?>;
	padding: 0 12px;
	text-decoration: none;
}
.on .loginBtn {
	background: #2f3336;
}
.loginBtn span {
	background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>btn-login.png) 100% 12px no-repeat;
	padding: 0 16px 0 0;
}
.loginFrmPopup {
	max-width: none!important;
    width: 282px;
	height: 1px;
	position: absolute;
	top: <?php echo $login_btn_height; ?>;
	right: 0;
	display: none;
}
.on .loginFrmPopup {
	display: block;
}
.loginFrmPopupInner {
	border: 6px solid #2f3336;
	background: #fff;
	padding: 20px 22px;
}
.loginFrmPopupInner label.titleLabel {
	font-size: 14px;
	line-height: 16px;
	display: block;
	font-weight: normal;
	margin: 0 0 6px;
	padding: 0 0 0 2px;
}
.loginFrmPopupInner .rFrm {
	margin: 0 0 15px;
}
.loginFrmPopupInner input[type="text"],
.loginFrmPopupInner input[type="password"] {
	width: 216px;
	float: none;
}
.rLoginBtn {
	padding: 0 0 18px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	margin: 0 0 20px;
}
.rLoginBtn input[type="submit"] {
	min-width: 85px;
	margin: 0 20px 0 0;
}
.rLoginBtn .labelRemember {
	margin: 8px 0 0 0;
}
.rLoginBtn .labelRemember input,
.rFrm .labelRemember input {
	margin: 0 6px 0 0;
}
.rLoginBtn .labelRemember span,
.rFrm .labelRemember span  {
	font-size: 11px;
	line-height: 13px;
	font-weight: normal;
	color: <?php echo $vars['css']['base-light-text-color']; ?>
}
ul.ulLoginOptions {
	margin: 0;
	padding: 0;
	list-style: none;
}
ul.ulLoginOptions,
ul.ulLoginOptions li {
	font-size: 13px;
	line-height: 1.2;
}
ul.ulLoginOptions li {
	display: inline;
}
ul.ulLoginOptions .sep {
	color: <?php echo $vars['css']['base-link-color']; ?>;
	margin: 0;
}
/* register / login / recover password forms */
.bodyRegister .elgg-layout,
.bodyLogin .elgg-layout,
.bodyForgotpassword .elgg-module {
	min-height: 400px;
}
.bodyLogin .elgg-module {
    border: none;
    margin: 0;
    overflow: hidden;
    padding: 0;
}
.bodyRegister .elgg-page-body .elgg-inner,
.bodyForgotpassword .elgg-page-body .elgg-inner,
.bodyLogin .elgg-page-body .elgg-inner {
	padding: 30px 0 35px;
}
form.elgg-form.elgg-form-register,
form.elgg-form.elgg-form-user-requestnewpassword,
.elgg-body > form.elgg-form.elgg-form-login {	/* some redundant selectors from here because we don't have (or haven't devised) a way to use a single class for everything */
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	padding: 20px 2.84090909091%;
	background: #fff;
	margin: 0 auto;
	border-radius: 3px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	min-height: 0;
	float: none;
    min-width: 440px;
}
form.elgg-form.elgg-form-register,
form.elgg-form.elgg-form-login {
	width: 48.8636363636%;
}
form.elgg-form.elgg-form-user-requestnewpassword {
	width: 39.0909090909%;
	padding: 16px 2.5% 22px 2.72727272727%;
}
.bodyRegister .elgg-main.elgg-body > h2,
.bodyForgotpassword .elgg-main.elgg-body > h2,
.bodyLogin .elgg-main.elgg-body > h2,
.bodyLogin .elgg-module .elgg-head {	/* do not display the main page title */
	display: none;
}
form.elgg-form.elgg-form-register h3.stdFrmTitle,
form.elgg-form.elgg-form-user-requestnewpassword h3.stdFrmTitle,
form.elgg-form.elgg-form-login h3.stdFrmTitle {
	font-size: 14px;
	line-height: 16px;
	font-weight: bold;
	margin: 0 0 20px;
	padding: 0 0 12px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
form.elgg-form.elgg-form-user-requestnewpassword .rFrm {
	margin: 0 0 22px;
}
form.elgg-form.elgg-form-register .rBtn .btnAlign,
form.elgg-form.elgg-form-register .elgg-subtext {
	width: 56.6818181818%;
	margin: 0 0 0 auto;
}
form.elgg-form.elgg-form-register label,
form.elgg-form.elgg-form-user-requestnewpassword label,
form.elgg-form.elgg-form-login label {
	font-size: 12px;
	line-height: 15px;
	display: block;
	font-weight: normal;
}
form.elgg-form.elgg-form-user-requestnewpassword label {
	margin: 0 0 12px;
}
form.elgg-form.elgg-form-register label,
form.elgg-form.elgg-form-login label {
	float: left;
	width: 38.3720930233%;
	text-align: right;
	margin-top: 6px;
}
form.elgg-form.elgg-form-register fieldset ul label {
	float: none;
	width: auto;
	text-align: left;
	margin-top: 0;
}
form.elgg-form.elgg-form-login label.labelRemember {
	width: auto;
}
form.elgg-form.elgg-form-register input[type="text"],
form.elgg-form.elgg-form-register fieldset input.elgg-input-date[type="text"],
form.elgg-form.elgg-form-register textarea,
form.elgg-form.elgg-form-register fieldset ul,
form.elgg-form.elgg-form-register input[type="password"],
form.elgg-form.elgg-form-register select,
form.elgg-form.elgg-form-register .captchaInputImg,
form.elgg-form.elgg-form-login input[type="text"],
form.elgg-form.elgg-form-login input[type="password"],
form.elgg-form.elgg-form-login select,
form.elgg-form.elgg-form-login .captchaInputImg {
	width: 48.8372093023%;
	float: right;
}
form.elgg-form.elgg-form-register input[type="text"],
form.elgg-form.elgg-form-register input[type="password"],
form.elgg-form.elgg-form-register textarea,
form.elgg-form.elgg-form-register fieldset ul,
form.elgg-form.elgg-form-register select,
form.elgg-form.elgg-form-register .captchaInputImg,
form.elgg-form.elgg-form-login input[type="text"],
form.elgg-form.elgg-form-login input[type="password"],
form.elgg-form.elgg-form-login select,
form.elgg-form.elgg-form-login .captchaInputImg,
form.elgg-form.elgg-form-login .rLoginBtn input[type="submit"],
form.elgg-form.elgg-form-login label.labelRemember {
	margin: 0 5.81395348837% 0 0;
}
form.elgg-form.elgg-form-register select,
form.elgg-form.elgg-form-register fieldset ul,
form.elgg-form.elgg-form-login select {
	width: 51.1627906977%;
}
form.elgg-form.elgg-form-register fieldset ul,
form.elgg-form.elgg-form-register fieldset ul li:last-child,
form.elgg-form.elgg-form-register fieldset ul li:last-child label {
	margin-bottom: 0;
}
body form.elgg-form.elgg-form-user-requestnewpassword input[type="text"],
body form.elgg-form.elgg-form-user-requestnewpassword input[type="password"] {
	margin: 0 5.23255813953% 0 0;
	width: 63.9534883721%;
}
body form.elgg-form.elgg-form-user-requestnewpassword input[type="submit"] {
    width: 26.2558139535%;
}
/* elgg default topbar items (when not using top_notifications) */
ul.theme-topbar-menu-items {
	float: left;
	margin: 2px 0 0 0;
}
ul.theme-topbar-menu-items li {
	margin-left: 15px;
}
ul.theme-topbar-menu-items li,
ul.theme-topbar-menu-items li a,
ul.theme-topbar-menu-items li span {
	display: block;
}
ul.theme-topbar-menu-items li:first-child {
	margin-left: 0;
}
ul.theme-topbar-menu-items li a,
ul.theme-topbar-menu-items li.elgg-state-selected a,
ul.theme-topbar-menu-items li a:hover,
ul.theme-topbar-menu-items li.elgg-state-selected a:hover {
	background: none;
}
ul.theme-topbar-menu-items li a,
ul.theme-topbar-menu-items li.elgg-state-selected a {
	padding: 4px 0;
}
ul.theme-topbar-menu-items li.elgg-menu-item-friends a,
ul.theme-topbar-menu-items li.elgg-menu-item-friends.elgg-state-selected a {
	padding: 2px 0;
}
.messages-new {	/* little numbered circle on notifications */
	line-height: 16px;
    left: 15px;
    top: -2px;
    font-weight: normal;
    font-family: Arial, Helvetica, sans-serif;
    background-color: <?php echo $vars['css']['notif-bg-color']; ?>;
}
/* elgg general forms (textarea/input's size, profile edit, etc.) */
/* this includes some ktForm's compatibility code */
.elgg-form fieldset > div,
.elgg-main .elgg-form select,
.elgg-main .elgg-form .mceEditor { /* establish some limits */
	max-width: 100%;
}
.elgg-form-usersettings-save fieldset > div, /* do not limit settings' page form width */
.elgg-form fieldset > div.elgg-foot {
	max-width: none;
}
.elgg-form .elgg-foot {
	margin: 0;
}
.elgg-main .elgg-form fieldset > div,
.elgg-main .elgg-form .mceEditor,
.elgg-main .elgg-form textarea,
.elgg-form .ktFormWrapper {
    margin-bottom: 15px;
}
.elgg-main .elgg-form .ktFormWrapper .mceEditor {	/* just for ktForm */
	margin-bottom: 0;
}
.elgg-main .elgg-form-profile-edit fieldset > div:after { /* if this doesn't work check "clearfix" class */
	content: " x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x ";
    display: block;
    font-size: xx-large;
    height: 0!important;
    line-height: 0;
    overflow: hidden;
    visibility: hidden;
    clear: both;
}
.elgg-main .elgg-form .mceEditor {
	display: block;
}
.threeCol .ktFormWrapper > label,
.elgg-form div > label,
.breakline.ktFormWrapper > label {
	display: block;
	margin-bottom: 0;
}
.elgg-form .elgg-user-picker > label {	/* just an exception to the above rule (for ktForm) */
	display: inline-block;
}
.elgg-main .elgg-form input[type="text"],
.elgg-main .elgg-form input[type="password"],
.elgg-main .elgg-form textarea,
.elgg-main .elgg-form-profile-edit input.elgg-input-text[name="name"],
.elgg-main .ktFormWrapper .elgg-form input[type="text"],				/* some ktform stuff */
.elgg-main .ktFormWrapper .elgg-form input[type="password"],
.elgg-main .ktFormWrapper .elgg-form input.txtFrm100,
.elgg-main .ktFormWrapper .frmField textarea,
.elgg-main .ktFormWrapper .frmField .elgg-menu-longtext,
#thewire-textarea{
	width: 98.0879541109%;
}
.elgg-main .elgg-form .ktFormWrapper input[type="text"],		/* styling for ktForms NON 'breakline' below this line*/
.elgg-main .elgg-form .ktFormWrapper input[type="password"],
.elgg-main .elgg-form .ktFormWrapper input[type="file"],
.elgg-main .elgg-form .ktFormWrapper .mceEditor,
.elgg-main .elgg-form .ktFormWrapper textarea,
.elgg-main .elgg-form .ktFormWrapper select,
.elgg-main .elgg-form .ktFormWrapper .elgg-input-radios,
.elgg-main .elgg-form .ktFormWrapper .elgg-input-checkboxes,
.elgg-main .elgg-form .ktFormWrapper select[name="membership"] {
	margin-top: 0;
}
.elgg-main .elgg-form input[type="text"],
.elgg-main .elgg-form input[type="password"],
.elgg-main .elgg-form input[type="file"],
.elgg-main .elgg-form .mceEditor,
.elgg-main .elgg-form textarea,
.elgg-main .elgg-form select,
.elgg-main .elgg-form .elgg-input-radios,
.elgg-main .elgg-form .elgg-input-checkboxes,
.elgg-form .elgg-user-picker > label,
.elgg-main .elgg-form select[name="membership"],
.elgg-main .elgg-form .ktFormWrapper.breakline input[type="text"],		/* styling for ktForms 'breakline' below this line*/
.elgg-main .elgg-form .ktFormWrapper.breakline input[type="password"],
.elgg-main .elgg-form .ktFormWrapper.breakline input[type="file"],
.elgg-main .elgg-form .ktFormWrapper.breakline .mceEditor,
.elgg-main .elgg-form .ktFormWrapper.breakline textarea,
.elgg-main .elgg-form .ktFormWrapper.breakline select,
.elgg-main .elgg-form .ktFormWrapper.breakline .elgg-input-radios,
.elgg-main .elgg-form .ktFormWrapper.breakline .elgg-input-checkboxes,
.elgg-main .elgg-form .ktFormWrapper.breakline .elgg-user-picker > label,
.elgg-main .elgg-form .ktFormWrapper.breakline select[name="membership"],
.ktSearchForm .ktFormWrapper.breakline input[type="text"] {
	margin-top: 5px;
}
.elgg-form .elgg-user-picker > input[type="checkbox"] {
	margin-right: 6px;
	margin-top: 0;
}
body .elgg-main .elgg-form input.elgg-input-date[type="text"] { /* just for the calendar thing */
	background-position: 97% 50%;
	background-repeat: no-repeat;
}
body .elgg-main .elgg-form input.elgg-input-date[type="text"],
.elgg-sidebar .ktSearchForm .ktFormWrapper input.elgg-input-date[type="text"] {
	background-image: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-calendar.png);
}
.elgg-main .elgg-form input.halfWidth[type="text"],
.elgg-main .elgg-form input.halfWidth[type="password"],
body .elgg-main .elgg-form input.elgg-input-date[type="text"] {
	width: 45.8891013384%;
}
.elgg-main .elgg-form textarea {
	min-height: 80px;
}
.elgg-main .elgg-form select,
.elgg-main .ktFormWrapper .elgg-form select {
	width: 47.8011472275%;
}
.elgg-main .elgg-form select.birthWidth,
.elgg-main .ktFormWrapper .elgg-form select.birthWidth {
	width: 14.3403441683%;
}
.elgg-main .elgg-form select,
.elgg-main .ktFormWrapper .elgg-form select {
	margin-right: 9px;
}
.elgg-main .elgg-form-profile-edit .elgg-input-access {
	display: block;
}
.elgg-main .elgg-form .frmField .mceEditor,
.elgg-main .elgg-form .frmField .mceLayout {
	width: 75.2517985612%;
}
.elgg-main .elgg-form-profile-edit .elgg-menu {
	margin-right: 10px;
}
.elgg-main .elgg-form input[name="preview"] {
	float: right;
}
.elgg-main .elgg-form br {
	display: none;
}
.elgg-main .elgg-form .elgg-input-checkboxes,
.elgg-main .elgg-form .elgg-input-radios {
	padding-bottom: 5px;
	margin-bottom: 0;
}
.elgg-input-radios label input,
.elgg-input-checkboxes label input { /* leave 'em both */
	display: inline;
	margin: 0 6px 0 0;
}
.elgg-horizontal label {
	display: inline;
}
ul.elgg-input-checkboxes li {
	line-height: 18px;
}
/* ktform's style (continues elgg forms' styling above) */
.ktFormWrapper .elgg-user-picker input[type="text"] {
	margin-bottom: 0;
}
.sortingWrapper {
	margin-bottom: 15px;
}
.sortingWrapper .sortingListing {
	margin: 0;
	padding: 0;
	border-color: <?php echo $vars['css']['base-border-color']; ?>;
}
.ktFormWrapper .frmField select {
    margin: 0;
    max-width: none!important;
}
.ktFormWrapper > label {
	margin-top: 6px;
}
.frmField label {
	display: inline;
	margin: 0;
}
.threeCol .ktFormWrapper > label {
	display: block;
	margin-top: 0;
    float: none;
    text-align: left;
    vertical-align: middle;
    width: auto;
}
.ktFormWrapper .frmField ul {
	margin: 0;
}
.frmField input[type="checkbox"] {
    margin: 0 3px 4px 0;
}
.elgg-main .ktFormWrapper .elgg-form input[type="text"],
.elgg-main .ktFormWrapper .elgg-form input[type="password"],
.elgg-main .ktFormWrapper .elgg-form input.txtFrm100,
.elgg-main .ktFormWrapper .frmField textarea,
.elgg-main .ktFormWrapper .frmField .mceEditor,
.elgg-main .ktFormWrapper .frmField .mceLayout,
.elgg-main .ktFormWrapper .frmField .elgg-menu-longtext {
	max-width: none!important;
}
.threeCol .ktFormWrapper .frmField,
.threeCol .ktFormWrapper p.ktFormP,
.threeCol .infoFormText p {
	width: auto;
	float: none;
}
.ktFormWrapper p.ktFormP,
.infoFormText p {
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
}
/* ktform search (appears on sidebar) */
.elgg-sidebar .ktSearchForm .ktFormWrapper input[type="text"],
.elgg-sidebar .ktSearchForm .ktFormWrapper input[type="password"],
.elgg-sidebar .ktSearchForm .ktFormWrapper input[type="file"] {
	width: 170px;
}
.elgg-sidebar .ktSearchForm .ktFormWrapper .frmField select {
    width: 180px;
}
/* autocomplete */
.ui-autocomplete {
	width: 74.964028777%!important;
	border-color: <?php echo $vars['css']['base-border-color']; ?>;
}
.ui-autocomplete .ui-menu-item {
	padding: 0;
}
.ui-autocomplete a.ui-corner-all {
	padding: 5px;
	display: block;
}
.ui-autocomplete .ui-menu-item > a:hover,
.ui-autocomplete .ui-menu-item > a.ui-state-hover {
	background: <?php echo $vars['css']['mn-background-color-hover']; ?>;
}
.ui-autocomplete .ui-menu-item > a:hover,
.ui-autocomplete .ui-menu-item > a.ui-state-hover,
.ui-autocomplete .ui-menu-item > a:hover .elgg-subtext,
.ui-autocomplete .ui-menu-item > a.ui-state-hover .elgg-subtext,
.ui-autocomplete .ui-menu-item > a:hover a,
.ui-autocomplete .ui-menu-item > a.ui-state-hover a {
	color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
}
.ui-autocomplete a .elgg-body > h3 {
	padding-top: 7px;
}
/* datepicker */
.ui-datepicker,
.ui-autocomplete {
	z-index: 12!important;
}
.ui-datepicker-header {
    background: <?php echo $vars['css']['base-link-color']; ?>;
    border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.ui-datepicker {
    border: 1px solid <?php echo $vars['css']['base-link-color']; ?>;
}
.ui-datepicker th,
.ui-datepicker-calendar .ui-state-default {
	color: <?php echo $vars['css']['base-link-color']; ?>;
}
/* blogs */
#blog-post-edit span.message.warning {
	text-align: right;
	display: block;
	margin: 0 0 10px;
	font-style: italic;
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
	font-size: 12px;
	line-height: 14px;
}
/* user settings */
.elgg-form-usersettings-save .elgg-module {
	border: none;
}
.rFrmSet {
    margin: 0 0 15px;
}
.rFrmSet label {
    display: block;
    margin: 11px 10px 0 2px;
    text-align: right;
    width: 25.3237410072%;
}
.elgg-main .elgg-form .rFrmSet input[type="text"],
.elgg-main .elgg-form .rFrmSet input[type="password"],
.elgg-main .elgg-form .rFrmSet select {
    float: left;
    width: 46.3309352518%;
}
.elgg-main .elgg-form .rFrmSet select {
    width: 48.9208633094%;
}
.elgg-form-usersettings-save table {
    width: 40%;
}
.elgg-form-usersettings-save .elgg-input-radios.elgg-vertical,
.elgg-form-usersettings-save .elgg-input-radios.elgg-vertical li label {
    margin: 0;
}
.elgg-form-usersettings-save .elgg-input-radios.elgg-vertical li label,
.elgg-form-usersettings-save .elgg-input-radios.elgg-vertical li,
.elgg-form-usersettings-save .elgg-input-radios.elgg-vertical li label input {
    display: inline;
}
.elgg-form-usersettings-save .elgg-input-radios.elgg-vertical li {
    margin: 0 20px 0 0;
}
.elgg-form-usersettings-save .elgg-input-radios.elgg-vertical li label input {
    margin: 0 6px 0 0;
}
/* widgets edit */
.elgg-form-widgets-save {
	padding: 10px;
}
.elgg-widget-edit .elgg-form.elgg-form-widgets-save {
	font-size: 12px;
	line-height: 14px;
	text-indent: 2px;
}
.elgg-widget-edit .elgg-form.elgg-form-widgets-save input[type="text"],
.elgg-widget-edit .elgg-form.elgg-form-widgets-save input[type="password"],
.elgg-widget-edit .elgg-form.elgg-form-widgets-save select {
	margin: 8px 0 0 0;
	display: block;
	width: 282px;
}
.elgg-widget-edit .elgg-form fieldset .elgg-foot {
	margin: 0;
	padding: 10px 0 0 0;
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
/* user messages */
form.elgg-form-messages-process .messages-container {	/* fixes items not reaching full width in this particular form */
	max-width: none;
}
.messages-subject input[type="checkbox"] {
	margin: 0 6px 4px 0;
}
.elgg-main > .message.read .messages-subject,
.bodyMessages h2.elgg-heading-main {
	text-overflow: ellipsis;
	-o-text-overflow: ellipsis;
	-webkit-text-overflow: ellipsis;
	white-space: nowrap;
}
.messages-container .elgg-image-block.message.read {	/* this is for the messages' list */
	margin: 0;
}
.elgg-image-block.message.read {						/* and this is for the messages' single view */
	margin: 0 0 20px;
}
.messages-timestamp {
	font-size: 11px;
	line-height: 13px;
}
#messages-reply-form {
	padding-top: 20px;
	margin-top: 20px;
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.messages-container .elgg-list > li:last-child {
	border: none;
	margin: 0;
}
/* page's menu */
ul.treeview,
.treeview ul {
    padding: 0 10px;
}
/* friends' list */
.elgg-list ul.elgg-menu.elgg-menu-entity {
	margin-top: 0;
}
ul.elgg-menu.elgg-menu-entity .elgg-button.list-members {
	display: inline-block;
}
/* header search */
.elgg-search-header {
	bottom: auto;
	right: auto;
    min-height: 23px;
  	min-width: 0;
  	margin: 2px 20px 0 0;
    position: relative;
}
.elgg-search-header input[type="text"] {
    background: <?php echo $vars['css']['input-background-color']; ?>;
    border: none;
    color: <?php echo $vars['css']['input-font-color']; ?>;
    font-size: 11px;
    font-weight: normal;
    padding: 3px 4px 2px;
    border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    width: 180px;
}
.elgg-search-header input[type="text"]:focus {
	background: <?php echo $vars['css']['input-background-color-focus']; ?>;
	color: <?php echo $vars['css']['input-font-color-focus']; ?>;
	border: none;
    color: <?php echo $vars['css']['input-font-color-focus']; ?>;
    background: <?php echo $vars['css']['input-background-color-focus']; ?>;
}
.elgg-search input[type="submit"] {
    display: block;
    height: 23px;
    min-width: 23px;
    padding-right: 8px;
    padding-left: 8px;
    font-size: 11px;
    border-radius: 0 <?php echo $vars['css']['btn-border-radius']; ?> <?php echo $vars['css']['btn-border-radius']; ?> 0;
    -moz-border-radius: 0 <?php echo $vars['css']['btn-border-radius']; ?> <?php echo $vars['css']['btn-border-radius']; ?> 0;
    -webkit-border-radius: 0 <?php echo $vars['css']['btn-border-radius']; ?> <?php echo $vars['css']['btn-border-radius']; ?> 0;
}
button::-moz-focus-inner,
input[type="reset"]::-moz-focus-inner,
input[type="button"]::-moz-focus-inner,
input[type="submit"]::-moz-focus-inner,
input[type="file"] > input[type="button"]::-moz-focus-inner {
  padding: 0!important;
  border: 0 none!important;
}
.expandableSearch.elgg-search-header {	/* this is for the expandable input function */
	width: 99px;
	height: 23px;
}
.expandableSearch.elgg-search-header input[type="text"] {
	width: 65px;
	position: absolute;
	top: 0;
	right: 23px;
	float: none!important;
	border-radius: <?php echo $vars['css']['btn-border-radius']; ?> 0 0 <?php echo $vars['css']['btn-border-radius']; ?>;
    -moz-border-radius: <?php echo $vars['css']['btn-border-radius']; ?> 0 0 <?php echo $vars['css']['btn-border-radius']; ?>;
    -webkit-border-radius: <?php echo $vars['css']['btn-border-radius']; ?> 0 0 <?php echo $vars['css']['btn-border-radius']; ?>;
}
.expandableSearch.elgg-search-header input[type="submit"] {
	position: absolute;
	top: 0;
	right: 0;
	float: none!important;
}
/* profile fix */
.profile .elgg-inner {
	padding: 0;
}
/* profile widgets */
.elgg-widget-instance-friends .elgg-gallery {	/* friends' profile widget */
	overflow: hidden;
	margin: 0;
	padding: 0 0 0 2px;
}
.elgg-widget-instance-friends .elgg-gallery li {
	float: left;
	min-width: 25px;
	min-height: 25px;
	margin: 0;
	padding: 0;
	display: block;
	line-height: 0;
}
.elgg-widget-instance-friends .elgg-gallery li .elgg-avatar-tiny {
	margin: 0 8px 8px 0;
}
.elgg-widget-instance-friends .elgg-gallery li .elgg-avatar-small {
	margin: 0 10px 10px 0;
}
.elgg-widget-instance-friends .elgg-gallery li:nth-child(9n) .elgg-avatar-tiny {
	margin-right: 0;
}
.elgg-widget-instance-friends .elgg-gallery li:nth-child(6n) .elgg-avatar-small {
	margin-right: 0;
}
/* common text uls */
.elgg-output ul {
	list-style: disc;
}
.elgg-output ul,
.elgg-output ol {
	padding: 0 0 0 20px;
}
