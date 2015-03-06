<?php

// Invited contacts

$name_specials = array(
	SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS . '_facebook',
	SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS . '_linkedin',
);

$annotation = $vars['annotation'];

$value = $annotation->value;

$name = $annotation->name;
if (in_array($name, $name_specials)) {
	$value = explode('#', $annotation->value);
	$value = $value[1];
}

$body = <<<HTML
<div class="mbn">
	$value
</div>
HTML;

echo elgg_view_image_block(false, $body);