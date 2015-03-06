<?php
/**
 * CSS form/input elements
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* Form Elements */
fieldset > div {
	margin-bottom: 15px;
}
fieldset > div:last-child {
	margin-bottom: 0;
}
.elgg-form-alt > fieldset > .elgg-foot,
.elgg-foot.ktForm,
.elgg-form .elgg-foot,
.commenFrmRBtn.rBtn {
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	padding: 10px 0;
}
.elgg-longtext-control {
	float: right;
	margin-left: 14px;
	font-size: 11px;
    line-height: 13px;
	cursor: pointer;
}
.elgg-input-access {
	margin: 5px 0 0 0;
}
input[type="checkbox"],
input[type="radio"] {
	margin: 0 3px 0 0;
	padding: 0;
	border: none;
	width: auto;
}
.elgg-input-checkboxes.elgg-horizontal li,
.elgg-input-radios.elgg-horizontal li {
	display: inline;
	padding-right: 10px;
}
.elgg-form-login,
.elgg-form-account {
	max-width: 450px;
}
/* friends picker */
.friends-picker-main-wrapper {
	margin-bottom: 15px;
	padding: 10px 0 0 0;
}
.friends-picker-container h3 {
	font-size: 4em!important;
	text-align: left;
	margin: 10px 0 20px!important;
	color: #999!important;
	background: none!important;
	padding: 0!important;
}
.friends-picker .friends-picker-container .panel ul {
	text-align: left;
	margin: 0;
	padding: 0;
}
.friends-picker-wrapper {
	margin: 0;
	padding: 0;
	position: relative;
	width: auto;
}
.friends-picker {
	position: relative;
	overflow: hidden;
	margin: 0;
	padding: 0;
	height: auto;
}
.friends-picker,
.friends-picker .friends-picker-container .panel {
    width: 695px;
}
.friendspicker-savebuttons {
	background: #fff;
	margin: 0 10px 10px;
}
.friends-picker .friends-picker-container { /* long container used to house end-to-end panels. Width is calculated in JS  */
	position: relative;
	left: 0;
	top: 0;
	width: 100%;
	list-style-type: none;
}
.friends-picker .friends-picker-container .panel {
	float: left;
	height: 100%;
	position: relative;
	margin: 0;
	padding: 0;
}
.threeCol .friends-picker,
.threeCol .friends-picker .friends-picker-container .panel {
	width: 523px;
}
.friends-picker .friends-picker-container .panel .wrapper {
	margin: 0;
	padding: 4px 10px 10px 10px;
	min-height: 230px;
}
.friends-picker-navigation {
	margin: 0 0 10px;
	padding:0 0 10px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
body .friends-picker-navigation ul {
	list-style: none;
	padding-left: 0;
	overflow: hidden;
	height: auto;
	margin: 0;
}
.friends-picker-navigation ul li {
	float: left;
	margin: 0;
	background: #fff;
}
.friends-picker-navigation a {
	font-weight: bold;
	text-align: center;
	background: #fff;
	color: #999;
	text-decoration: none;
	display: block;
	padding: 0;
	width: 19px;
}
.tabHasContent {
	background: #fff;
	color: #333!important;
}
.friends-picker-navigation li a:hover {
	background: #333;
	color: #fff!important;
	text-decoration: none;
}
.friends-picker-navigation li a.current {
	background: #4690D6;
	color: #fff!important;
}
.friends-picker-navigation-l,
.friends-picker-navigation-r {
	position: absolute;
	top: 39px;
	text-indent: -9000em;
}
.friends-picker-navigation-l a,
.friends-picker-navigation-r a {
	display: block;
	height: 40px;
	width: 40px;
}
.friends-picker-navigation-l {
	right: 48px;
	z-index: 1;
}
.friends-picker-navigation-r {
	right: 0;
	z-index: 1;
}
.friends-picker-navigation-l {
	background: url(<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png) no-repeat left top;
}
.friends-picker-navigation-r {
	background: url(<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png) no-repeat -60px top;
}
.friends-picker-navigation-l:hover {
	background: url(<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png) no-repeat left -44px;
}
.friends-picker-navigation-r:hover {
	background: url(<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png) no-repeat -60px -44px;
}
.friendspicker-savebuttons .elgg-button-submit,
.friendspicker-savebuttons .elgg-button-cancel {
	margin: 5px 20px 5px 5px;
}
.friendspicker-members-table {
	background: #dedede;
	margin: 10px 0 0;
	padding: 10px 10px 0;
}
.friends-picker-container .wrapper td > div {
	margin: 0 5px!important;
	width: 25px!important;
	height: 25px!important;
}
.friends-picker-container .wrapper td {
	vertical-align: middle;
}
.friends-picker-container .wrapper td input[type="checkbox"] {
	margin: 0;
}
/* autocomplete */
<?php //autocomplete will expand to fullscreen without max-width ?>
.ui-autocomplete {
	position: absolute;
	cursor: default;
}
.elgg-autocomplete-item .elgg-body {
	max-width: 600px;
}
.ui-autocomplete {
	background-color: #fff;
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	overflow: hidden;
}
.ui-autocomplete .ui-menu-item {
	padding: 0 4px;
}
.ui-autocomplete .ui-menu-item:hover {
	background-color: #eee;
}
.ui-autocomplete a:hover {
	text-decoration: none;
	color: #4690D6;
}
/* USER PICKER */
.elgg-main ul.elgg-user-picker-list {
	list-style: none;
	width: auto;
}
.elgg-user-picker-list li:first-child {
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-user-picker-list > li {
	padding: 5px 1px;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
/* DATE PICKER */
.ui-datepicker {
	display: none;
	margin-top: 3px;
	width: 208px;
	background-color: #fff;
	border: 1px solid #0054A7;
	overflow: hidden;
}
.ui-datepicker-header {
	position: relative;
	background: #4690D6;
	color: #fff;
	padding: 2px 0;
	border-bottom: 1px solid #0054A7;
}
.ui-datepicker-header a {
	color: #fff;
}
.ui-datepicker-prev,
.ui-datepicker-next {
    position: absolute;
    top: 5px;
	cursor: pointer;
}
.ui-datepicker-prev {
    left: 6px;
}
.ui-datepicker-next {
    right: 6px;
}
.ui-datepicker-title {
    line-height: 1.8em;
    margin: 0 30px;
    text-align: center;
	font-weight: bold;
}
.ui-datepicker-calendar {
	margin: 4px;
}
.ui-datepicker th {
	color: #0054A7;
	border: none;
    font-weight: bold;
    padding: 5px 6px;
    text-align: center;
}
.ui-datepicker td {
	padding: 1px;
}
.ui-datepicker td span,
.ui-datepicker td a {
    display: block;
    padding: 2px;
	line-height: 1.2em;
    text-align: right;
    text-decoration: none;
}
.ui-datepicker-calendar .ui-state-default {
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    color: #4690D6;
	background: #fafafa;
}
.ui-datepicker-calendar .ui-state-hover {
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    color: #0054A7;
	background: #eee;
}
.ui-datepicker-calendar .ui-state-active,
.ui-datepicker-calendar .ui-state-active.ui-state-hover {
	font-weight: bold;
    border: 1px solid #0054A7;
    color: #0054A7;
	background: #E4ECF5;
}
