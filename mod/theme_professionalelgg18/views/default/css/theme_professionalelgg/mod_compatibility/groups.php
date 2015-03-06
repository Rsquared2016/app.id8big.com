<?php
	/* groups styles */
?>
/* groups' profile */
.groups-profile > .elgg-image {
	margin-right: 10px;
}
.groups-profile-icon {
    margin-bottom: 10px;
}
.groups-profile-fields .elgg-output {
	margin: 0;
}
.groups-profile-fields .odd,
.groups-profile-fields .even,
.groups-stats {
    background: none;
    border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    margin: 0;
    padding: 0;
}
.groups-profile-fields .odd,
.groups-profile-fields .even {
    margin-bottom: 8px;
}
.groups-stats p {
	margin-bottom: 5px;
}
.groups-stats p:last-child {
	margin: 0;
}
/* groups top dropdown (at title's right side) */
body .elgg-main .elgg-head .btn-group ul,
body .elgg-menu-profile-groups-tabs .elgg-menu-item-more ul { /* remove bullets from top dropdown */
	list-style: none;
}
.btn-group ul {
    left: auto;
    right: 3px;
}
/* groups widget */
.groups-widget-viewall {
	float: right;
	font-size: 11px;
}
#groups-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}
#groups-tools > li:nth-child(odd) {
	margin-right: 4%;
}
#groups-tools > li:nth-child(2n+1) {
	margin-right: 3%;
}
.elgg-widget-instance-a_users_groups .elgg-subtext {
	line-height: 18px;
	font-size: 12px;
	color: <?php echo $vars['css']['base-color']; ?>;
}
.elgg-widget-instance-a_users_groups .elgg-widget-content .elgg-subtext {	/* profile widget */
	line-height: 1.2;
	font-size: <?php echo $vars['css']['widget-list-font-size']; ?>;
	color: <?php echo $vars['css']['base-color']; ?>;
}
.featuredGroupItem {
	margin-bottom: 10px;
}
.featuredGroupItem:last-child {
	margin: 0;
}
.bodyGroup .elgg-module-group .elgg-widget-more,
.bodyGroup_profile .elgg-module-group .elgg-widget-more {
	float: left;
}
.bodyGroup .elgg-module-group .elgg-widget-more-all,
.bodyGroup_profile .elgg-module-group .elgg-widget-more-all {
	float: right;
}
.bodyGroup .elgg-widget-group-forum .elgg-widget-more,
.bodyGroup_profile .elgg-widget-group-forum .elgg-widget-more {
	display: none;
}
.bodyGroup .elgg-widget-group-forum .elgg-widget-more.elgg-widget-more-all,
.bodyGroup_profile .elgg-widget-group-forum .elgg-widget-more.elgg-widget-more-all {
	display: block;
}
/* groups' comments */
.bodyGroup_profile .elgg-comments h3 {
	display: none;
}
.groups-latest-reply {
	float: right;
}
.groups-profile.elgg-image-block {
    margin: 0 0 15px 0;
}
body.bodyGroup_profile .elgg-form-profile-groups-discussion fieldset > div {
	max-width: 100%;
}
body.bodyGroup_profile .elgg-form-profile-groups-discussion .elgg-input-text {
	width: 100%;
}
/* last tab */
.elgg-menu-profile-groups-tabs .elgg-menu-item-more .btn-group button {
	background: none;
	border: none;
	padding: 8px 12px 6px;
	margin: 0;
	min-width: 50px;
	box-shadow: none;
	font-size: 12px;
	color: <?php echo $vars['css']['base-link-color']; ?>;
}
.elgg-menu-profile-groups-tabs .elgg-menu-item-more .btn-group.open button {
	background-color: <?php echo $vars['css']['tab-background-color-hover']; ?>;
	color: <?php echo $vars['css']['tab-font-color-hover']; ?>;
}
.elgg-menu-profile-groups-tabs .elgg-menu-item-more .btn-group .elgg-state-selected a {
	background: <?php echo $vars['css']['mn-background-color-sel']; ?>;
	color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
	border: none;
}
