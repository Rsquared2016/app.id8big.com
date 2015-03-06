<?php

/**
 * leancanvas/add_comment
 */

$section_id = elgg_extract('section_id', $vars, '');
$page_owner = elgg_extract('page_owner', $vars, '');
?>
<h3><?php echo elgg_echo('leancanvas:comments:add'); ?></h3>
<div>
<?php
	echo elgg_view('input/longtext', array(
		'name' => 'comment',
		'class' => 'comment',
		'id' => 'comment',
	));
	echo elgg_view('input/hidden', array(
		'name' => 'section_id',
		'value' => $section_id,
	));
	echo elgg_view('input/hidden', array(
		'name' => 'page_owner',
		'value' => $page_owner,
	));
?>
</div>
<div>
	<?php
		echo elgg_view('input/submit', array(
			'name' => 'add_comment',
			'value' => elgg_echo('leancanvas:comments:add:comment'),
		))
	?>
</div>