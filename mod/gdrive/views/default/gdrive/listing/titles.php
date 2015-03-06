<?php
/*
 * Handle the titles on top of the entity listing.
 *
 * */

//Get the titles.
$object_subtype = $vars['object_subtype'];

//If no object subtype. Try to get from context.
if(!$object_subtype) {
	$object_subtype = elgg_get_context();
}

//Add some views to modify information.
$view_left_title = "$object_subtype/ktform/listing/ul_listing_title_left";


//Try to get extra listing fields.

$search_viewtype = get_input('search_viewtype', '');
$listing_type = get_input('listing_type', '');
if($search_viewtype != 'gallery' && $listing_type != 'full') {
	$extra_fields = GDriveBaseMain::ktform_get_extra_listing_fields($object_subtype);
	$extra_field_key_name = 'gdrive_ktform:listing:top:titles';
	if($extra_fields && is_array($extra_fields)) {
		
?>

<div class="listingTitle">
<?php
if(elgg_view_exists($view_left_title)) {
	echo elgg_view($view_left_title, $vars);
}		
?>
		<ul class="ulListingTitle">
		<?php
		foreach($extra_fields as $internalname => $options) {
			$key_name = "$extra_field_key_name:$internalname";
			$key_text = elgg_echo($key_name);
			
			$sortable = FALSE;
			if (array_key_exists('sortable',$options) && $options['sortable'] === TRUE) {
				$sortable = TRUE;
			}
			
			$li_class = '';
			$sort_type = get_input('sort_type', 'asc');
			if ($sort_type != 'asc') {
				$sort_type = 'desc';
			}
			
			if(array_key_exists('order_type', $options)) {
				set_input('order_type', $options['order_type']);
			}
			
			if ($sortable) {
				$key_text = GDriveBaseMain::ktform_generate_sortable_link($internalname, $key_text);
				$li_class = 'sortableWrapper sortableHeader';
				
				$sort_type = GDriveBaseMain::ktform_camelize_string($sort_type, TRUE);
				if (get_input('order_by') == $internalname) {
					$li_class = "sortableWrapper sortableHeader{$sort_type}";
				}
			}
			
		?>
			<li class="<?php echo $li_class ?>" rel="<?php echo $internalname ?>"><?php echo $key_text; ?></li>
		<?php
		} //End foreach
		?>
	</ul>
	<div class="clearfloat">&nbsp;</div>
</div>
<?php
	}
}
?>
