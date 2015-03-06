<?php
	/* asearch / livesearch styles */
?>
/* main container */
.ktLiveSearch.elgg-search-header {
    bottom: auto;
    right: auto;
    float: left;
    margin: 1px 10px 0 0;
    min-height: 23px;
    min-width: 0;
}
/* form elements */
.ktLiveSearch .btn-group {	/* button group */
	margin: 0;
}
.ktLiveSearch .btn-group > .btn {	/* filter button */
	font-size: 11px;
	height: 23px;
	width: 65px;
	padding-top: 1px;
    border-radius: <?php echo $vars['css']['btn-border-radius']; ?> 0 0 <?php echo $vars['css']['btn-border-radius']; ?>;
    -moz-border-radius: <?php echo $vars['css']['btn-border-radius']; ?> 0 0 <?php echo $vars['css']['btn-border-radius']; ?>;
    -webkit-border-radius: <?php echo $vars['css']['btn-border-radius']; ?> 0 0 <?php echo $vars['css']['btn-border-radius']; ?>;
}
.ktLiveSearch .btn:active {
	color: <?php echo $vars['css']['btn-font-color-hover']; ?>;
}
.ktLiveSearch .btn .caret {
	opacity: 1;
	filter: alpha(opacity=100);
	border-top-color: <?php echo $vars['css']['btn-font-color']; ?>;
}
.ktLiveSearch .btn:hover .caret,
.ktLiveSearch .btn .caret:hover {
	border-top-color: <?php echo $vars['css']['btn-font-color-hover']; ?>;
}
.ktLiveSearch .btn-group > .btn .btnTxt {	/* filter text */
    margin-right: 3px;
    width: 40px;
}
.ktLiveSearch.elgg-search-header input[type="text"] {	/* search input */
    <?php
    	$padding_lr = 4;
    ?>
    padding: 3px <?php echo $padding_lr; ?>px 2px;
    <?php
    	$max_width = 180;
    	if(elgg_is_active_plugin('asearch')) {
	    	$max_width = asearch_get_input_size_pixels();
    	}
    ?>
    max-width: <?php echo $max_width; ?>px;
    width: <?php echo $max_width; ?>px;
    margin: 0;
}
.ktLiveSearch.elgg-search-header input[type="text"] { /* IE8 */
	padding-top /*\**/: 2px\9
}
.ktLiveSearch.elgg-search-header input[type="text"] { /* IE8 */
	padding-bottom /*\**/: 3px\9
}
.ktLiveSearch input[type="submit"] {	/* search button */
    height: 23px;
    min-width: 23px;
    padding-right: 8px;
    padding-left: 8px;
    font-size: 11px;
    border-radius: 0 <?php echo $vars['css']['btn-border-radius']; ?> <?php echo $vars['css']['btn-border-radius']; ?> 0;
    -moz-border-radius: 0 <?php echo $vars['css']['btn-border-radius']; ?> <?php echo $vars['css']['btn-border-radius']; ?> 0;
    -webkit-border-radius: 0 <?php echo $vars['css']['btn-border-radius']; ?> <?php echo $vars['css']['btn-border-radius']; ?> 0;
}
.ktLiveSearch input[type="submit"] { /* IE8 */
	line-height /*\**/: 1\9
}
.ktLiveSearch input[type="submit"] { /* IE8 */
	padding-right /*\**/: 4px\9
}
.ktLiveSearch input[type="submit"] { /* IE8 */
	padding-left /*\**/: 4px\9
}
/* autocomplete list */
#ul-asearch {
	z-index: 123!important;
	 <?php
    	$max_width = 188;
    	if(elgg_is_active_plugin('asearch')) {
	    	$max_width = asearch_get_input_size_pixels() + ($padding_lr * 2) - 2; // + text input's lateral padding - 2 for input's border
    	}
    ?>
    max-width: <?php echo $max_width; ?>px;
    border-color: <?php echo $vars['css']['base-border-color']; ?>;
}
#ul-asearch,
#ul-asearch .li-asearch-footer > a {
	border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
	-moz-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
	-webkit-border-radius: 0 0 <?php echo $vars['css']['mn-border-radius']; ?> <?php echo $vars['css']['mn-border-radius']; ?>;
}
.li-asearch-header h4 {	/* list's sections titles */
    font-size: 12px;
    line-height: 18px;
    background: <?php echo $vars['css']['misc-bg-color']; ?>;
}
#ul-asearch .ui-menu-item > a {	/* list items */
	padding: 4px 3px;
}
#ul-asearch .ui-menu-item > a:hover,
#ul-asearch .ui-menu-item > a.ui-state-hover {
	background: <?php echo $vars['css']['mn-background-color-hover']; ?>;
}
#ul-asearch .ui-menu-item > a:hover,
#ul-asearch .ui-menu-item > a.ui-state-hover,
#ul-asearch .ui-menu-item > a:hover .elgg-subtext,
#ul-asearch .ui-menu-item > a.ui-state-hover .elgg-subtext {
	color: <?php echo $vars['css']['mn-font-color-hover']; ?>;
}
#ul-asearch .ui-menu-item > a,
#ul-asearch .ui-menu-item > a:hover,
#ul-asearch .ui-menu-item > a.ui-state-hover {
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border: none;
}
#ul-asearch a .elgg-body > h3 {	/* element title */
	padding: 0;
	<?php
		if(elgg_is_active_plugin('asearch')) {
			if(asearch_get_icon_size() == 'tiny') {
	?>
	font-size: 11px;
	line-height: 13px;
	<?php	
			}
		}
	?>
}
#ul-asearch .li-asearch-footer > a {	/* list footer */
	font-size: 11px;
	line-height: 14px;
	background: <?php echo $vars['css']['misc-bg-color']; ?>;
	text-align: right;
}