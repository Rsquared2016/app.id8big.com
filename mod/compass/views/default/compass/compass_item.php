<?php
/*
 * Compass Task Item
 */
$entity = elgg_extract('entity', $vars);
if(!$entity || !elgg_instanceof($entity, 'object', 'lean_objective')) {
	return false;
}

$title = $entity->title;
//$link = $entity->getURL();
//$description = $entity->description;

//Comment
$site_url = elgg_get_site_url();
$entity_guid = $entity->guid;
$container_guid = $entity->container_guid;

// OLD
//$note_link = Compass::renderLinkComment($entity, Compass::NOTES_NAME);
//$experiment_link = Compass::renderLinkComment($entity, Compass::EXPERIMENT_NAME);

// NEW
$note_content = Compass::renderContentComment($entity, Compass::NOTES_NAME);
$experiment_content = Compass::renderContentComment($entity, Compass::EXPERIMENT_NAME);
$riskiest_assumption_content = Compass::renderContentComment($entity, Compass::RISKIEST_ASSUMPTION_NAME);
$expected_outcome_content = Compass::renderContentComment($entity, Compass::EXPECTED_OUTCOME_NAME);
$key_metrics_measured_content = Compass::renderContentComment($entity, Compass::KEY_METRICS_MEASURED_NAME);
$task_content = Compass::renderContentComment($entity, Compass::TASK_NAME);
$result_content = Compass::renderContentComment($entity, Compass::RESULT_NAME);
$whats_the_next_step_content = Compass::renderContentComment($entity, Compass::WHATS_THE_NEXT_STEP);

$show_hide_details = FALSE;
if (!empty($note_content)) {
    $show_hide_details = TRUE;
}

$section = $entity->section;
?>
<div class="portlet" rel="<?php echo $entity->guid; ?>" data-responsible="<?php echo $response_id; ?>" data-overdue="<?php echo $overdue; ?>" data-priority="<?php echo $priority; ?>" data-status="<?php echo $status; ?>" data-section="<?php echo $section; ?>">
	<div class="portlet-header">
		<span class="title-content">
			<?php
				echo $title;
				//echo elgg_view('output/url', array('href' => $link, 'text' => $title, 'target' => '_blank'));
			?>
		</span>
        <?php
            if ($show_hide_details) {
                echo elgg_view('output/url', array(
                    'text' => elgg_echo('compass:content:comments:show'),
                    'href' => 'javascript:void(0)',
                    'class' => 'show-hide-details',
                    'rel' => $entity_guid,
                ));
            }
        ?>
	</div>
    <div class="details" id="details-<?php echo $entity_guid; ?>" <?php if ($show_hide_details) { echo 'style="display:none;"'; } ?>>
        <?php
            // NEW
            echo $riskiest_assumption_content;
            echo $experiment_content;
            echo $key_metrics_measured_content;
            echo $expected_outcome_content;
            echo $task_content;
            echo $result_content;
            echo $whats_the_next_step_content;
            echo $note_content;
        ?>
		<?php /*<div class="badges">*/ ?>
			<?php
                // OLD
//				echo $note_link;
//				echo $experiment_link;
			?>
			<?php
			/*
			<div class="badge comments">
				<?php 
				$comment_img = "<div class='commnetImg'><span></span>{$notes_count}</div>";
				echo elgg_view('output/url', array('href' => $notes_link, 'text' => $comment_img));
				?>
			</div>
			<div class="badge experiments">
				<?php 
				$comment_img = "<div class='commnetImg'><span></span>{$exp_count}</div>";
				echo elgg_view('output/url', array('href' => $exp_link, 'text' => $comment_img));
				?>
			</div>
			 */ ?>
		<?php /*</div>*/ ?>
	</div>
	<div class="cThis"></div>
	<?php 
	/*<div class="portlet-content">
		<label><?php echo elgg_echo('compass:description'); ?></label>
		<?php
			echo elgg_view('output/longtext', array('value' => $description));
		?>
	</div>*/
	?>
</div>