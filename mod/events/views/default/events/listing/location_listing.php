<?php
$return = '';
if (isset($vars['entity'])) { 
	$return = $vars['entity']->location;
}

echo $return;
