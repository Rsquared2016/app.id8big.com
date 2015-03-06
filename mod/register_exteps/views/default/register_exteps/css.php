<?php
/* Register Exteps */

$plugin_path = $vars['url'].'mod/register_exteps/graphics/';

?>
/* image step */
.registerExImg {
    margin: 0 auto 15px;
    padding: 8px;
    background: #fff;
    border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    box-shadow: 1px 1px 3px #eee;
}
.registerExImg,
.registerExImg img {
	display: block;
	width: 200px;
    height: 200px;
}
.registerExImgTxt {
	text-align: center;
	font-size: 14px;
	font-weight: bold;
	margin: 0 0 40px;
}
.registerExFileInput {
	text-align: center;
	margin: 0 0 45px;
}
/* first steps widget */
ul.listFirstSteps {
	margin: 0;
	padding: 0 14px;
	list-style: none;
}
ul.listFirstSteps li {
	font-size: 11px;
	line-height: 16px;
}
ul.listFirstSteps li.stepComplete a {
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
	text-decoration: line-through;
	cursor: default;
}
.progressbar {
	margin: 0 auto 12px;
	width: 170px;
	border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	background: url(<?php echo $plugin_path; ?>fon-progress-bar.png) 0 0 repeat-x;
	overflow: hidden;
}
.progressInner {
	background: url(<?php echo $plugin_path; ?>fon-progress.png) 0 0 repeat-x;
	width: 1%;
}
.progressbar,
.progressInner {
	height: 17px;
	border-radius: 3px 0 0 3px;
	-moz-border-radius: 3px 0 0 3px;
	-webkit-border-radius: 3px 0 0 3px;
}
.progressbar,
.progressInner.porc100 {
	border-radius: 3px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
}
.sidebarBox.registerExtepsBox h3 {
	border-bottom: none;
	padding: 11px 0 0;
}