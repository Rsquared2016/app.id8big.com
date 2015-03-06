<?php
/*
 * Handle it with a view html.
 *
 * @uses $vars['entity']
 * */
if(!$vars['entity']) {
	return false;
}

$entity = $vars['entity'];

//KTODO: Obtener titulo y descripcion cortados dependiendo de cantidad de campos extra en el listado y dependiendo de layout 2 o 3 columnas.
//ktform_get_trimed_title().
$title = $entity->title;
if (!$title) {
	$title = $entity->name;
}
if (!$title) {
	$title = get_class($entity);
}

//Hide description.
//$description = elgg_get_excerpt($entity->description, 45);

$friendly_time = elgg_get_friendly_time($entity->time_created);

$owner = $entity->getOwnerEntity();


?>

<?php
//Entity title and description section.
?>
<div class="infoListing infoListingWidget">
	<div class="infoListingTitle">
		<h3><a href="<?php echo $entity->getUrl(); ?>"><?php echo $title; ?></a></h3>
		<div class="clearfloat">&nbsp;</div>
	</div>
	<h4>
		<?php if ($owner) { ?>
		<a href="<?php echo $owner->getURL() ?>"> <?php echo $owner->name; ?></a>
		<span class="sep">·</span><span class="infoListingTime"><?php echo  $friendly_time?></span>
		<?php } ?>
		<?php
			//This view should be extended to add a category.
			echo elgg_view('news/listing_widget/info_middle_extend', $vars);
		?>
	</h4>
</div>

<div class="clearfloat">&nbsp;</div>
