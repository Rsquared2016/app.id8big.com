<?php
$entity = elgg_extract('entity', $vars);
$check_entity = ($entity instanceof Polls);

if ($check_entity == FALSE) {
	return FALSE;
}

$results = $entity->retrievePollQuizAnswers();
$num_answers = array_sum($results);
?>
<div class="pollQuizMessages">
	<div class="voted">
	<?php
		echo elgg_echo('kt_polls:poll_voted');
	?>
	</div>
	<div class="pollQuizResults">
		<div class="pollResultTitle">
			<h4><?php echo elgg_echo('kt_polls:title:poll_results')?></h4>
			<span>(<?php echo sprintf(elgg_echo('kt_polls:answers:num'), $num_answers) ?>)</span>
		</div>
		<ul class="ulPollResults">
			<?php foreach($results as $answer => $value) { ?>
				<li>
					<b><?php echo ucfirst($answer)?></b> <?php echo $value ?>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
