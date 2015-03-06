<?php
/**
 * This view generate the form for tests and polls
 */
$entity = $vars['entity'];
$check_entity = ($entity instanceof Polls);

if ($check_entity == FALSE) {
	return FALSE;
}

$description = elgg_view('output/longtext', array('value' => $entity->description));
$form_element = $vars['form_element'];

$security_token = elgg_view('input/securitytoken');
$entity_guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->getGUID()));
?>
<div class="testQuestions pollQuizProfile">
	<?php /**  I know use HTML form instead views is not optimal, but needed here cuz of the design **/?>
	<form action="<?php echo $vars['url'].'action/poll_quiz/vote/'?>" method="POST" name="poll_quiz">
		<div class="block block1">
			<?php echo $description ?>
			<ul>
				<?php echo $form_element ?>
			</ul>

		</div>
		<?php
			echo $security_token;
			echo $entity_guid_input;
		?>
		<div class="ktForm rBtn">
			<?php echo elgg_view('input/submit', array('value' => elgg_echo('kt_form:kt_polls:submit:poll_quiz'))) ?> 
		</div>
	</form>
</div>