<?php
/**
 * Form wrapper, this view is used to add a wrapper to the form.
 * 
 * The context should be the plugin name.
 * 
 * The classname is an extra class that the user would add to customize the form.
 * 
 * The form is the form object.
 * 
 */
$context = elgg_get_context();
$classname = '';
$form = '';

if (isset($vars['classname']) && !empty($vars['classname'])) {
	$classname = $vars['classname'];
}

if (isset($vars['form']) && !empty($vars['form'])) {
	$form = $vars['form'];
}

if (!elgg_is_xhr()) {
    elgg_load_js('form.placeholder.js');
}
?>

<div class="ktFormWrapper ktForm<?php echo $context ?> <?php echo $classname ?>">
	<?php
		if ($form instanceof KtJobBaseForm) {
			echo $form->render(array('disable_form_wrapper' => TRUE));
		}
	?>
</div>


<?php

if (elgg_is_xhr()) {
    return;
}
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		// Code using $ as usual goes here.
		$('input[placeholder], textarea[placeholder]').placeholder();
	});
	
</script>