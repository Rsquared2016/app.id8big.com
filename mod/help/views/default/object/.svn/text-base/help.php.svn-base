<?php

/**
 * HelpBaseForm profile display
 *
 * @author BOrtoli German and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */



$viewtype = get_input('search_viewtype');
$listing_type = get_input('listing_type');

$options = compact(array('viewtype', 'listing_type'));
$option_viewtype = FALSE;

$ktform_overriden = get_input('ktform_overriden', FALSE);
if ($ktform_overriden == TRUE) {
	return FALSE;
}
//Obtenemos uno de los valores que no esten vacios
foreach($options as $option) {
	if (!empty($option)) {
		$option_viewtype = $option;
	}
}

if ($vars['full_view']) {
	$display_type = get_input('display_type', '');

	switch($display_type) {
		case 'full':
				echo elgg_view('help/profile_full', $vars);
			break;
		default:
				echo elgg_view('help/profile', $vars);
			break;
	}

} else {
	switch ($option_viewtype) {

		case 'full':
			echo elgg_view('help/listing_full', $vars);
		break;

		case 'gallery':
			echo elgg_view('help/gallery', $vars);
		break;

		case 'widget':
			echo elgg_view('help/listing_widget', $vars);
		break;

		default:
			echo elgg_view('help/listing', $vars);
		break;
	}
}
