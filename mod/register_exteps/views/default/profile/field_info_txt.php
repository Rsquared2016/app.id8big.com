<?php 
if (!is_callable('content_moderation_allow_profile_moderation') || content_moderation_allow_profile_moderation() == FALSE) {
	return FALSE;
}

$name = FALSE;
if (isset($vars['name']) && !empty($vars['name'])) {
	$name = $vars['name'];
}

$metaname = "{$name}_tmp";
$user = page_owner_entity();
if (!($user instanceof ElggUser)) {
	return FALSE;
}


$value = $user->$metaname;
if (empty($value)) {
	return FALSE;
}

switch($name) {
	case 'description':
		$value = elgg_get_excerpt($value, 50);
	break;

	case 'profileicon':
		$value = elgg_echo('kt_form:register:label:profileicon');
		break;
}

$options_values = FALSE;
if (is_array($vars['options_values'])) {
	$options_values = $vars['options_values'];
}

if ($options_values) {
	if (array_key_exists($value, $options_values)) {
		$value = $options_values[$value];
	}
}

?>

<div class="ktInfoTxtProfile">
    <div class="ico"><span class="color"><?php echo $value ?></span> está pendiente de aprobación</div>
</div>
