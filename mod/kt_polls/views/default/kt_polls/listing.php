<?php

/**
 * ElggEntity listing default view.
 * Default elgg listing.
 */
// Icon default.
$icon = '';

$entity_subtype = PollsBaseMain::ktform_get_subtype($vars);

$image_support = PollsBaseMain::ktform_get_entity_image_support($entity_subtype);

$entity = elgg_extract('entity', $vars);
$owner = $entity->getOwnerEntity();


if ($image_support) {
	// If image support get the icon.

	$icon_entity = $entity;

	if ($image_support === PollsBaseMain::$Polls_st_OWNER_ICON_NAME) {
		$icon_entity = $entity->getOwnerEntity();

		if ($vars['entity'] instanceof ElggUser) {
			$icon_entity = $entity;
		}
	}
	
	$icon = elgg_view_entity_icon($icon_entity, 'small', array('img_class' => ''));
}


//KTODO make all this work (decide when to put a checkbox, icon image, both, only one, etc...)
// is there a checkbox to show?
//$kt_chck = false; // no, there is not...
//$kt_chck = defined('Polls_st_DISABLE_BULK_ACTIONS') && Polls_st_DISABLE_BULK_ACTIONS != TRUE; // yes, there is one!
$kt_chck = PollsBaseMain::ktform_get_bulk_action_support($entity_subtype);
if ($kt_chck && $entity) {
	$class_chck = 'chckCont';
	if (!$icon) {
		$class_chck .= ' centerInImg';
	}

	$bulk_action_val = $entity->getGUID();

	$icon = $icon . '<div class="' . $class_chck . '"><input type="checkbox" class="ktChk" name="guids[]" value="' . $bulk_action_val . '" /></div>';
}

if ($icon && $kt_chck) {
	$icon = '<div class="smallerIcon">' . $icon . '</div>';
}


$owner_link = elgg_view('output/url', array(
	'href' => "kt_polls/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));

$author_text = elgg_echo('byline', array($owner_link));
$date = elgg_view_friendly_time($entity->time_created);

if (elgg_is_active_plugin('keetup_categories')) {
	$categories = elgg_view('output/keetup_categories', $vars);
} else {
	$categories = elgg_view('output/categories', $vars);
}

if(is_callable(array(get_class($entity), 'getSubtitleOnListing'))) { 
	$subtitle = $entity->getSubtitleOnListing($vars);
} else {
	$subtitle = "$author_text $date $categories";
}

$subtitle = $subtitle.elgg_view('kt_polls/listing/subtitle_extended', $vars);

$description = $entity->description;
$description = elgg_get_excerpt($description);

$tags = '';

if(is_callable(array(get_class($entity), 'getTagsOnListing'))) { 
	$tags = $entity->getTagsOnListing();
}

$tags = $tags.elgg_view('kt_polls/listing/tags_extended', $vars);

//Get custom description
if(is_callable(array(get_class($entity), 'getDescription'))) {
	$description = $entity->getDescription();
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $entity,
	'handler' => 'kt_polls',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
	'view_type' => 'listing',
));

// Handle it with another view, so it is easier.
$params = array(
	 'entity' => $entity,
	 'metadata' => $metadata,
	 'subtitle' => $subtitle,
	 'content' => $description,
	 'tags' => $tags,
);

$params = $params + $vars;
$list_body = elgg_view('object/elements/summary', $params);

echo elgg_view_image_block($icon, $list_body);


