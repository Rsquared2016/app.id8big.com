<?php

/**
 * leancanvas/add_comment
 */

$entity_guid = elgg_extract('entity_guid', $vars, '');
$page_owner = elgg_extract('page_owner', $vars, '');
$comment_type = elgg_extract('comment_type', $vars, '');
?>
<div>
<?php
	echo elgg_view('input/longtext', array(
		'name' => 'comment',
		'class' => 'comment',
		'id' => 'comment',
	));
	echo elgg_view('input/hidden', array(
		'name' => 'entity_guid',
		'value' => $entity_guid,
	));
	echo elgg_view('input/hidden', array(
		'name' => 'comment_type',
		'value' => $comment_type,
	));
	echo elgg_view('input/hidden', array(
		'name' => 'page_owner',
		'value' => $page_owner,
	));
?>
</div>
<div>
    <p><?php echo elgg_echo("compass:comments:{$comment_type}:note"); ?></p>
</div>
<div>
	<?php
		echo elgg_view('input/submit', array(
			'name' => 'add_comment',
			'value' => elgg_echo("compass:comments:{$comment_type}:add:comment"),
		))
	?>
</div>