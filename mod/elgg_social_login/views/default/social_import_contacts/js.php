<?php

/*
 * Social Import Contacts JS
 */

?>
//<script>
elgg.provide('elgg.social_import_contacts');

elgg.social_import_contacts.init = function () {
	
	// Social Import Contacts
	$('a.social_import_contacts').fancybox();
	
}

elgg.register_hook_handler('init', 'system', elgg.social_import_contacts.init);