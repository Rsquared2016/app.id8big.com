<?php
/*
 * Handle it with a view html.
 *
 * @uses $vars['entity']
 * */

if(!$vars['entity']) {
	return false;
}

//$num_comments = elgg_count_comments($vars['entity']);
$num_comments = 0;

?>
<a href="#" class="aInteract aCommentsDisabledListing ttip" title="<?php echo elgg_echo('gtask_ktform:behavior:comments:disabled') ?>"></a>
