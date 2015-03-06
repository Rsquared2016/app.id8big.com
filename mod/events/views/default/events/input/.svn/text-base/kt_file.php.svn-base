<?php
/*
 * @uses $vars[file_options] - An array of options that can be passed to the file input
 *	$vars['file_options'] => array('type' => 'object_type', 'subtype' => 'object_subtype')
 * 
 * View input file options:
 * 
 * @uses $vars['js'] Any Javascript to enter into the input tag
 * @uses $vars['internalname'] The name of the input field
 * @uses $vars['internalid'] The id of the input field
 * @uses $vars['class'] CSS class
 * @uses $vars['disabled'] Is the input field disabled?
 * @uses $vars['value'] The current value if any
 */

$internalname = FALSE;

if (isset($vars['internalname']) && !empty($vars['internalname'])) {
	$internalname = $vars['internalname'];
}

if (empty($internalname)) {
	return FALSE;
}

$file_options = array(
	'type' => 'object',
	'subtype' => ELGG_ENTITIES_ANY_VALUE,
);

if (isset($vars['file_options']) && is_array($vars['file_options'])) {
	$file_options = array_merge($file_options, $vars['file_options']);
}

if (empty($file_options['type'])) {
	return FALSE;
}

$save_to_session = compact(array('internalname', 'file_options'));

if (empty($file_options['subtype'])) {
	$_SESSION[Events_st_FILE_NAME][$file_options['type']][$internalname] = $save_to_session;
} else {
	$_SESSION[Events_st_FILE_NAME][$file_options['type']][$file_options['subtype']][$internalname] = $save_to_session;
}

echo elgg_view('input/file', $vars);
?>

<script type="text/javascript">
	var form= $('input[name=<?php echo $vars['internalname'] ?>]').parents('form');

	if($(form).attr('enctype') != 'multipart/form-data') {
		alert('<?php echo elgg_echo('image:missing:multipart_form_data') ?>');
	}
</script>

