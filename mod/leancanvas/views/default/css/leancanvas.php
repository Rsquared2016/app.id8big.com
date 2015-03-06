<?php

?>
/** <style> **/
/* Ajax Loading */
.ajax-loading {
	background-image: url('<?php echo LEANCANVAS_GRAPHICS; ?>ajax-loader.gif') !important;
	background-position: 0 0;
	background-repeat: no-repeat;
}
/* main container */
.canvasContainer {
    margin-top: 20px;
    position: relative;
}
.canvasTopRow,
.canvasContainer .topBlock {
    margin: 0 0 11px;
}
.canvasContainer .topBlock,
.canvasContainer .bottomBlock {
    height: 211px;
}
.canvasColumn .topRow .canvasColumnBody {
    height: 214px;
}
.canvasColumn .bottomRow .canvasColumnBody {
    height: 128px;
}
.canvasColumn .topBlock .canvasColumnBody,
.canvasColumn .bottomBlock .canvasColumnBody {
    height: 165px;
}
.canvasBottomRow .canvasColumn .canvasColumnBody {
    height: 114px;
}
.canvasColumnBody {
    position: relative;
}
/* online users */
.aOnlineMembers {
    position: absolute;
    display: block;
    text-align: right;
    font-size: 12px;
    line-height: 1.2;
    top: -20px;
    right: 2px;
    width: 85px;
}
.aOnlineMembers a {
    text-decoration: underline;
}
.aOnlineMembers a:hover {
    text-decoration: none;
}
/* lean canvas */
.canvasTopRow .canvasColumn {
    width: 155px;
    height: 435px;
    margin: 0 11px 0 0;
}
.canvasBottomRow .canvasColumn {
    width: 406px;
    height: 160px;
}
.canvasColumnStyle {
    border: 1px solid #dfdfdf;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    background: #fff;
    cursor: default;
}
/* column title */
.canvasColumnHead {
    border-radius: 3px 3px 0 0;
    -moz-border-radius: 3px 3px 0 0;
    -webkit-border-radius: 3px 3px 0 0;
    border-bottom: 1px solid #dfdfdf;
    background: #f3f3f3;
    padding: 6px 8px 0 8px;
    height: 30px;
}
.bottomRow .canvasColumnHead {
    border-top: 1px solid #dfdfdf;
}
.canvasColumnHead h3 {
    font-size: 11px;
    line-height: 1.2;
    font-weight: normal;
    float: left;
    text-transform: uppercase;
}
.canvasColumnHead h3.h3SingleLine {
    margin-top: 6px;
}
.canvasTopRow .canvasColumnHead h3 {
    width: 100px;
}
.canvasBottomRow .canvasColumnHead h3 {
    width: 300px;
}
.canvasColumnHead .columnSectionHelp {
    background: url(<?php echo $vars['url']; ?>/mod/leancanvas/graphics/ico-ttip.png) 0 0 no-repeat;
    width: 23px;
    height: 21px;
    float: right;
    display: none;
}
.canvasColumnHead .columnSectionHelp:hover {
    background-position: 0 100%;
}
.canvasColumnHover:hover .columnSectionHelp,
.canvasColumnHover:hover .commentAndCreate {
    display: block;
}

/* column body */
.canvasColumnBody {
    padding: 9px 8px 0 8px;
}
.canvasExplainText {
    color: #b9b9b9;
    font-size: 14px;
    line-height: 1.2;
    margin: 0 0 14px;
}
.canvasExplainText.flLef {
    width: 140px;
    margin: 0 33px 0 10px;
    padding: 10px 0 0 0;
}
.canvasExplainText2.flLef {
    width: 100px;
    margin-right: 72px;
}
.columnSectionNumber {
    text-align: center;
    font-size: 62px;
    line-height: 1.2;
    color: #d4d4d4;
}
.canvasBottomRow .canvasTextAndNumber {
    padding: 14px 0 0;
}
.canvasShowOnClick .canvasAddContentForm {
    display: none;
}
.canvasShowOnClick .canvasAddContentForm.on {
    display: block;
    background: #fff;
    display: block;
    height: 100%;
    width: 139px;
    position: absolute;
    top: 0;
    left: 8px;
}
.canvasBottomRow .canvasShowOnClick .canvasAddContentForm.on {
    width: 390px;
}
/* comment and create */
.commentAndCreate {
    display: none;
    position: absolute;
    width: 139px;
    height: 13px;
    bottom: 5px;
}
.canvasBottomRow .canvasColumnBody .commentAndCreate {
   width: 391px;
}
.columnSectionComment {
    font-size: 11px;
    line-height: 13px;
    color: #53A8F4;
    cursor: pointer;
}
.columnSectionCommentBubble {
    border: none;
    border-radius: 3px;
    box-shadow: 1px 1px 2px #999 inset;
    color: #6A6A6A;
    float: left;
    font-size: 12px;
    line-height: 20px;
    margin: -6px 0 0 0;
    position: relative;
    text-decoration: none;
    background-color: #F3F3F3;
    background-image: url(<?php echo $vars['url']; ?>/mod/leancanvas/graphics/ico-comments.png);
    background-position: 4px 50%;
    background-repeat: no-repeat;
    padding: 0 4px 0 0;
    height: 20px;
    width: auto;
}
.columnSectionCommentBubble a {
    color: #6A6A6A;
    display: block;
    padding: 0 0 0 26px;
}
.columnSectionCommentBubble a,
.columnSectionCommentBubble a:hover {
    text-decoration: none;
}
.canvasAddContentLink {
    font-size: 14px;
    line-height: 16px;
    cursor: pointer;
    margin-top: -4px;
}
.canvasAddContentLink,
.canvasAddContentLink a {
    color: #a8a8a8;
}
.columnSectionComment:hover {
    text-decoration: underline;
}
.canvasItem {
	padding: 12px 10px;
	margin-bottom: 8px;
	position: relative;
    border-radius: 2px;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border: 1px solid #dfdfdf;
    color: #000;
    font-size: 11px;
    line-height: 1.2;
}
.canvasBottomRow .canvasItem {
    margin-right: 8px;
    width: 140px;
    float: left;
}
.canvasItem:last-child {
    margin: 0;
}
.canvasItem .canvasItemActions {
	position: absolute;
	top: -1px;
	right: -1px;
}
.canvasItemActions .delete_objective,
.canvasItemActions .edit_objective {
    display: block;
    border: 1px solid #dfdfdf;
    width: 13px;
    height: 13px;
    color: #a8a8a8;
    line-height: 13px;
    text-align: center;
    margin: 0;
    overflow: hidden;
}
.canvasItemActions .delete_objective {
    border-left: none;
    text-decoration: none;
}
.canvasItemActions .edit_objective {
    background-image: url(<?php echo $vars['url']; ?>/mod/leancanvas/graphics/ico-edit-lean-item.png);
    background-position: 50% 50%;
    background-repeat: no-repeat;
}
.canvasItem.ajax-loading {
	background-position: 50% 50%;
	opacity: 0.2;
	filter:alpha(opacity=20); /* For IE8 and earlier */
}
.canvasContent {
    overflow: auto;
    display: none;
}
.canvasContent.on {
    display: block;
}
.canvasColumn .topBlock .canvasColumnBody .canvasContent,
.canvasColumn .bottomBlock .canvasColumnBody .canvasContent {
    height: 140px;
}
.topRow .canvasColumnBody .canvasContent {
    height: 190px;
}
.bottomRow .canvasColumnBody .canvasContent {
    height: 102px;
}
.canvasBottomRow .canvasContent {
    height: 90px;
}
/* Objective */
.add_objective,
.add_objective:hover {
	text-decoration: none;
}
.canvasShowOnClick .canvasAddContentForm form .buttons {
	text-align: right;
}
.canvasShowOnClick .canvasAddContentForm form .buttons.ajax-loading {
	background-position: 0 50%;
}
/* Objective colors */
.objective_yellow,
.objective_yellow .delete_objective,
.objective_yellow .edit_objective {
	background-color: #fff6cd;
}
.objective_skyblue,
.objective_skyblue .delete_objective,
.objective_skyblue .edit_objective {
	background-color: #e4f3ff;
}
.objective_orange,
.objective_orange .delete_objective,
.objective_orange .edit_objective {
	background-color: #ffdec4;
}
.objective_yellow .canvasItemActions .aEditObj:hover {
    background-color: #ffef9d;
}
.objective_skyblue .canvasItemActions .aEditObj:hover {
    background-color: #cae8ff;
}
.objective_orange .canvasItemActions .aEditObj:hover {
    background-color: #ffbe8b;
}
/* Comments */
.commentsLeanCanvasWrapper,
.onlineUsersWrapper {
	padding: 14px 20px;
}
.onlineUsersWrapper {
    padding-bottom: 25px;
}
.commentsLeanCanvasWrapper {
	width: auto;
    max-width: 500px;
    overflow: hidden;
}
.commentsLeanCanvasWrapper .elgg-form #comment {
	height: 160px;
	width: 500px;
}
.commentsLeanCanvasWrapper .commentsWrapper {
	margin-top: 20px;
}
.commentsLeanCanvasWrapper .elgg-form-leancanvas-add-comment h3.ajax-loading {
	background-position: 99% 4px !important;
}
.leancanvas_comments .elgg-icon-speech-bubble {
	padding: 3px 0 0 20px;
}
.elgg-form-leancanvas-add-comment fieldset > div {
    margin-bottom: 20px;
}
/* add form */
.elgg-main .canvasColumn .elgg-form input[type="text"] {
    width: 131px;
}
.elgg-main .canvasBottomRow .canvasColumn .elgg-form input[type="text"] {
    width: 382px;
}
form.elgg-form.elgg-form-leancanvas-add-objective fieldset > div {
    margin-bottom: 5px;
}
.colorSq {
    background: #fff;
    border: 1px solid #dfdfdf;
    padding: 3px;
    margin: 0 8px 0 0;
    cursor: pointer;
}
.colorSq.on,
.colorSq:hover {
    background: #959595;
}
.colorSqInner {
    width: 16px;
    height: 16px;
}
.colorSqYellow .colorSqInner {
    background: #ffef9d;
}
.colorSqOrange .colorSqInner {
    background: #ffbe8b;
}
.colorSqBlue .colorSqInner {
    background: #cae8ff;
}
/* Online Users */
.onlineUsersWrapper {
	width: 400px;
}
.onlineUsersWrapper .onlineUsersList {
    border: 1px solid #dfdfdf;
    border-bottom: none;
    background: #fefefe;
    max-height: 184px;
    overflow: auto;
}
.leancanvas-online-user {
    border-bottom: 1px solid #dfdfdf;
    padding: 10px 8px;
}
#fancybox-content .onlineUsersList .elgg-image,
#fancybox-content .onlineUsersList .elgg-body {
    min-height: 25px;
    overflow: hidden;
}
#fancybox-content .onlineUsersList h3 {
    margin: 0;
    font-size: 12px;
    line-height: 25px;
    font-weight: normal;
}
#fancybox-content .onlineUsersList .elgg-subtext {
    display: none;
}
.bodyLeancanvas .elgg-main .elgg-form textarea {
    height: 30px;
    min-height: 30px;
    max-height: 30px;
	font-size: 12px;
	line-height: 14px;
    overflow: auto!important;
    width: 128px;
	margin: 7px 0 0 0;
}
.bodyLeancanvas .elgg-main .canvasBottomRow .elgg-form textarea {
	width: 380px;
}
/* Compass */
.canvasItem .canvasItemDone {
	display: inline;
	top: 16px;
	right: 4px;
	position: absolute;
}
.canvasItem .canvasItemDone .elgg-icon-checkmark {
	background-position: 0 -126px;
}
.canvasItem .canvasItemDone .elgg-icon-delete {
	background-position: 0 -252px;
}
