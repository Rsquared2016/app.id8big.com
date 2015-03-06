<?php
/*
 * This is a simple wrapper for listing entities objects.
 *
 * */

$entity_subtype = $vars['entity_subtype'];
$extra_class = '';

if (isset($vars['extra_class']) && !empty($vars['extra_class'])) {
	$extra_class = " {$vars['extra_class']}";
} else {
	if (!empty($entity_subtype)) {
		$allowed_extra_class = 'A-Za-z0-9';

		$extra_class = GtaskBaseMain::ktform_camelize_string($entity_subtype, false);

		if (!empty($extra_class)) {
			$extra_class = ' ' . $extra_class . 'Wrapper';
		}
	}
}

//Check entities extra listing fields.
$css = '';
$extra_fields = GtaskBaseMain::ktform_get_extra_listing_fields($entity_subtype);

$extra_fields_count = 0;
if ($extra_fields && is_array($extra_fields)) {
	$extra_fields_count = count($extra_fields);
} else {
	$extra_fields_count = get_input('extra_fields_count', 0);
}

$css .= "itemCol$extra_fields_count";

//Image support.
$image_support = GtaskBaseMain::ktform_get_entity_image_support($entity_subtype);

//If no image support, add a class to view the listing in full witdh.
if (!$image_support) {
	$css .= ' itemFull';
}

$error_msg = elgg_echo("gtask_ktform:entities:{$entity_subtype}:listing:empty_results");
if($vars['custom_error_msg']) {
	$error_msg = $vars['custom_error_msg'];
}
?>

<div class='searchListingCols <?php echo $css ?> <?php echo $extra_class ?>'>
<?php
if ($vars['entities']) {
	echo $vars['entities'];
} else {
	if($vars['no_entities']) {
		echo $vars['no_entities'];
	} else {
		echo "<p class='noEntitiesTxt'>" . $error_msg . '</p>';
	}

}
?>
</div>
<?php
if ($vars['entities']) {
?>
<div class="ktBulkActionsBottom">
	<?php
		echo elgg_view('gtask/bulk_actions/form', $vars);
	?>
</div>
<?php
}
?>
<script type="text/javascript">
	$(document).ready(
		function() {
			$('.search_listing.searchListingFull:last').css('border', 'none');
		}
	);
	/* widths */
	if($('.smallerIcon').length) {
		$('.search_listing_info').css('margin-left', '70px');
		$('.search_listing_icon').css('width', '60px');
	}
</script>
