<?php

$context = GDriveBaseMain::ktform_get_subtype($vars);

if (elgg_is_active_plugin('keetup_categories') && GDriveBaseMain::ktform_get_entity_category_support($context)) {
//	echo elgg_view('output/keetup_categories_tiny', $vars);
	echo elgg_view('output/keetup_categories', $vars);
}