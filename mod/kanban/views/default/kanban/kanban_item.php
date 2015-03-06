<?php
/*
 * Kanban Task Item
 */
$entity = elgg_extract('entity', $vars);
if(!$entity || !($entity instanceof Gtask)) {
	return false;
}

//KTODO: Add class: task-important and task-overdue to filter with js. 
//KTODO: Add responsible to each task

$title = $entity->title;
$link = $entity->getURL();
$description = $entity->description;

//Comment
$comments_count = $entity->countComments();
$comments_link = $link;

//Task information
$deadline = date('Y-m-d', strtotime($entity->calendar_end));
$overdue = ($entity->calendar_end < date('Y-m-d')) ? 1 : 0;
$priority = $entity->getPriorityText();
$status = $entity->status;

//Responsible.
$response_id = $entity->responsive;
if($response_id) {
	$responsible = get_user($response_id);
	$responsible_name = $responsible->username;
	$user_icon = elgg_view_entity_icon($responsible, 'tiny');
} else {
	//default icon.
}
?>
<div class="portlet" rel="<?php echo $entity->guid; ?>" data-responsible="<?php echo $response_id; ?>" data-overdue="<?php echo $overdue; ?>" data-priority="<?php echo $priority; ?>" data-status="<?php echo $status; ?>">
	<div class="portlet-header">
		<span class="title-content">
			<?php
				echo elgg_view('output/url', array('href' => $link, 'text' => $title, 'target' => '_blank'));
			?>
		</span>
	</div>
	<div class="details">
        <?php if ($user_icon) { ?>
		<span class="assigned">
			<?php
				echo $user_icon;
			?>
		</span>
        <?php } ?>
		<div class="badges">
			<div class="badge comments">
				<?php 
				$comment_img = "<div class='commnetImg'><span></span>{$comments_count}</div>";
				echo elgg_view('output/url', array('href' => $comments_link, 'text' => $comment_img, 'target' => '_blank'));
				?>
			</div>
			<div class="deadline">
				<?php 
				echo $deadline;
				?>
			</div>
			<?php
				/* priority-important */
				if ($priority == 'high') {
			?>
			<div class="priority">
				<?php /*<span class="priority-<?php  echo $priority; ?>"></span>*/?>
				<span class="myPriority taskPriorityHigh"> </span>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<div class="cThis"></div>
	<div class="portlet-content">
		<label><?php echo elgg_echo('kanban:description'); ?></label>
		<?php
			echo elgg_view('output/longtext', array('value' => $description));
		?>
	</div>	
</div>