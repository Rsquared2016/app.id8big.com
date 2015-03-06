<?php

/*
 * This view put the image input.
 * 
 * */

//As default will resize, make it configurable.
$image_options = array('resize' => true);

if($vars['image_options'] && is_array($vars['image_options'])) {
	$image_options = array_merge($image_options, $vars['image_options']);
}

//echo elgg_view('input/hidden', array('internalname' => 'input_image', 'value' => $vars['internalname']));
$_SESSION['images']['input_image'] = $vars['internalname'];
$_SESSION['images']['image_options'] = $image_options;
echo elgg_view('input/file', $vars);

?>
<?php 
//Validate form enctype, part/multipart 
?>
<script type="text/javascript">
	var form= $('input[name=<?php echo $vars['internalname'] ?>]').parents('form');

	if($(form).attr('enctype') != 'multipart/form-data') {
		alert('<?php echo elgg_echo('image:missing:multipart_form_data') ?>');
	}
</script>