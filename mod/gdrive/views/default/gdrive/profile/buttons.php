<?php
/*This view should be extended to add buttons.*/
	
//$context = elgg_get_context();
$context = GDriveBaseMain::ktform_get_subtype($vars);

$rating_support = GDriveBaseMain::ktform_get_entity_rating_support($context);

//If the rating is supported into the profile.
if($rating_support['enabled'] && $rating_support['profile']) {
	echo elgg_view('gdrive/behavior/rating', $vars);
}

$entity = elgg_extract('entity', $vars, FALSE);
if (empty($entity->alternative_link)) {
    echo elgg_view('gdrive/output/kt_file', array(
        'entity' => $entity,
        'internalname' => 'file',
    ));
}