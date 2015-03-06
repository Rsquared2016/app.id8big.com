<?php
/*
 * Handle it with a view html.
 *
 * @uses $vars['entity']
 * */

if(!$vars['entity']) {
	return false;
}

//KTODO: Check if we have comments enabled.
?>

<a href="#" class="aInteract aLikesListing"><span class="txtAI">Like</span></a>
<span class="sep"></span>
<a href="#" class="aInteract aDislikesListing"><span class="txtAI">Dislike</span></a>
<span class="sep"></span>
<a href="#kt_comment" class="aInteract aCommentsListing"><span class="txtAI">Comment</span></a>
<div class="clearfloat">&nbsp;</div>