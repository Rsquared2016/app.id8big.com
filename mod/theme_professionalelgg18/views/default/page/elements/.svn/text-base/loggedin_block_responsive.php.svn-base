<?php

// groups and other users get owner block
$logged_in_user = elgg_get_logged_in_user_entity();

if(elgg_is_logged_in()) {
	if (elgg_instanceof($logged_in_user, 'user')) {
?>
<div class="imgProfileContainerSidebar">
	<?php
		echo elgg_view_entity_icon($logged_in_user,
			'medium',
			array(
				'use_hover' => false,
				'use_link' => true,
			));
	?>
	<a href="#" class="elgg-button elgg-button-submit flLef" id="mnLefShowHide" title="<?php echo elgg_echo('sidebar:menu:site'); ?>"><span><?php echo elgg_echo('sidebar:menu:btn'); ?></span></a>
	<div class="clearfloat"></div>
</div>
<?php
	}
}
?>
