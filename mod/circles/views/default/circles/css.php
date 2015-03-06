<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$mod_path = $vars['url'] . 'mod/circles/graphics/';
?>
/* riverdashboard filter */
.riverdashboardFilter {
	position: relative;
	width: 100%;
	z-index: 1234;
	*zoom: 1;
}
.riverdashboardFilter,
.riverdashboardFilter .rdfTitle {
	height: 25px;
	line-height: 25px;
}
.riverdashboardFilter .rdfTitle {
	position: relative;
	float: right;
	width: 70px;
	right: 0;
	top: 0;
	background: url(<?php echo $mod_path; ?>fon-arrow-rd-filter.png) 98% 50% no-repeat #fff;
	text-align: center;
	font-size: 11px;
	text-transform: uppercase;
	z-index: 12;
	cursor: pointer;
}
.riverdashboardFilter .rdfMn {
	width: 150px;
	position: absolute;
	right: 0;
	top: 25px;
	display: none;
}
.riverdashboardFilter .rdfLine {
	position: absolute;
	height: 1px;
	width: 100%;
	left: 0;
	top: 50%;
	background: <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	z-index: 1;
}
.riverdashboardFilter .circlesAjaxLoader {
    margin: 7px -15px 0 0;
}
.filterInnerGroup br {
	display: none;
}
.figBB {
	border-bottom: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
}
.filterInnerGroup h4 {
	font-size: 11px;
	text-transform: uppercase;
	font-weight: normal;
	line-height: 27px;
	padding: 0 0 0 8px;
	color: <?php if (isset($vars['css']['base-light-text-color'])) { echo $vars['css']['base-light-text-color']; } else {echo '#7b858a'; } ?>;
}
.filterInnerGroup label {
	font-weight: normal;
	display: block;
	padding: 5px 5px 5px 10px;
	cursor: default;
    display: block;
    font-size: 11px;
    line-height: 13px;
    text-decoration: none;
    margin: 0;
	*float: left;
	*width: 98px;
	*clear: both;
}
.filterInnerGroup label:hover {
	color: #fff;
	background: <?php if (isset($vars['css']['base-link-color'])) { echo $vars['css']['base-link-color']; } else {echo '#53A8F4'; } ?>;
}
.filterInnerGroup label input {
	margin: 0 6px 0 0;
	padding: 0;
	border: none;
	float: left;
	width: 13px;
	height: 13px;
	border: none;
	cursor: default;
}
.filterInnerGroup label .theTxt {
	float: left;
	width: 100px;
	cursor: default;
	display: block;
	margin: -1px 0 0 0;
	overflow: hidden;
    text-overflow: ellipsis;
    white-space: pre;
}
/* title */
.mainTitleTop #content_area_user_title {
	float: left;
	max-width: 80%;
}
.mainTitleTop .mainTitleControls {
	float: right;
	margin: 8px 0 0 0;
	font-size: 12px;
	line-height: 14px;
}
.mainTitleTop .mainTitleControls .sep {
	margin: 0 3px;
}
/* search form */
#btnShowHideSrchFrm {
	background: url(<?php echo $mod_path; ?>fon-show-hide-srch-btn.png) 0 6px no-repeat;
	padding: 0 0 0 12px;
}
#btnShowHideSrchFrm.on {
	background-position: 0 -20px;
}
.ktHiddenSrchFrm {
	padding: 15px 20px;
	margin-bottom: 15px;
	display: none;
	border: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	background: #eee;
}
.ktHiddenSrchFrm.on { /* you can use this if you need to show the search form, just add the 'on' class */
	display: block;
}
.ktHiddenSrchFrm .ktFormWrapper label {
	margin: 7px 0 0 0;
	display: block;
	float: left;
	font-size: 11px;
	font-weight: normal;
	line-height: 14px;
	width: 20%;
	text-align: right;
	word-wrap: break-word;
}
.ktCirclesMainContainer.threeCol .ktHiddenSrchFrm {
	width: 501px;
	padding-bottom: 10px;
}
.threeCol .ktHiddenSrchFrm .ktFormWrapper label {
	width: 25%;
}
.ktHiddenSrchFrm .ktFormWrapperGroup {
	float: left;
}
.ktHiddenSrchFrm .ktFormWrapperGroup.ktG50 {
	width: 44.5%;
}
.threeCol .ktHiddenSrchFrm .ktFormWrapperGroup.ktG50 {
	width: 43.5%;
}
.ktHiddenSrchFrm .rBtnSrchFrm {
	float: right;
}
.ktHiddenSrchFrm .rBtnSrchFrm.mTop2 {
	margin-top: 31px;
}
.ktHiddenSrchFrm .rBtnSrchFrm input {
	margin: 0;
}
.ktHiddenSrchFrm.ktFilterVisible {
	display: block;
}
.ktCommentsWrapper .ktComments {
	margin-bottom: 10px;
}
.ktHiddenSrchFrm .ktFormWrapperGroup.ktG50.ktG50Extra {
	width: 85%;
	margin: 0;
}
.ktHiddenSrchFrm .ktFormWrapperGroup.ktG50.ktG50Extra .ktFormWrapper {
	margin: 0;
}
.ktHiddenSrchFrm .ktFormWrapperGroup.ktG50.ktG50Extra .ktFormWrapper label {
	width: 12%;
}
.ktHiddenSrchFrm .ktFormWrapperGroup.ktG50.ktG50Extra .ktFormWrapper .frmField {
	width: 85%;
	float: right;
}
/* circle friends */
.friendsContainer.fc2 {
	border-bottom: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	padding-bottom: 15px;
}
.friendsContainer.fc2 .flRig {
	float: right;
}
.friendsContainer h3 {
	font-size: 12px;
	line-height: 28px;
	padding: 0 6px;
	border-top: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else { echo '#E7ECEF'; } ?>;
	border-bottom: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else { echo '#E7ECEF'; } ?>;
	margin: 0 0 15px 0;
	overflow: hidden;
}
.friendsContainer.fc1 h3 {
	border-top: none;
}
.friendsContainer h3 .flRig {
	font-size: 11px;
	color: #999;
	font-weight: normal;
	line-height: 13px;
	margin: 7px 0 0 0;
}
.searchResultFriends .listFriends {
	list-style: none;
	padding: 0;
	margin: 0 0 25px 0;
	float: none;
	zoom: 1;
}
.searchResultFriends .listFriends li {
	float: left;
	width: 70px;
	height: 92px;
	border: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	background: #fff;
	margin: 0 11px 12px 0;
	padding: 5px 3px 0 3px;
}
.cFriend h5 {
	font-size: 11px;
	line-height: 13px;
	height: 13px;
	overflow: hidden;
    text-overflow: ellipsis;
    white-space: pre;
	font-weight: normal;
	margin: 0 0 6px 0;
}
.cFriend .img {
	width: 70px;
	height: 70px;
}
.cFriend .img a.icon,
.cFriend .img img {
	display: block;
	max-height: 70px;
	max-width: 70px;
}
/* circles */
.threeCol .circlesContainer {
	padding: 0;
}
.cCircle.ui-droppable,
.cCircle.ui-droppable.ul-state-highlight {
	margin: 0 5px 5px 0;
	padding: 7px 5px;
	float: left;
	width: 161px;
	height: 150px;
	background: <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	border: none;
}
.cCircle.ui-droppable h5 {
	font-weight: normal;
	margin: 0 0 4px 0;
	line-height: 20px;
	height: 20px;
	background: <?php if (isset($vars['css']['base-light-text-color'])) { echo $vars['css']['base-light-text-color']; } else {echo '#7b858a'; } ?>;
}
.cCircle.ui-droppable h5 a {
	font-size: 12px;
	line-height: 20px;
	display: block;
	padding: 0 0 0 6px;
	color: #fff;
	overflow: hidden;
    text-overflow: ellipsis;
}
.cCircle.ui-droppable h5 a.circle_name {
	float: left;
	width: 130px;
}
.cCircle.ui-droppable h5 a.circle_delete {
	float: right;
	width: 15px;
	padding: 0;
}
.cCircle.ui-droppable ul {
	margin: 0;
	padding: 0;
	list-style: none;
}
.cCircle.ui-droppable ul li {
	float: left;
	width: 45px;
	height: 50px;
	border: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	background: #fff;
	margin: 0 4px 4px 0;
	padding: 3px 2px;
	-moz-box-shadow: 0 0 3px <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	-webkit-box-shadow: 0 0 3px <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	box-shadow: 0 0 3px <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
}
.cCircle.ui-droppable ul li .cFriend .img {
	width: 45px;
	height: 45px;
}
.cCircle.ui-droppable ul li .cFriend .img img,
.cCircle.ui-droppable ul li .cFriend .img a {
	display: block;
	max-height: 100%;
	max-width: 100%;
}
.deleteFriendCont {
	text-align: right;
	font-size: 12px;
	font-weight: bold;
	line-height: 7px;
}
/* new circle */
.newCircle {
	float: left;
	width: 171px;
	height: 164px;
	overflow: hidden;
	background: <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	text-align: center;
}
.newCircle a {
	color: #b9b9b9;
	font-size: 18px;
	line-height: 22px;
	padding: 50px 31px 48px;
	display: block;
}
.newCircle a,
.newCircle a:hover {
	text-decoration: none;
}
.newCircle a:hover {
	color: <?php if (isset($vars['css']['base-link-color'])) { echo $vars['css']['base-link-color']; } else {echo '#53A8F4'; } ?>;
}
/* fancybox */
#fancybox-content.ktCirclesFancyBox div {
	padding: 5px 15px!important;
	overflow: hidden!important;
	font-size: 12px;
	line-height: 16px;
}
#fancybox-content.ktCirclesFancyBoxAdd #circleForm div {
	padding: 0!important;
	margin: 0;
}
#circleForm h2 {
	font-size: 14px;
	line-height: 16px;
	font-weight: bold;
	margin: 0 0 12px 0;
}
#fancybox-content.ktCirclesFancyBoxAdd #circleForm p {
	margin: 0 0 15px;
}
#circleForm input[type="submit"] {
	width: 80px;
	margin: 0 0 0 auto;
	display: block;
}
#circleForm .input-text {
	width: 93%;
}
/* column block */
ul.ulCircles {
	margin: 0;
	padding: 0 10px;
	list-style: none;
}
ul.ulCircles li {
	font-size: 12px;
	margin: 0 0 8px 0;
}
ul.ulCircles li input {
	margin: 0 8px 0 0;
	*margin-right: 4px;
	padding: 0;
	border: none;
	vertical-align: middle;
}
ul.ulCircles li input,
ul.ulCircles li label {
	line-height: 14px;
}
ul.ulCircles li label {
	font-weight: normal;
	vertical-align: middle;
}
/* circles profile */
.titleCirclesProfile {
	position: relative;
	width: 175px;
	height: 13px;
}
.titleCirclesProfile a.showMnCircles {
	text-align: right;
	display: block;
	position: relative;
	zoom: 1;
	z-index: 1;
	text-align: right;
}
.titleCirclesProfile .circlesMnProfile {
	position: absolute;
	border: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
	width: 190px;
	height: 165px;
	top: 22px;
	background: #fff;
	display: none;
}
.circlesMnProfile .ulCirclesCont {
	overflow: auto;
	width: 190px;
	height: 130px;
	border-bottom: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
}
.circlesMnProfile .ulCirclesCont ul {
	list-style: none;
	margin: 0;
	padding: 12px 6px 6px 10px;
}
.circlesMnProfile .ulCirclesCont li {
	margin: 0 0 6px 0;
}
.circlesMnProfile .ulCirclesCont label {
	font-weight: normal;
}
.circlesMnProfile .ulCirclesCont label,
.circlesMnProfile .ulCirclesCont input,
.circlesMnProfile .ulCirclesCont input[type="checkbox"],
.circlesMnProfile .ulCirclesCont .count {
	font-size: 12px;
	line-height: 14px;
	vertical-align: middle;
}
.circlesMnProfile .ulCirclesCont input,
.circlesMnProfile .ulCirclesCont input[type="checkbox"] {
	margin: 0 8px 0 0;
	padding: 0;
}
.circlesMnProfile .ulCirclesCont .txt {
	float: left;
	width: 125px;
}
.circlesMnProfile .ulCirclesCont .count {
	float: right;
	width: 30px;
	text-align: right;
}
.contentFormCircle {
	padding: 0 10px;
}
.contentFormCircle a.createNewCircle {
	font-size: 11px;
	line-height: 13px;
	display: block;
	padding: 10px 0 0 0;
}
.contentFormCircle #circleForm {
	padding: 7px 0 0 0;
	overflow: hidden;
}
.contentFormCircle #circleForm p {
	float: left;
}
.contentFormCircle #circleForm p label {
	display: none;
}
.contentFormCircle #circleForm p input,
.contentFormCircle #circleForm p input[type="text"] {
	width: 94px;
	margin: 0;
	padding: 0 8px;
	font-size: 11px;
	color: <?php if (isset($vars['css']['base-light-text-color'])) { echo $vars['css']['base-light-text-color']; } else {echo '#7b858a'; } ?>;
	height: 18px;
}
.contentFormCircle #circleForm .submit_button {
	font-size: 11px;
	line-height: 13px;
	float: right;
	margin: 0;
	padding-left: 0;
	padding-right: 0;
	text-align: center;
	width: 52px;
	height: 20px;
}
/* circles widget */
#circles_box h3 a.viewAll {
	float: right;
	font-size: 11px;
}
.sbbCircleCont {
	padding: 0 0 0 2px;
	margin: 0 0 10px 0;
}
.sbbCircleCont h4 {
	font-size: 11px;
	font-weight: normal;
	line-height: 13px;
	margin: 0 0 5px 0;
}
.sbbCircleInner .sbbCircleItem {
	width: 40px;
	height: 40px;
	margin: 0 6px 0 0;
	float: left;
}
.sbbCircleInner .sbbCircleItem a,
.sbbCircleInner .sbbCircleItem img {
	display: block;
	margin: 0;
	padding: 0;
	max-width: 100%;
	max-height: 100%;
	text-decoration: none;
}
.circlesAjaxLoader {
	width: 16px;
	height: 13px;
	float: right;
	margin: 0 5px;
	position: relative;
	right: 80px;
	top: 1px;
}
.circlesAjaxLoader.currentlyLoading {
	background-image: url(<?php echo $mod_path; ?>ajax-loader.gif);
	z-index: 2;
	background-repeat: no-repeat;
	background-color: #fff;
}
/* riverdashboard filter list */
.rdfMnInner {
    background-color: #fff;
    border: 1px solid <?php if (isset($vars['css']['base-border-color'])) { echo $vars['css']['base-border-color']; } else {echo '#E7ECEF'; } ?>;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
}
.rdfMnInner span.cThis {
	clear: both;
	display: block;
	height: 0;
	line-height: 0;
	font-size: 0;
}