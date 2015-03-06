<?php
//Here will be the calendar bottom info.

//KTODO: Here we should show the attend options checking the $vars['attend_options']
/*
 * @uses $vars['attend_options'] This params tell wich are the default ones.
 */

$subtype_background_color = array(
    'events' => '#3366CC',
    'meeting' => '#CC2113',
    'gtask' => '#F2DA32',
    'gcalendar' => '#486b40',
);
?>
<div class="attendYesNo">
	<?php
	 if($subtype_background_color) {
	?>
	<ul>
		<?php
		 foreach($subtype_background_color as $key=>$val) {
			 $class_key = ucwords($key);
			 $class = "legend{$class_key}";
			 $text = elgg_echo('calendar:'.$key);
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