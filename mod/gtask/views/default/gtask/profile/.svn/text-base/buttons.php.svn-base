<?php
/*This view should be extended to add buttons.*/
	
//$context = elgg_get_context();
$context = GtaskBaseMain::ktform_get_subtype($vars);

$rating_support = GtaskBaseMain::ktform_get_entity_rating_support($context);

//If the rating is supported into the profile.
if($rating_support['enabled'] && $rating_support['profile']) {
	echo elgg_view('gtask/behavior/rating', $vars);
}