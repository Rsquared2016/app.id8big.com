<?php
/*
 * Handle it with a view html.
 *
 * @uses $vars['entity']
 * */
$filter_type = get_input('entity_owner_filter', 'all');
//search_viewtype=gallery
$search_viewtype = get_input('search_viewtype', FALSE);
$listing_type = get_input('listing_type', FALSE);

if ($listing_type == 'full') {
	return FALSE;
}

$plugin_url = $vars['plugin_page_url'];


//Get tabs.
$context = elgg_get_context();
$links = GDriveBaseMain::ktform_get_listing_tabs($plugin_url, $context);

$current_url = current_page_url();
$query_found = strpos($current_url, '?');

if ($query_found) {
	$current_url = substr($current_url, 0, $query_found);
}

foreach($links as $link_key => $link) {
	if ($current_url == $link) {
		$links['current_tab'] = $link_key;
	}
}

if (!array_key_exists('current_tab', $links)) {
	$links['current_tab'] = $filter_type;
}

//Set an input, to define current tab.
GDriveBaseMain::ktform_set_current_tab($links['current_tab']);

?>
<ul class="tabGeneric">
	<?php foreach($links as $key_link => $link) {
		if ($key_link == 'current_tab') {
			continue;
		}
		
		$tab_name = elgg_echo('gdrive_ktform:custom_tabs:'.$key_link);
		
		//Validate if page_owner is different from logged in.
		if($key_link == 'mine' && elgg_get_page_owner_guid() != elgg_get_logged_in_user_guid()) {
			$elgg_get_page_owner_entity = elgg_get_page_owner_entity();
			$tab_name = sprintf(elgg_echo("gdrive_ktform:custom_tabs:{$key_link}:custom"), $elgg_get_page_owner_entity->name);
		} 

		if ($search_viewtype) {
			$link = elgg_http_add_url_query_elements($link, array('search_viewtype' =>$search_viewtype ));
		}
		?>
		<li class="<?php echo ($key_link == $links['current_tab']) ? 'on' : '' ?>">
			<a href="<?php echo $link ?>"><?php echo $tab_name ?></a>
		</li>
	<?php }?>
</ul>

<?php
	echo elgg_view('gdrive/bulk_actions/form', $vars);
?>
