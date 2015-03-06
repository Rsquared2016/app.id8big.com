<?php
/*
 * Admin panel custom style
 *
 */
?>
body {
    background: <?php echo $vars['css']['footer-background-color']; ?>!important;
}
/* general */
a {
    color: <?php echo $vars['css']['base-link-color']; ?>;
}
.elgg-page > .elgg-inner {
    margin: 0 auto;
    <?php
        if(THEME_FULL_WIDTH_SUPPORT) {
    ?>
    max-width: none;
    <?php
        }
        else {
    ?>
    max-width: 1600px;
    <?php
        }
    ?>
    min-width: 320px;
    padding: 0;
}
body .elgg-page-body .elgg-inner {
    padding: 0;
}
.elgg-page-body {
    padding: 0;
}
.elgg-page.elgg-page-admin {
    background: url(<?php echo THEME_GRAPHICS_CUSTOM; ?>fon-main-body-lines.png) 0 0 repeat-y #fff;
    overflow: hidden;
}
/* header */
.elgg-page-header {
    border: none;
    padding: 15px 10px 0;
    background: <?php echo $vars['css']['header-background-color']; ?>;
}
html body .elgg-page-header {
    height: auto;
}
.elgg-menu-user {
    margin: 0;
}
body .elgg-menu-user {
    color: <?php echo $vars['css']['base-light-text-color']; ?>;
}
body .elgg-menu-user a {
    color: <?php echo $vars['css']['base-link-color']; ?>;
}
/* main title */
body .elgg-main > .elgg-head {
    padding-top: 5px;
}
body .elgg-main > .elgg-head h2 {
    margin: 0;
}
/* sidebar */
.elgg-sidebar {
    margin: 0;
    float: left;
    width: 180px;
    padding: 0;
}
.elgg-sidebar .elgg-module-main {
    background: none;
    border: none;
    padding: 0;
}
.elgg-admin-sidebar-menu h2 {
    font-size: <?php echo $vars['css']['module-title-font-size']; ?>;
    font-weight: bold;
    line-height: 1.2;
    color: <?php echo $vars['css']['module-title-font-color']; ?>;
    padding: <?php echo $vars['css']['module-title-padding']; ?>;
    padding-top: 5px; /* fix */
    margin: <?php echo $vars['css']['module-title-margin']; ?>;
}
/* page sidebar menu */
.elgg-page ul.elgg-menu.elgg-menu-page {
    border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
    padding: 0;
}
.elgg-page .elgg-menu-page li {
	border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-page .elgg-menu-page li > a {
    background: none;
    display: block;
	color: <?php echo $vars['css']['base-light-text-color']; ?>;
    padding: 15px 10px!important;
    border-radius: 0px;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    margin: 0;
    border: none;
}
.elgg-page .elgg-menu-page li > a,
.elgg-page ul.treeview,
.elgg-page .treeview ul {
    font-size: 11px;
    line-height: 1.2;
}
.elgg-page .elgg-menu-page li.elgg-state-selected > a {
    border-right: 1px solid #fff;
    padding-right: 5px;
}
.elgg-page .elgg-menu-page li > a:hover,
.elgg-page .elgg-menu-page li.elgg-state-selected > a {
	color: <?php echo $vars['css']['base-link-color']; ?>;
}
.elgg-page .elgg-menu-page li.elgg-state-selected > a {
	cursor: default;
}
/* sidebar sub menu */
.elgg-admin-sidebar-menu .elgg-child-menu {
    padding-left: 25px;
    padding-bottom: 10px;
    border-top: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-page .elgg-menu-page .elgg-child-menu li {
    border: none;
}
.elgg-page .elgg-menu-page .elgg-child-menu li > a {
    padding: 10px 0;
}
.elgg-page .elgg-menu-page .elgg-child-menu li.elgg-state-selected > a {
    border-right: none;
    font-weight: bold;
}
/* main container */
.elgg-main {
    border: none;
    padding: 0;
    margin: 0 10px 0 205px;
    float: none;
}
/* color picker */
.elgg-form-theme-professionalelgg18-style .colorPicker {
	position: relative;
	width: 36px;
	height: 36px;
	background: url(<?php echo elgg_get_site_url()?>mod/<?php echo THEME_NAME ?>/vendors/colorpicker/images/select.png);
}
/* widgets */
.elgg-module-widget > .elgg-head {
    background-color: <?php echo $vars['css']['widget-title-background-color']; ?>;
}
.elgg-module-widget > .elgg-head h3 {
    color: <?php echo $vars['css']['widget-title-font-color']; ?>;
    padding: <?php echo $vars['css']['widget-title-height']; ?>;
}
.elgg-module-widget > .elgg-body {
     background-color: <?php echo $vars['css']['widget-background']; ?>;
}
.elgg-module-widget > .elgg-body {
    border-color: <?php echo $vars['css']['base-border-color']; ?>;
}
.elgg-module-widget,
.elgg-module-widget:hover {
    background-color: <?php echo $vars['css']['base-border-color']; ?>;
}
/* external pages */
.elgg-form.elgg-form-settings.elgg-form-expages-edit textarea.elgg-input-longtext {
	width: 100%;
}
/* add widget */
.elgg-button[rel="toggle"] {
	float: right;
    margin-right: 7px;
    margin-top: -31px;
}
/* buttons */
.elgg-button {
    font-weight: normal;
}
/* footer */
.elgg-page-footer {
    border: none;
    margin-bottom: 0;
    background: <?php echo $vars['css']['footer-background-color']; ?>;
}
.elgg-page-footer a {
    color: #333;
    font-weight: normal;
    text-decoration: none;
    font-size: 11px;
}
.elgg-menu-admin-footer > li {
    padding: 0;
    margin: 0 5px 0 0;
}
.elgg-menu-admin-footer > li:after {
    content: "|";
    padding: 0 0 0 5px;
}
.elgg-menu-admin-footer > li:after {
    margin: 0;
}
/* forms */
.elgg-main form.elgg-form.elgg-form-admin-plugins-filter select,
.elgg-main form.elgg-form.elgg-form-admin-plugins-sort select {
    margin: 0;
    width: 25%;
    min-width: 0;
}
.elgg-main form.elgg-form.elgg-form-admin-plugins-filter .elgg-button,
.elgg-main form.elgg-form.elgg-form-admin-plugins-sort .elgg-button {
    min-width: 75px;
}
.elgg-page-admin .elgg-form-settings {
    max-width: none;
}
.elgg-page-admin .elgg-form-settings .elgg-foot select {
    margin-top: 0;
}
/* plugin list */
.elgg-plugin {
    padding: 5px 10px;
    border-radius: <?php echo $vars['css']['mn-border-radius']; ?>;
}
.elgg-plugin,
.elgg-plugin-category-bundled {
    border-color: <?php echo $vars['css']['base-border-color']; ?>;
    border-width: 1px;
}
.elgg-plugin-category-bundled {
    box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.15) inset;
}
.elgg-plugin.elgg-state-inactive {
    background: <?php echo $vars['css']['misc-bg-color']; ?>;
}
ul.elgg-menu.elgg-menu-metadata {
    list-style: none;
}
ul.elgg-menu.elgg-menu-metadata a {
    color: <?php echo $vars['css']['base-link-color']; ?>;
}
.elgg-plugin .elgg-state-error {
    border: none;
    font-weight: normal;
    margin: 0 0 5px;
    padding: 5px;
}
.elgg-plugin-more {
    background: <?php echo $vars['css']['base-border-color']; ?>;
}
/* table */
.elgg-table-alt th,
.elgg-module-inline > .elgg-head {
    background: <?php echo $vars['css']['misc-bg-color']; ?>;
}
.elgg-table-alt,
.elgg-table-alt td,
th {
    border-color: <?php echo $vars['css']['base-border-color']; ?>;
}
/* generic module */
.elgg-module-inline > .elgg-head h3 {
    color: <?php echo $vars['css']['base-color']; ?>;
    padding: 4px 8px;
    line-height: 1.2;
    font-size: 13px;
}
/* pagination */
.elgg-pagination a:hover {
    color: <?php echo $vars['css']['base-color']; ?>;
}
/* tabs */
.elgg-tabs li {
    background: none;
    border: none;
    margin: 0;
    padding: 0;
}
.elgg-tabs .elgg-state-selected a {
    top: 0;
}
/* notices */
.elgg-admin-notices p {
    background-color: #d9edf7;
    border-color: #bce8f1;
    color: #3a87ad;
    box-shadow: none;
    font-weight: normal;
    padding: 8px 35px 8px 14px;
    margin: 0 0 5px;
}
/* fixes */
#developer-settings-form div > label {
    display: inline;
}
/**** some responsive stuff ****/
<?php
	if (THEME_RESPONSIVE_SUPPORT) {
?>
@media only screen
and (min-width : 320px)
and (max-width : 785px) {
    /* general */
    body .elgg-main {
    	margin-left: 10px;
	}
    /* header */
    .elgg-heading-site {
        float: none;
        font-size: 18px;
        margin: 0 0 5px;
    }
    .elgg-menu-user {
        float: none;
    }
    body .elgg-page-header {
        padding-bottom: 10px;
    }
    /* disabled menu items */
    ul li.elgg-menu-item-appearance-default-widgets {
        display: none;
    }
}
<?php
    }
?>
