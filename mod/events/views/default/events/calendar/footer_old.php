<?php
//Here will be the calendar bottom info.

//KTODO: Here we should show the attend options checking the $vars['attend_options']
/*
 * @uses $vars['attend_options'] This params tell wich are the default ones.
 */

$attend_options_default = events_get_attend_options();
$attend_options = $vars['attend_options'];
?>
<div class="attendYesNo">
	<?php
	 if($attend_options) {
	?>
	<ul>
		<?php
		 foreach($attend_options as $val) {
			 $class_key = ucwords($val);
			 $class = "userAttend{$class_key}";
			 $text = $attend_options_default[$val];
		?>
			<li class="<?php echo $class; ?>">
				<div class="color"></div>
				<div class="txt"><?php echo $text; ?></div>
				<div class="cThis">&nbsp;</div>
			</li>
		<?php
		 }
		?>
	</ul>
	<?php
	 }
	?>
</div>