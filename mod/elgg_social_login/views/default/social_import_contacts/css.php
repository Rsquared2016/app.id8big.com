<?php

/*
 * CSS
 */
 
if(!isset($vars['css']['base-border-color'])) {
	$vars['css']['base-border-color'] = '#eaf1f4';
}

?>
.socialImportContactsWrapper.socialImportContactsLightbox {
	width: 550px;
	padding: 10px;
}
.socialImportContactsWrapper.socialImportContactsLightbox textarea {
	width: 100%;
	height: 60px;
	margin-top: 5px;
}
.elgg-form-social-import-contacts fieldset {
	margin: 0;
}
.elgg-form-social-import-contacts .elgg-subtext {
	margin: 0 0 20px;
}
.elgg-form-social-import-contacts label {
	text-align: right;
	width: 90px;
	font-size: 12px;
	font-weight: bold;
	margin: 0 12px 0 0;
	line-height: 27px;
}
.elgg-form.elgg-form-social-import-contacts-import fieldset > div {
	max-width: 100%;
}
.elgg-form.elgg-form-social-import-contacts-import textarea {
	width: 100%;
}
.elgg-form.elgg-form-social-import-contacts-import .contactsPickerWrapper,
.elgg-form.elgg-form-social-import-contacts-import .contactsPickerWrapper .friends-picker{
	max-width: 652px;
}
.contactsPickerWrapper p {
	margin-top: 18px;
}
.contactsPickerWrapper .memberType {
	margin-bottom: 10px;
}
.elgg-form-social-import-contacts div .elgg-input-text {
	width: 306px;
}
.elgg-form-social-import-contacts .elgg-foot,
.elgg-form-social-import-contacts-share .elgg-foot {
	border-top: none;
}
.elgg-form-social-import-contacts,
.elgg-form-social-import-contacts-invite-contacts,
.shareButtonsWrapper {
	overflow: hidden;
	padding: 2px 10px;
	border: 1px solid #E0E0E0;
	background: none repeat scroll 0 0 #F5F5F5;
}
.elgg-form-social-import-contacts-invite-contacts {
	padding: 12px 10px;
}
.elgg-form.elgg-form-social-import-contacts-invite-contacts textarea {
	height: 80px;
}
.elgg-form-social-import-contacts-invite-contacts .elgg-foot,
.elgg-form-social-import-contacts-share .elgg-foot {
	margin: 0 !important;
	padding-bottom: 0;
}
.elgg-form-social-import-contacts-share .elgg-foot {
	padding-right: 6px;
}
/* title */
.socialImportContactsWrapper .mainTitle {
	padding: 0 0 16px;
	margin: 0 0 15px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.socialImportContactsWrapper .mainTitle h2 {
	background: url(<?php echo ELGG_SOCIAL_LOGIN_GRAPHICS; ?>logo-import.png) 100% 0 no-repeat;
	font-size: 16px;
	font-weight: bold;
	padding: 0 105px 0 0;
	margin: 0;
	line-height: 22px;
	display: inline-block;
}
.socialImportContactsWrapper > h3 {
	font-size: 12px;
	font-weight: bold;
	margin: 0 0 15px;
	line-height: 1.2;
}
.invited_contacts_wrapper .elgg-head {
	padding: 17px 0 7px 0 !important;
}
.invited_contacts_wrapper .elgg-head.ttu {
	text-transform: uppercase;
}
/* text */
.iewTxt {
	margin: 20px 0;
}
.iewTxt p:last-child {
	margin: 0;
}
/* social buttons */
.socialImportContactsWrapper .socialButtons a {
	color: #000;
	float: left;
	text-decoration: none;
}
.socialImportContactsWrapper .socialButtons {
	margin: 0 0 15px;
	border-bottom: 1px solid #EAF1F4;
	height: 38px;
}
.socialImportContactsWrapper .socialBtnContent {
	min-height: 276px;
}
.btnEmail,
.btnShare {
	font-weight: bold;
	padding-top: 10px;
	padding-bottom: 10px;
}
.btnFacebook {
	background: url(<?php echo ELGG_SOCIAL_LOGIN_GRAPHICS; ?>btn-fb.png) 15px 0 no-repeat;
	width: 90px;
	height: 36px;
}
.btnLinkedIn {
	background: url(<?php echo ELGG_SOCIAL_LOGIN_GRAPHICS; ?>btn-linkedin.png) 17px 0 no-repeat;
	width: 96px;
	height: 36px;
}
.btnGoogle {
	background: url(<?php echo ELGG_SOCIAL_LOGIN_GRAPHICS; ?>btn-google.png) 17px 0 no-repeat;
	width: 93px;
	height: 36px;
}
.btnLinkedIn,
.btnGoogle {
	padding: 0 2px;
}
.socialBtn {
	/*border-bottom: 2px solid white;*/
	/*margin: 0 30px 0 0;*/
	padding-left: 15px;
	padding-right: 15px;
	cursor: pointer;
	overflow: hidden;
	-webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
    -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
    -ms-transition: border linear 0.2s, box-shadow linear 0.2s;
    -o-transition: border linear 0.2s, box-shadow linear 0.2s;
    transition: border linear 0.2s, box-shadow linear 0.2s;
}
.socialBtn { /* IE8 */
	border /*\**/: 1px solid #fff\9
}
.socialBtn.btnFB {
	margin-left: 4px;
}
.socialBtn.on {
	border-bottom: 2px solid gray;
}
/* Share Buttons */
.shareButtonsWrapper {
	padding: 12px;
}
.shareButtonsWrapper input#share {
	width: 98%;
}
.shareButtonsWrapper .shareButtons {
	float: right;
	margin: 10px 5px 0 0;
}
.shareButtonsWrapper .shareUrl label {
	margin: 0 0 7px 0;
}
.shareButtonsWrapper .shareButton {
	display: inline-block;
	height: 32px;
	margin: 0 0 0 5px;
	text-decoration: none;
	width: 32px;
}
/*.socialBtn.on {
	box-shadow: 0 0 4px #36A2CC;
}
.socialBtn.on {*/ /* IE8 */
	/*border*/ /*\**//*: 1px solid #36A2CC\9*/
/*}*/