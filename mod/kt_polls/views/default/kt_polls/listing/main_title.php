<?php

/*
 * @uses $vars['title']
 * */

$title = elgg_view_title($vars['title']);

$add_link = $vars['add_link'];

$search_support = FALSE;
$search_form = FALSE;

if($vars['search_support'] instanceof stdClass) {
	$search_form = PollsBaseMain::ktform_get_filter_object($vars['search_support']->plugin_name);
	$show_form = get_input("{$vars['search_support']->plugin_name}_search", FALSE);
	$search_support = TRUE;
}

$show_classname = '';

//Wants to hide/show the search form.
if(array_key_exists('show_search_form', $vars)) {
	$show_form = $vars['show_search_form'];
}

if  ($show_form == TRUE) {
	$show_classname = ' ktFilterVisible';
}

$search_link_text = elgg_echo('kt_polls_ktform:listing:link:search');
if (!empty($vars['search_link_text'] )) {
	$search_link_text = $vars['search_link_text'] ;
}

?>

<div class="mainTitleTop">
	<?php echo $title; ?>
	<div class="mainTitleControls">
		<?php if($search_support) {?>
			<a href='#' id="btnShowHideSrchFrm"><?php echo $search_link_text ?></a>
		<?php } ?>
<?php
			if(elgg_is_admin_logged_in()) {
				if (!empty($add_link) && $search_support) {
					echo '<span class="sep">·</span>';
				}
				echo $add_link;
			}
?>
	</div>
	<div class="clearfloat">&nbsp;</div>
</div>

<div class="ktHiddenSrchFrm <?php echo $show_classname ?>">
	<?php
		echo elgg_view('kt_polls/form_wrapper', array('form' => $search_form, 'classname' => 'ktSearchForm'));

		//echo $vars['search_map'];
	?>
</div>
