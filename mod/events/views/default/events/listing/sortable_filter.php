<?php
/*
 * Handle the titles on top of the entity listing.
 *
 * */

//Get the titles.
$object_subtype = $vars['object_subtype'];

//If no object subtype. Try to get from context.
if (!$object_subtype) {
	$object_subtype = elgg_get_context();
}

//Add some views to modify information.
$view_left_title = "$object_subtype/ktform/listing/ul_listing_title_left";


//Try to get extra listing fields.
$extra_fields = EventsBaseMain::ktform_get_extra_listing_fields($object_subtype);

$sortable_fields = array();
foreach ($extra_fields as $internalname => $options) {
	if (array_key_exists('sortable', $options) && $options['sortable'] === TRUE) {
		$sortable_fields[$internalname] = $options;
	}
}

if (count($sortable_fields) == 0) {
	return FALSE;
}

$extra_field_key_name = 'events_ktform:sorteable:link';
?>

<div class="sortingWrapper">
	<h5 class="sortingTitle"><?php echo elgg_echo('events:sort:title') ?></h5>
	<ul class="sortingListing elgg-menu-site-more elgg-menu elgg-menu-site">
	<?php
		foreach ($sortable_fields as $internalname => $options) {
			$key_name = "$extra_field_key_name:$internalname";
			$key_text = elgg_echo($key_name);

			$li_class = '';
			$sort_type = get_input('sort_type', 'asc');
			if ($sort_type != 'asc') {
				$sort_type = 'desc';
			}

			if (array_key_exists('order_type', $options)) {
				set_input('order_type', $options['order_type']);
			}

			$key_text = EventsBaseMain::ktform_generate_sortable_link($internalname, $key_text);
			$li_class = 'sortableItem sortableHeader';

			$sort_type = EventsBaseMain::ktform_camelize_string($sort_type, TRUE);
			if (get_input('order_by') == $internalname) {
				$li_class = "sortableItem sortableHeader{$sort_type}";
			}
			?>
			<li class="<?php echo $li_class ?>" rel="<?php echo $internalname ?>"><?php echo $key_text; ?></li>
			<?php
		} //End foreach
	?>
	</ul>
	<div class="clearfloat">&nbsp;</div>
</div>

