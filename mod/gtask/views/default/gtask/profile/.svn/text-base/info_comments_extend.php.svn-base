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

//KTODO: Check if we have comments enabled.
?>

<a href="#" class="aInteract aLikesListing" title="123 people liked this"><span class="txtAI">123</span></a>
<span class="sep"></span>
<a href="#" class="aInteract aCommentsListing" title="<?php echo $num_comments; ?> <?php echo elgg_echo('gtask_ktform:profile:owner:section:comments:text'); ?>"><span class="txtAI"><?php echo $num_comments; ?></span></a>
<div class="clearfloat">&nbsp;</div>
