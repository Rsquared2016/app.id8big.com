<?php
/*
 * This is a simple wrapper for listing entities objects.
 *
 * */

$entity_subtype = $vars['entity_subtype'];
$extra_class = 'listingWidgetWrapper';

if ($vars['extra_class']) {
	$extra_class = " {$vars['extra_class']}";
}

//Check entities extra listing fields.
$css = '';
$extra_fields_count = 0;

$css .= "itemCol$extra_fields_count";

//Image support.
$image_support = PollsBaseMain::ktform_get_entity_image_support($entity_subtype);

//If no image support, add a class to view the listing in full witdh.
if (!$image_support) {
	$css .= ' itemFull';
}
?>

<div class='searchListingCols <?php echo $css ?> <?php echo $extra_class ?>'>
<?php
if ($vars['entities']) {
	echo $vars['entities'];
} else {
	echo sprintf(elgg_echo("kt_polls_ktform:entities:{$entity_subtype}:listing:empty_results"));
}
?>
</div>
<script type="text/javascript">
	$(document).ready(
	function() {
		$('.listingWidgetWrapper .search_listing:first').css('border-top', 'none');
	}
);
</script>
