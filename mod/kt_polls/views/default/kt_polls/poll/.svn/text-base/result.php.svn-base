<?php
/**
 * Result view file
 * @package kt_polls
 *
 */
$entity = elgg_extract('entity', $vars);

if (!($entity instanceof Polls)) {
	return TRUE;
}

$title = $entity->title;

$context = elgg_get_context();

//Title: 2 lines.
if($context == 'profile') {
	$title = elgg_get_excerpt($title, '80');
}


$complete_results = $entity->retrievePercentageResults();

$count_total = TRUE;
$num_answers = $entity->retrievePercentageResults($count_total);

$entity_owner_filter = get_input('entity_owner_filter', FALSE);
/**
 * $num_answers
 *[0] => Array
        (
            [label] => Question Title
            [percentage] => 100
        )
 */
?>
<div class="pollResults">
<?php if ($entity_owner_filter == FALSE) { ?>
	<div class="pollTitle"><?php echo $title ?></div>
<?php } ?>
	<ul class="pollResults">
		<?php 
			foreach($complete_results as $result) {
				$poll_label = $result['label'];
				$poll_label_text = $result['label'];
				//Trim ?
				/*if($context == 'profile') {
					$poll_label_text = elgg_get_excerpt($poll_label_text, '90');
				}*/
		?>
			<li>
				<div class="pollResTitle">
					<span class="txt" title="<?php echo $poll_label; ?>"><?php echo  $poll_label_text; ?></span>
					<span rel="percentTxt">(<?php echo $result['percentage'] ?>%)</span>
				</div>
				<div class="percentBar">
					<div class="percentBarInner" title="<?php echo $result['percentage'] ?>"></div>
				</div>
			</li>
		<?php } ?>
	</ul>
	<div class="pollTotal"><?php echo sprintf(elgg_echo('kt_polls:widget:result:total'), $num_answers) ?></div>
</div>
