<?php

/*
 * Tabs
 */

$tab = $vars['tab'];
$selected_tabs = $vars['selected_tabs'];

$step_number = 1;

?>
<ul class="regStepsTop clearfix" id="register_tab">
<?php
	foreach ($selected_tabs as $tab_key => $tab_text) {
?>
	<li class="<?php echo ($tab == $tab_key) ? 'elgg-state-selected' : ''; ?> tabNumber<?php echo $step_number; ?> clearfix">
		<div class="circleNumber flLef"><span><?php echo $step_number; ?></span></div>
		<div class="stepText flLef"><?php echo $tab_text; ?></div>
	</li>
<?php
		$step_number++;
	}
?>
</ul>
