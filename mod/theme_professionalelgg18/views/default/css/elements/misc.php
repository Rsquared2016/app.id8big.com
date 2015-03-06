/* MISC */
#login-dropdown {
	position: relative;
	z-index: 100;
    float: right;
}
/* AVATAR UPLOADING & CROPPING */
#current-user-avatar {
	border-right: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
#avatar-croppingtool {
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
#user-avatar-cropper {
	float: left;
	/*width: 352px;*/
}
#user-avatar-preview {
	float: left;
	position: relative;
	overflow: hidden;
	width: 100px;
	height: 100px;
}
/* FRIENDS COLLECTIONS */
#friends_collections_accordian {
	list-style: none;
	padding: 0;
}
#friendspicker-members-table td {
	vertical-align: top;
}
.bodyFriends .elgg-main .elgg-head {
	padding-top: 17px;
}
.bodyFriends .elgg-main .elgg-head .elgg-menu {
	top: 7px;
}
#friends_collections_accordian li {
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
}
#friends_collections_accordian li h2 {
    color: <?php echo $vars['css']['page-mn-font-color-hover']; ?>;
	background: <?php echo $vars['css']['page-mn-background-color-hover']; ?>;
    font-size: 12px;
    font-weight: bold;
    line-height: 15px;
    padding: 4px 2px 6px 6px;
    cursor: pointer;
    margin: 10px 0;
}
#friends_collections_accordian li h2:hover {
	background: <?php echo $vars['css']['page-mn-sel-background-color']; ?>;
    color: <?php echo $vars['css']['page-mn-sel-font-color']; ?>;
}
#friends_collections_accordian .friends_collections_controls {
	float: right;
	font-size: 70%;
}
#friends_collections_accordian .friends-picker-main-wrapper {
	background: #fff;
	display: none;
	padding: 0;
}
.friends-picker-wrapper .friendspicker-savebuttons a.elgg-button,
.friends-picker-wrapper .friendspicker-savebuttons input.elgg-button {
	margin: 0 10px 0 0;
}
