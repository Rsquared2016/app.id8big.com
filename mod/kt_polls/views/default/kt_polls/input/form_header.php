<?php
	/*
	 * Form header helper. 
	 * */

	$form_header = elgg_view('input/form', $vars);
	$form_header = str_replace('</form>', '', $form_header);
	echo $form_header;