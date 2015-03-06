<?php
/*
 * Handle it with a view html.
 *
 * @uses $vars['entity']
 * */
if(!$vars['entity']) {
	return false;
}

$entity_subtype = HelpBaseMain::ktform_get_subtype($vars);

$entity = $vars['entity'];

//KTODO: Obtener titulo y descripcion cortados dependiendo de cantidad de campos extra en el listado y dependiendo de layout 2 o 3 columnas.
//help_ktform_get_trimed_title().
$title = $entity->title;
if (!$title) {
	$title = $entity->name;
}
if (!$title) {
	$title = get_class($entity);
}

//Get custom title
if(is_callable(array(get_class($entity), 'getTitle'))) {
	$title = $entity->getTitle();
}

$description = $entity->description;
$description = elgg_get_excerpt($description, 45);

//Get custom description
if(is_callable(array(get_class($entity), 'getDescription'))) {
	$description = $entity->getDescription();
}

$friendly_time = elgg_get_friendly_time($entity->time_created);
//$friendly_time = date('d/m/Y', $entity->time_created);

$owner = $entity->getOwnerEntity();

if(strlen($title) > Help_st_MAX_LENGHT_TITLE_LISTING){
	$title = elgg_get_excerpt($title, Help_st_MAX_LENGHT_TITLE_LISTING);
}
?>

<?php
//Entity title and description section.

//Add some views to modify information.
$view_info_title = "$entity_subtype/ktform/listing/info_title";
$view_info_middle = "$entity_subtype/ktform/listing/info_middle";
$view_info_text = "$entity_subtype/ktform/listing/info_text";
?>
<div class="infoListing" data-time="<?php echo $entity->time_created; ?>" data-rel="<?php echo $entity->getGUID(); ?>">
<?php
	//Check if we are overriding the title listing.
	if(elgg_view_exists($view_info_title)) {
		echo elgg_view($view_info_title, $vars);
	} else {
?>
	<div class="infoListingTitle">
		<h3><a href="<?php echo $entity->getUrl(); ?>"><?php echo $title; ?></a></h3>
	
		<div class="clearfloat">&nbsp;</div>
	</div>
<?php
	}
?>
<?php
	//Check if we are overriding the info middle listing.
	if(elgg_view_exists($view_info_middle)) {
		echo elgg_view($view_info_middle, $vars);
	} else {
?>
	<h4>
		<?php if ($owner) { ?>
		<a href="<?php echo $owner->getURL() ?>"> <?php echo $owner->name; ?></a>
		<span class="sep">·</span><span class="infoListingTime"><?php echo  $friendly_time?></span>
		<?php } ?>
		<?php
			//This view should be extended to add a category.
			echo elgg_view('help/listing/info_middle_extend', $vars);


		?>
	</h4>
<?php
	}
?>
<?php
	//Check if we are overriding the info text listing.
	if(elgg_view_exists($view_info_text)) {
		echo elgg_view($view_info_text, $vars);
	} else {
?>
	<div class="txtInfo"><?php echo $description; ?></div>
<?php
	}
?>
</div>

<?php
	/*
	 * Entity addtional fields section.
	 * */
	$extra_fields = HelpBaseMain::ktform_get_extra_listing_fields($entity_subtype);

	if($extra_fields && is_array($extra_fields) && count($extra_fields)) {
?>
<div class="itemListingCols">
	<?php
		$item_col_count = 1;
		$max_item_count = count($extra_fields);
		foreach($extra_fields as $internalname => $options) {
	?>
	<div class="itemCol <?php if ($item_col_count == $max_item_count) { echo 'lastItemCol'; } else { $item_col_count++; } ?>">
		<?php /* Yes, I know, a table... it's used for vertical alignement, there's not other working way */ ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<span><?php
						$output_view = $options['output_view'];
						$output_vars = array('value' => $entity->$internalname, 'entity' => $entity);
						if(array_key_exists('options', $options)) {
							$output_vars = array_merge($options['options'], $output_vars);
						}

						echo elgg_view($output_view, $output_vars);
					?></span>
				</td>
			</tr>
		</table>
	</div>
	<?php
		}
	?>
	<div class="clearfloat">&nbsp;</div>
</div>
<?php
	}
?>
<?php
/*
 * Entity actions section.
 * */
//echo elgg_view('help/tools/action_wheel', $vars);

?>
<div class="clearfloat">&nbsp;</div>
