<?php

//$title = elgg_view_title($vars['title']);


$search_support = FALSE;
$search_form = FALSE;

if($vars['search_support'] instanceof stdClass) {
	$search_form = NewsBaseMain::ktform_get_filter_object($vars['search_support']->plugin_name);
	$show_form = get_input("{$vars['search_support']->plugin_name}_search", FALSE);
	$search_support = TRUE;
}

elgg_load_js('form.placeholder.js');

if ($search_form)  { ?>
	
<div class="schrFrm sidebarSrchFrm">
	<h3><?php echo elgg_echo('news:listing:link:search') ?></h3>
	<?php  
		echo elgg_view('news/form_wrapper', array('form' => $search_form, 'classname' => 'ktSearchForm'));
	?>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		// Code using $ as usual goes here.
		$('.schrFrm input[placeholder],.schrFrm textarea[placeholder]').placeholder();
	});
</script>
<?php } ?>