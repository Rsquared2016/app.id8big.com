<?php
$form = $vars['form'];

//The classname is an extra arg, that you could use to add one more class to the default classname.
$classname = elgg_extract('class', $vars, '');
$classname .= " ktFrm";
echo elgg_view('jobs/form_wrapper', array('form' => $form, 'classname' => $classname));