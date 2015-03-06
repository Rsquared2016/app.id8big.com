<?php
	/*
	 * CSS top_notifications
	 */
?>
ul.topNotifications {
    /* margin: 4px 15px 0 0; */
    margin: 0;
    padding: 0;
    list-style: none;
    float: left;
}
.reqIco {
    width: 32px;
    height: 24px;
    position: relative;
    float: left;
    margin-right: 10px!important;
    margin-top: 0!important;
}
.reqIco a.aGo {
    display: block;
    height: 17px;
    position: absolute;
    width: 28px;
    z-index: 123;
}
.reqIco.ico0 {
	z-index: 2;
	/*margin: 0!important;*/
	height: 30px!important;
	width: 30px!important;
}
.reqIco.ico1 {
	z-index: 1;
	margin-right: 0!important;
}
.reqIco.ico2 {
	z-index: 0;
}
.reqIco div.divIco {
	position: absolute;
	z-index: 1234;
	width: 26px;
	height: 18px;
	cursor: pointer;
    padding: 5px 2px 0;
}
.reqIco div.divIco span.count {
	display: block;
	padding-bottom: 0;
	position: absolute;
	right: -5px;
    top: -3px;
    z-index: 1;
}
.reqIco div.divIco span.count.no {
	display: none;
}
.reqIco div.divIco.on span.count {
	right: -4px;
    top: -4px;
}
.reqIco div.divIco span.count .counter {
	display: block;
	background: #d2022a;
	color: #fff;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 9px;
    height: 12px;
    min-width: 10px;
    line-height: 11px;
    padding: 0 2px;
    text-align: center;
}
.reqIco .reqList {
	display: none;
	z-index: 1000;
	left: -301px;
    top: 23px;
	position: absolute;
	width: 333px;
	padding: 0;
}
.reqIco .reqList.noTheme {
	left: 0;
}
.reqListInner {
	border: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else { echo '#E7ECEF'; } ?>;
	background: <?php if (isset($vars['css']['mn-background-color'])) { echo $vars['css']['mn-background-color']; } else { echo '#fff'; } ?>;
	padding: 12px 0 0 0;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
}
.on .reqListInner {
	border-radius: 5px 0 5px 5px;
	-moz-border-radius: 5px 0 5px 5px;
	-webkit-border-radius: 5px 0 5px 5px;
}
.reqIco .reqList h2 {
	font-size: 12px;
	line-height: 14px;
	font-weight: bold;
	margin: 0;
	padding: 0 12px 10px;
	color: <?php if (isset($vars['css']['base-color'])) { echo $vars['css']['base-color']; } else { echo '#404548'; } ?>;
}
.reqIco .reqList .reqItem,
.reqIco .reqList .riEmpty,
.reqIco .reqList .riRequest {
	margin: 0;
	padding: 9px 12px;
	border-top: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else { echo '#E7ECEF'; } ?>;
	color: <?php if (isset($vars['css']['base-color'])) { echo $vars['css']['base-color']; } else { echo '#404548'; } ?>;
}
.messageListTop .reqList .reqItem {
	cursor: pointer;
}
.reqIco .reqList .reqItem.hover,
.reqIco .reqList .reqItem.hover .txt p,
.reqIco .reqList .reqItem.hover .txt p a,
.reqIco .reqList .reqItem.hover .txt .buttons a,
.reqIco .reqList .reqItem.hover .activityListDescription,
.reqIco .reqList .reqItem.hover acronym {
	background-color: <?php if (isset($vars['css']['mn-background-color-hover'])) { echo $vars['css']['mn-background-color-hover']; } else { echo '#72B2EB'; } ?> !important;
	color: <?php if (isset($vars['css']['mn-font-color-hover'])) { echo $vars['css']['mn-font-color-hover']; } else { echo '#fff'; } ?> !important;
}
.reqIco .reqList .reqItem.newestTopNotifications,
.reqIco .reqList .riEmpty.newestTopNotifications,
.reqIco .reqList .riRequest.newestTopNotifications {
	background-color: <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else { echo '#E7ECEF'; } ?>;
    border: none;
    margin-bottom: -1px;
    margin-left: 0;
    margin-right: 0;
    padding-left: 10px;
    padding-right: 10px;
}
.reqIco .reqList .reqItem .img,
.reqIco .reqList .riRequest .img {
	float: left;
	width: 40px;
	height: 40px;
	margin: 0 7px 0 0;
}
.reqIco .reqList .reqItem .img img,
.reqIco .reqList .reqItem .img a,
.reqIco .reqList .riRequest .img img,
.reqIco .reqList .riRequest .img a {
	display: block;
}
.reqIco .reqList .reqItem .txt,
.reqIco .reqList .riRequest .txt {
	float: left;
	width: 260px;
}
.reqIco .reqList .reqItem .txt p,
.reqIco .reqList .riRequest .txt p {
	margin: 0;
    padding: 7px 0 0 0;
	line-height: 13px;
	font-size: 11px;
	word-wrap: normal;
}
.reqIco .reqList .reqItem .txt p.notMessage a {
	color: <?php if (isset($vars['css']['base-link-color'])) { echo $vars['css']['base-link-color']; } else { echo '#53A8F4'; } ?>;
	text-decoration: none;
	line-height: 13px;
}
.reqIco .reqList .reqItem .txt p.notMessage a:hover {
	text-decoration: underline;
}
.reqIco .reqList .reqItem:hover .txt p a,
.reqIco .reqList .reqItem.hover .txt p a {
	color: <?php if (isset($vars['css']['base-link-color'])) { echo $vars['css']['base-link-color']; } else { echo '#53A8F4'; } ?>;
	line-height: 13px;
}
.reqIco .reqList .reqItem .txt p.notMessage {
	margin: 0;
	line-height: 13px;
}
/* list buttons */
.reqIco .reqList .reqItem .txt .reqButtons a,
.reqIco .reqList .reqItem .txt .reqButtons a,
.reqIco .reqList .riRequest .txt .reqButtons a,
.reqIco .reqList .riRequest .txt .reqButtons a {
	display: block;
	font-size: 11px;
	text-align: center;
	line-height: 18px;
	padding: 0 10px;
	margin: 0 5px 0 0;
	float: left;
	text-decoration: none;
	color: <?php if (isset($vars['css']['mn-font-color-hover'])) { echo $vars['css']['mn-font-color-hover']; } else { echo '#fff'; } ?>;
	background: <?php if (isset($vars['css']['mn-background-color-hover'])) { echo $vars['css']['mn-background-color-hover']; } else { echo '#72B2EB'; } ?>;
}
.reqIco .reqList .reqItem .txt .reqButtons a.aNo,
.reqIco .reqList .riRequest .txt .reqButtons a.aNo {
	background: #929292;
}
/* list text */
.reqIco .reqList .viewAll {
	/*height: 29px;*/
    height: auto;
	margin: 0;
	padding: 0 12px;
	border-top: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else { echo '#E7ECEF'; } ?>;
	background: #F3F8FB;
}
.reqIco .reqList .viewAll p a {
	line-height: 27px;
}
.reqIco .reqList .viewAll p {
	margin: 0;
	padding: 0;
	text-align: right;
	font-size: 11px;
}
.reqIco .reqList .reqItemEmpty p,
.reqIco .reqList .viewAll p.pUnanswered {
	color: <?php if (isset($vars['css']['base-light-text-color'])) { echo $vars['css']['base-light-text-color']; } else { echo '#7b858a'; } ?>;
}
.reqIco .reqList .reqItemEmpty p {
	margin: 0;
	padding: 3px 5px 2px;
	font-size: 11px;
	line-height: 13px;
}
.reqIco.ico0 div.divIco {
	background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-0.png) 6px 5px no-repeat;
}
.reqIco.ico1 div.divIco {
	background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-1.png) 6px 5px no-repeat;
}
.reqIco.ico2 div.divIco {
	background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-2.png) 6px 4px no-repeat;
}
.reqIco.ico0 div.divIco.on {
	background-position: 5px 4px;
}
.reqIco.ico1 div.divIco.on {
	background-position: 5px 4px;
}
.reqIco.ico2 div.divIco.on {
	background-position: 5px 3px;
}
.reqIco div.divIco.on {
	border-width: 1px;
	border-style: solid;
	border-color: <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else { echo '#E7ECEF'; } ?>;
    border-bottom: none;
    background-color: <?php if (isset($vars['css']['mn-background-color'])) { echo $vars['css']['mn-background-color']; } else { echo '#fff'; } ?>;
    border-radius: 3px 3px 0 0;
    -moz-border-radius: 3px 3px 0 0;
    -webkit-border-radius: 3px 3px 0 0;
}
.reqItem div.reqButtons,
.riRequest div.reqButtons {
    float: none;
    text-align: left;
    padding: 2px 0 0 0;
}
.activityListDescription {
    color: <?php if (isset($vars['css']['base-light-text-color'])) { echo $vars['css']['base-light-text-color']; } else { echo '#7b858a'; } ?>;
    font-size: 11px;
    line-height: 18px;
    padding: 0 0 0 25px;
}
.activityListDescription.ico0 {
    background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-activity-0.png) 0 2px no-repeat;
}
.activityListDescription.ico1 {
    background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-activity-1.png) 0 3px no-repeat;
}
.activityListDescription.ico2 {
    background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-activity-2.png) 0 -1px no-repeat;
}
.activityListDescription.ico3 {
    background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-activity-3.png) 0 0 no-repeat;
}
.activityListDescription.ico4 {
    background: url(<?php echo $vars['url']; ?>mod/top_notifications/graphics/ico-activity-4.png) 0 3px no-repeat;
}
.activityListDescription.descMessage {
	padding: 0;
	margin: 0;
}
/* style page notifications */
.notificationWrapper .reqItem {
	margin: 0 0 8px 0;
	padding: 0 0 8px 0;
	border-bottom: 1px solid #DBDBDB;
}
.notificationWrapper .reqItem .img {
	float: left;
	margin-right: 8px;
}
.notificationWrapper .reqItem .txt {
	float: left;
	width: 90%;
}
/* profile edit */
.elgg-form-profile-edit fieldset div > input[type="text"] {
	margin: 0 10px 0 0;
}
.elgg-form-profile-edit fieldset div > select {
	margin-top: 0;
}
.elgg-form-profile-edit .mceEditor,
.elgg-form-profile-edit textarea {
	margin-bottom: 10px;
	display: block;
}
.elgg-form-profile-edit .elgg-menu.elgg-menu-longtext {
	margin: -18px 0 0 0;
}