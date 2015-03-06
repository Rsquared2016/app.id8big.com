<?php
/**
 * Elgg file upload/save form
 *
 * @package ElggFile
 */
// once elgg_view stops throwing all sorts of junk into $vars, we can use 
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$fine_uploader_form = elgg_extract('fine_uploader_form', $vars, FALSE);

$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

if ($guid) {
	$file_label = elgg_echo("file:replace");
	$submit_label = elgg_echo('save');
} else {
	$file_label = elgg_echo("file:file");
	
	if ($fine_uploader_form) {
		$submit_label = elgg_echo('Embed');
	} else {
		$submit_label = elgg_echo('upload');
	}
}


$input_type = 'input/file_uploader';
preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
if (count($matches) > 1){ 
	$input_type = 'input/file';
}
?>
<div>
	<label><?php echo $file_label; ?></label><br />
<?php
echo elgg_view($input_type, array('name' => 'upload'));
?>

	<?php if ($fine_uploader_form == FALSE) { ?>
	</div>
	<div>
		<label><?php echo elgg_echo('title'); ?></label><br />
		<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('description'); ?></label>
		<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('tags'); ?></label>
		<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
	</div>
	<?php
	$categories = elgg_view('input/categories', $vars);
	if ($categories) {
		echo $categories;
	}
	?>
<?php } ?>
<div>
	<label><?php echo elgg_echo('access'); ?></label><br />
<?php echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id)); ?>
</div>
<div class="elgg-foot">
<?php
echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'file_guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => $submit_label));
?>
</div>
