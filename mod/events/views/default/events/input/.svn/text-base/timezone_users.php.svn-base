<?php
$entity = elgg_extract('entity', $vars, FALSE);
if (empty($entity)) {
	$entity = elgg_get_page_owner_entity();
}

$value = elgg_timezone_get_timezone_user($entity);

$context = elgg_get_context();

$input = elgg_view('input/dropdown', array('name' => 'user_timezone', 'options_values' => elgg_timezone_get_timezones(TRUE), 'value' => $value));

if ($context == 'register') {
	?>
	<div class="rFrm timezoneSelectable clearfix mandatory">
		<label for=""><?php echo elgg_echo('events:register:timezone:label') ?></label>
		<?php echo $input ?>
	</div>
<?php } else { ?>
	<div class="elgg-module elgg-module-info mandatory">
		<div class="elgg-head">
			<h3><?php echo elgg_echo('events:register:timezone:label') ?></h3>
		</div>
		<div class="elgg-body">
			<p>
			<?php 
				echo elgg_echo('events:timezone:pulldown:help:label').': ';
				echo $input; 
			?>
			</p>
		</div>
	</div>
<?php } ?>