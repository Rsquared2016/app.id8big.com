<?php
/**
 * This view generate the form for tests and polls
 */
$entity = elgg_extract('entity', $vars);
$check_entity = ($entity instanceof Polls);
 
if ($check_entity == FALSE) {
	return FALSE;
}

$title = elgg_view('output/text', array('value' => $entity->title));
$description = elgg_view('output/longtext', array('value' => $entity->description));
$form_element = $vars['form_element'];

$block_number = get_input('block_number', 1);

$tmp_blck_num = $block_number + 1;
set_input('block_number', $tmp_blck_num);

$entity_actions = $entity->getEntityLinkActions();

$edit_link_url = elgg_http_add_url_query_elements($vars['url'].'pg/kt_polls/edit/'.$entity->getGUID(), array('poll_context' => 'test_profile', 'container_guid' => $entity->getContainer()));
$edit_link = elgg_view('output/url', array('href' => $edit_link_url, 'text' => elgg_echo('edit'), 'class' => 'ktPollEdit'));

?>
<div class="block block<?php echo $block_number ?>">
	<div class="title">
		<h3 class="flLef"><?php echo $title ?></h3>
		<?php if ($entity->canEdit()) {?>
		<div class="flRig">
			<?php echo $edit_link ?>
			<span class="sep">·</span>
			<?php echo $entity_actions['delete']?>
		</div>
		<?php } ?>
		<div class="clearfloat">&nbsp;</div>
	</div>

	<?php if ($entity->icontime || $entity->video_type) { ?> 
	<div class="ktPollEmbed">
		<?php if($entity->icontime) {?>
		<div class="ktPollImg">
			<img src="<?php echo $entity->getIcon('large')?>" alt="" />
		</div>
		<?php } ?>

		<?php if ($entity->video_type) {?>
		<div class="ktPollVideo <?php echo $entity->video_type ?>">
				<?php echo elgg_view('ktform/video', array('entity' => $entity))?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	
	<?php if (!empty($description)) {?>
		<div class="description">
			<?php echo $description ?>
		</div>
	<?php } ?>

	<ul>
		
			<?php echo $form_element ?>
		
	</ul>
	
</div>
