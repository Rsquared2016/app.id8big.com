<?php
/**
 * Search box in page header
 */
if(elgg_is_active_plugin('asearch')) {
	echo elgg_view('search/search_box', array('class' => 'elgg-search-header'));
}
else {
	echo elgg_view('search/search_box_theme', array('class' => 'elgg-search-header'));
}
