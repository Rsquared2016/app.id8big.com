<?php
/**
 * Display the latest photos uploaded by an individual
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */
$limit = $vars['entity']->num_display;
if (empty($limit)) {
	$limit = 4;
}

$latest_photos =  elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'image',
	'limit' => $limit,
	'owner_guid' => elgg_get_page_owner_guid(),
	'full_view' => false,
	'list_type' => 'gallery',
	'list_type_toggle' => false,
	'gallery_class' => 'tidypics-gallery-widget',
    'pagination' => FALSE,
));

if ($latest_photos) {
    echo $latest_photos;
    
    $user = elgg_get_page_owner_entity();
    $url = $vars['url'].'photos/owner/'.$user->username;
    echo elgg_view('output/url', array(
        'href' => $url,
        'text' => elgg_echo('album:more'),
        'is_trusted' => true,
    ));
    
} else {
    echo elgg_echo('tidypics:widget:latest_photo:no_data');
}
