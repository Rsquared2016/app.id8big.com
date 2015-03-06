<?php

	$entity = elgg_extract('entity', $vars);
	$entity instanceof ElggUser;
	if (elgg_instanceof($entity, 'user') == FALSE) {
		return FALSE;
	}
	
	$user_guid = $entity->getGUID();
	
	$menu = elgg_trigger_plugin_hook('register', "menu:user_hover", array('entity' => $entity), array());
	$builder = new ElggMenuBuilder($menu);
	$menu = $builder->getMenu();
	$actions = elgg_extract('action', $menu, array());
	
	$allowed_items = array(
		 'add_friend',
		 'send',
		 'remove_friend',
	);
	
	$profile_actions = '';
	if (elgg_is_logged_in() && $actions) {
		$actions_count_max = count($actions);
		$actions_count = 0;
		$actions_class = 'elgg-button ';
		foreach ($actions as $action) {
			$item_name = $action->getName();
			$actions_count++;
			if($actions_count == $actions_count_max) {
				$actions_class .= 'nmRig ';
			}
			if (in_array($item_name, $allowed_items)) {
				$profile_actions .=  $action->getContent(array('class' => $actions_class));
			}
		}
	}

?>
<div class="hovercardInfo hidden" data-hover-info="<?php echo $user_guid ?>">
	<div class="hoverCardCont">
		<div class="usrHovHead">
			<div class="usrHovPicture flLef">
				<?php echo elgg_view_entity_icon($entity, 'medium', array('use_hover' => FALSE)) ?>
				<div class="clearfloat"></div>
			</div>
			<div class="usrHovMenu flLef">
				<h2><?php echo elgg_view('output/url', array('text' => $entity->name, 'href' => $entity->getURL(), 'is_trusted' => TRUE ))?></h2>
				<div class="hsrHovOptions">
					<?php 
						echo elgg_view_menu('owner_block', array('entity' => $entity));
						echo elgg_view('page/elements/owner_block/extend', $vars);
					?>
				</div>
				<div class="clearfloat"></div>
			</div>
			<div class="clearfloat"></div>
		</div>
		<?php if ($profile_actions) {?>
		<div class="usrHovBottom">
			<?php echo $profile_actions; ?>
		</div>
		<?php } ?>
	</div>	
</div>