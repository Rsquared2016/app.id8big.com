<?php
/**
 * Anypage language
 */

$english = array(
	'admin:appearance:anypage' => 'Anypage Pages',
	'admin:appearance:anypage:new' => 'New Page',

	'anypage:warning' => 'Warning',
	'anypage:unsupported_page_handler_character' => "This path uses a character that is unsupported "
		. "in the default version of Elgg's .htaccess rewrite rules. You can only use letters, "
		. "numbers, _, and - in paths before a /. Example: /test/page.html works but /page.html doesn't. <br /><br />"
		. "If you are using Apache and Elgg's default rewrite rules, this page will not work!."
	,
	
	'anypage:new' => 'New Page',
	'anypage:no_pages' => 'You have not created any pages yet. Click the "New Page" link above to add a page.',

	// form
	'anypage:path' => 'Page path',
	'anypage:path_full_link' => 'Full link',
	'anypage:layout' => 'Page Layout',
	'anypage:use_view' => 'Use a view',
	'anypage:use_view' => 'Use a view',
	'anypage:view_info' => 'This page will use the following view:',
	'anypage:body' => 'Page body',

	// actions
	'anypage:save:success' => 'Saved page',
	'anypage:delete:success' => 'Page deleted',
	'anypage:no_path' => 'You must enter a path',
	'anypage:page_handler_conflict' => 'The path you entered is already in use by a plugin.',
	'anypage:any_page_handler_conflict' => 'The path you entered is already registered to a page.',
	'anypage:delete:failed' => 'Could not delete page.',

	// example pages
	'anypage:example:title' => 'AnyPage Example Page',
	'anypage:example_page:description' => 'This is an example of a page rendered using AnyPage!',

	'anypage:example:view:title' => 'AnyPage Example Page (Using View)',
	'anypage:test_page_view' => 'This is an example of a page rendered by AnyPage using a view!',

	'anypage:activate:admin_notice' => 'AnyPage has added example pages. Use the <a href="%s">admin interface</a> to add more pages.',
	
	'anypage:custom_view:use_view' => 'You can enter the custom view, this will replace the default anypage view above.'
);

add_translation('en', $english);