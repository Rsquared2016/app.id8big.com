/* user menu top */
.userTopMn {
    float: left;
    position: relative;
    height: 32px;
    padding: 0;
    margin: 0 0 0 15px;
    zoom: 1;
    max-width: 320px;
    *max-width: 65px;
    *width: 65px;
}
.userTopMn .usrIcoName {
    padding: 0;
}
.userTopMn .usrIco {
    float: left;
    width: 25px;
    height: 25px;
    margin: 0 8px 0 0;
    display: block;
}
.elgg-page .userTopMn .usrIco {
	background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>ico-user-profile.png) 50% 50% no-repeat;
	margin: 0;
}
.utmMnButton {
    background: url(<?php echo THEME_GRAPHICS_CUSTOM ?>btn-twitter-mn.png) 50% -35px no-repeat #404548;
    float: right;
    height: 23px;
    width: 28px;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border: 1px solid #404548;
    cursor: pointer;
    position: relative;
    z-index: 123;
}
.on .utmMnButton {
    border-radius: 3px 3px 0 0;
    -moz-border-radius: 3px 3px 0 0;
    -webkit-border-radius: 3px 3px 0 0;
    height: 33px;
    background-color: <?php echo $vars['css']['mn-background-color']; ?>;
    border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    border-bottom: 1px solid <?php echo $vars['css']['mn-background-color']; ?>;
    background-position: 50% 11px;
}
.userTopMn ul {
    background: <?php echo $vars['css']['mn-background-color']; ?>;
    padding: 0;
    margin: 0;
    position: absolute;
    right: 0;
    top: 34px;
    width: 184px;
    border-radius: <?php echo $vars['css']['mn-border-radius']; ?> 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
    -moz-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
    -webkit-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
    display: none;
    list-style: none;
    border: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    z-index: 12;
    -webkit-box-shadow: -2px 2px 3px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: -2px 2px 3px rgba(0, 0, 0, 0.15);
    box-shadow: -2px 2px 3px rgba(0, 0, 0, 0.15);
}
.on.userTopMn ul {
    display: block;
}
.userTopMn li {
    border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    padding: 0;
}
.userTopMn li.nBg {
    padding-bottom: 0;
}
.userTopMn li.nb,
.userTopMn li.nb a {
    border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
    -moz-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
    -webkit-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
}
.userTopMn ul a {
    font-size: <?php echo $vars['css']['mn-font-size']; ?>;
    line-height: <?php echo $vars['css']['mn-line-height']; ?>;
    color: <?php echo $vars['css']['mn-font-color']; ?>;
    text-decoration: none;
    display: block;
}
.userTopMn ul a:hover {
    text-decoration: none;
    background: <?php echo $vars['css']['mn-background-color-hover']; ?>;
    color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
}
.userTopMn .usrNameLi {
    font-weight: bold;
    font-size: 12px;
    line-height: 14px;
    cursor: default;
    border-radius: <?php echo $vars['css']['mn-border-radius']; ?> 0 0 0;
    -moz-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> 0 0 0;
    -webkit-border-radius: <?php echo $vars['css']['mn-border-radius']; ?> 0 0 0;
}
.userTopMn ul a,
.userTopMn .usrNameLi {
    padding: <?php echo $vars['css']['mn-item-height']; ?>;
}
