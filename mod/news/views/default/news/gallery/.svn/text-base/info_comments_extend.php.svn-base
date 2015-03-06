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

//KTODO: Check if we have comments enabled, and add the qtip
?>

<a href="#" class="aInteract aLikesListing ttip" title="123 people liked this"></a>
<a href="#" class="aInteract aCommentsListing ttip" title="<?php echo $num_comments; ?> comments"></a>
<div class="clearfloat">&nbsp;</div>
