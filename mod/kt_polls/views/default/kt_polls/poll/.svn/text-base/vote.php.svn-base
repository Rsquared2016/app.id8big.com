<?php

$entity = elgg_extract('entity', $vars);
if(!$entity instanceof Polls) {
	return false;
}

$title = $entity->title;

//Title: 2 lines.
$title = elgg_get_excerpt($title, '120');

$form_element = $vars['form_element'];

$security_token = elgg_view('input/securitytoken');
$entity_guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->getGUID()));

?>
<div class="pollVoteWidget">
	<form action="<?php echo $vars['url'].'action/poll_quiz/vote/'?>" method="POST" name="poll_quiz">
		<div class="pollTitle"><?php echo $title; ?></div>
		<ul class="pollItems">
			<?php
				echo $form_element
			?>
		</ul>
		<?php
			echo $security_token;
			echo $entity_guid_input;
		?>
		<div class="ktForm rBtn ">
			<?php echo elgg_view('input/submit', array('value' => elgg_echo('kt_form:kt_polls:submit:poll:vote'), 'class' => 'flLef')) ?>
			<div class="ajxWrapperLoader flRig"></div>
			<div class="clearfloat">&nbsp;</div>
		</div>
	</form>
</div>
