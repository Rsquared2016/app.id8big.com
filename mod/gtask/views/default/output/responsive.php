<?php



$value = 0;
$user = FALSE;

if (isset($vars['entity']->responsive)) {
	$value = $vars['entity']->responsive;
	$user = get_user($value);
}

if ($user) {
	echo $user->name;
} else {
	if (!empty($vars['value'])) {
		echo $vars['value'];
	}
}


	
