<?php 

$plugin_name = 'likes';
if (elgg_is_active_plugin($plugin_name) == FALSE) {
	return FALSE;
}

$allow_dislike = elgg_get_plugin_setting('allowdislike', 'likes');
if (is_string($allow_dislike)) {
	$allow_dislike = strtolower($allow_dislike);
}

$likes = elgg_view('likes/item_action/element', array_merge(array('action_name' => 'like', 'add_action_class' => 'aInteract'), $vars));
echo elgg_view('likes/wrapper', array('body' => $likes));

?>

<span class="sep"></span>

<?php if ($allow_dislike == 'yes') {?>
	<?php
		$dislikes = elgg_view('likes/item_action/element', array_merge(array('action_name' => 'dislike', 'add_action_class' => 'aInteract'), $vars));
		echo elgg_view('likes/wrapper', array('body' => $dislikes));
	?>

	<span class="sep"></span>
<?php } ?>
