<?php
/*
 * Handle it with a view html.
 *
 * @uses $vars['entity']
 * */

if(!$vars['entity']) {
	return false;
}

$num_comments = $vars['entity']->countComments();
?>
<a href="#" class="aInteract aCommentsListing ttip" title="<?php echo $num_comments; ?>  <?php echo elgg_echo('gtask_ktform:behavior:comments') ?>"></a>
