/* Popup */
.elgg-module.elgg-module-popup {
	background-color: #fff;
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	z-index: 9999;
	margin-bottom: 0;
	padding: 5px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	-webkit-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
}
.elgg-module-popup > .elgg-head {
	margin-bottom: 5px;
}
.elgg-module-popup > .elgg-head * {
	color: #0054A7;
}
/* generic modules / blocks */
.elgg-module,
.sidebarBox {	/* sidebarbox is left here for theme 1.7 compatibility */
	overflow: hidden;
	border-top: <?php echo $vars['css']['module-top-border']; ?>;
	border-bottom: <?php echo $vars['css']['module-bottom-border']; ?>;
	border-right: <?php echo $vars['css']['module-right-border']; ?>;
	border-left: <?php echo $vars['css']['module-left-border']; ?>;
    padding: <?php echo $vars['css']['module-padding']; ?>;
    margin: <?php echo $vars['css']['module-margin']; ?>;
}
/* left / right modules (should we include the other modules here too?) */
.elgg-module-aside .elgg-head,
.sidebarBox h3 {
    border-top: <?php echo $vars['css']['module-title-top-border']; ?>;
    border-bottom: <?php echo $vars['css']['module-title-bottom-border']; ?>;
    border-left: <?php echo $vars['css']['module-title-left-border']; ?>;
    border-right: <?php echo $vars['css']['module-title-right-border']; ?>;
    padding: <?php echo $vars['css']['module-title-padding']; ?>;
    margin: <?php echo $vars['css']['module-title-margin']; ?>;
}
.elgg-module-aside .elgg-body .elgg-body h3 {
	font-weight: normal;
}
.elgg-module-aside .elgg-head h3,
.sidebarBox h3 {
	font-size: <?php echo $vars['css']['module-title-font-size']; ?>;
    font-weight: normal;
    line-height: 1.2;
    color: <?php echo $vars['css']['module-title-font-color']; ?>;
}
.sidebarBox h3 .txt,
.elgg-module-aside .elgg-head h3 .txt {	/* used when there's a TITLE + "view all" */
	float: left;
}
.sidebarBox h3 a.viewAll,
.elgg-module-aside .elgg-head h3 a.viewAll {
    display: block;
    float: right;
    font-size: 11px;
    line-height: 1.2;
    margin: 0;
    text-transform: none;
    font-weight: normal;
}
.sbbContents ul.ulGallery  {	/* some old widgets / modules (1.7) use this and stuff below this */
	overflow: hidden;
}
.sbbContents .ulGallery li {
	float: left;
	width: 40px;
	height: 40px;
	margin: 0 6px 6px 0;
}
.sbbContents.groupsBoxContents,
.sbbContents.profileBoxContents {
	padding: 0 13px;
}
.sbbContents ul.blockItemsContainer li {
	float: none;
	height: auto;
	width: 100%;
}
.sbbContents ul.blockItemsContainer .img {
	float: left;
}
.elgg-module-aside .elgg-list li:last-child {
	margin-bottom: 0;
	padding-bottom: 0;
	border: none;
}
/* Info */
.elgg-module-info > .elgg-head {
	background: <?php echo $vars['css']['block-title-background-color']; ?>;
    color: <?php echo $vars['css']['block-title-font-color']; ?>;
	padding: <?php echo $vars['css']['block-title-height']; ?>;
	margin: <?php echo $vars['css']['block-title-margin']; ?>;
}
.elgg-module-info > .elgg-head h1,
.elgg-module-info > .elgg-head h2,
.elgg-module-info > .elgg-head h3,
.elgg-module-info > .elgg-head h4,
.elgg-module-info > .elgg-head h5,
.elgg-module-aside .elgg-head h1,
.elgg-module-aside .elgg-head h2,
.elgg-module-aside .elgg-head h3,
.elgg-module-aside .elgg-head h4,
.elgg-module-aside .elgg-head h5,
.elgg-module-featured > .elgg-head h1,
.elgg-module-featured > .elgg-head h2,
.elgg-module-featured > .elgg-head h3,
.elgg-module-featured > .elgg-head h4,
.elgg-module-featured > .elgg-head h5 {
    margin-bottom: 0;
}
/* Dropdown */
.elgg-module-dropdown {
	background-color: #fff;
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	display: none;
	width: 210px;
	padding: 12px;
	margin-right: 0;
	z-index: 100;
	position: absolute;
	right: 0;
	top: 100%;
}
/* Featured */
.elgg-module-featured {
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-module-featured > .elgg-head {
	background: <?php echo $vars['css']['block-title-background-color']; ?>;
    color: <?php echo $vars['css']['block-title-font-color']; ?>;
	padding: <?php echo $vars['css']['block-title-height']; ?>;
	margin: <?php echo $vars['css']['block-title-margin']; ?>;
}
.elgg-module-featured > .elgg-body {
	padding: 0 10px 10px 10px;
}
/* Widgets */
.elgg-widgets {
	float: right;
	min-height: 30px;
}
.elgg-widget-add-control {
	text-align: right;
	margin: 5px 5px 15px;
}
.elgg-widgets-add-panel {
	padding: 10px;
	margin: 0 5px 15px;
	background: #dedede;
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
body .elgg-widgets-add-panel ul {
	padding: 0;
	margin: 0;
	list-style: none;
}
.elgg-widgets-add-panel li {
	float: left;
	margin: 2px 10px;
	width: 200px;
	padding: 4px;
	background-color: #ccc;
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	font-weight: bold;
}
.elgg-widgets-add-panel li a {
	display: block;
}
.elgg-widgets-add-panel .elgg-state-available {
	color: #333;
	cursor: pointer;
}
.elgg-widgets-add-panel .elgg-state-available:hover {
	background-color: #bcbcbc;
}
.elgg-widgets-add-panel .elgg-state-unavailable {
	color: #888;
}
.elgg-module-widget {
	border-top: <?php echo $vars['css']['widget-top-border']; ?>;
	border-bottom: <?php echo $vars['css']['widget-bottom-border']; ?>;
	border-right: <?php echo $vars['css']['widget-right-border']; ?>;
	border-left: <?php echo $vars['css']['widget-left-border']; ?>;
	padding: <?php echo $vars['css']['widget-padding']; ?>;
	margin: <?php echo $vars['css']['widget-margin']; ?>;
	position: relative;
}
.elgg-module-widget > .elgg-head {
	background: <?php echo $vars['css']['widget-title-background-color']; ?>;
	height: auto;
	overflow: hidden;
	margin: <?php echo $vars['css']['widget-title-margin']; ?>;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-module-widget > .elgg-head h3 {
	color: <?php echo $vars['css']['widget-title-font-color']; ?>;
	font-weight: normal;
	float: left;
	padding: <?php echo $vars['css']['widget-title-height']; ?>;
    margin: 0;
}
.elgg-module-widget > .elgg-foot,
.elgg-module-widget .elgg-widget-more,
.elgg-module-widget .elgg-widget-content > a {
	padding: <?php echo $vars['css']['widget-foot-padding']; ?>;
	display: block;
	font-size: <?php echo $vars['css']['widget-foot-font-size']; ?>;
	line-height: 1.2;
	border: none;
}
.elgg-widget-handle ul.elgg-menu-widget {
    margin: 0;
}
.elgg-module-widget.elgg-state-draggable .elgg-widget-handle {
	cursor: move;
}
a.elgg-widget-collapse-button {
	color: #c5c5c5;
}
a.elgg-widget-collapse-button:hover,
a.elgg-widget-collapsed:hover {
	color: #9d9d9d;
	text-decoration: none;
}
a.elgg-widget-collapse-button:before {
	content: "\25BC";
}
a.elgg-widget-collapsed:before {
	content: "\25BA";
}
.elgg-module-widget > .elgg-body {
	background-color: <?php echo $vars['css']['widget-background']; ?>;
	width: 100%;
	overflow: hidden;
}
.elgg-widget-edit {
	display: none;
	width: 96%;
	padding: 2%;
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	background-color: <?php echo $vars['css']['misc-bg-color']; ?>;
}
.elgg-widget-content {
	padding: <?php echo $vars['css']['widget-content-padding']; ?>;
}
.elgg-widget-placeholder {
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	margin-bottom: 15px;
}
/* profile widget lists */
.elgg-main.elgg-body .elgg-widget-content .elgg-list {
	margin: 0 0 10px;
}
.elgg-main.elgg-body .elgg-widget-content .elgg-list li:last-child {
	margin-bottom: 0;
}
.elgg-widget-content .elgg-list > li h3 {
    margin: 0 0 2px;
    padding: 0;
    font-weight: bold;
    font-size: <?php echo $vars['css']['widget-list-title-font-size']; ?>;
    line-height: 1.2;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    -webkit-text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.elgg-widget-content .elgg-list > li h3 { /* IE8 */
	height /*\**/: 14px\9
}
.elgg-widget-content .elgg-list > li .elgg-content {
	font-size: <?php echo $vars['css']['widget-list-font-size']; ?>;
}
