<?php

//Get title
$title = $vars['entity']->title;
if (!$title) {
	$title = $vars['entity']->name;
}
if (!$title) {
	$title = get_class($vars['entity']);
}

//Dummy lorem ipsum 1 Dummy lorem ips => 35 chars.
//Reduce the entity name/title to max 2 cols
$title = elgg_get_excerpt($title, GtaskBaseMain::$GALLERY_TWO_ROW_MAX_TEXT);

//Get description
//$description = $vars['entity']->description;

//Time
$friendly_time = elgg_get_friendly_time($vars['entity']->time_created);
$friendly_time = elgg_get_excerpt($friendly_time, GtaskBaseMain::$GALLERY_ONE_ROW_MAX_TEXT);

//Owner
$owner = $vars['entity']->getOwnerEntity();
$owner_name = $owner->name;

$owner_name = elgg_get_excerpt($owner_name, GtaskBaseMain::$GALLERY_ONE_ROW_MAX_TEXT);

//Get icon
$icon = elgg_view(
		'gtask/icon', array(
		'entity' => $vars['entity'],
		'size' => 'medium',
	)
);


?>

<div class="ktItemGallery">
	<?php /* Show picture plus likes and comments */ ?>
	<div class="ktItemGalleryImgTop">
		<div class="ktItemGalleryImg"><?php echo $icon; ?></div>
		<div class="ktItemGalleryExtend">
			<?php echo elgg_view('gtask/gallery/info_title_extend', $vars);  ?>
		</div>
	</div>
	<div class="ktItemGalleryTitle">
		<h3><?php echo elgg_view('output/url', array('text' => $title, 'href' => $vars['entity']->getUrl())); ?></h3>
		<h4><?php echo elgg_view('output/url', array('text' => $owner_name, 'href' => $owner->getUrl())); ?></h4>
	</div>
	<h5 class="ktItemGalleryTime"><?php echo $friendly_time; ?></h5>
</div>
