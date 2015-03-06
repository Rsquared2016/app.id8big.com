<?php
$value = 0;

if (isset($vars['value'])) {
	$value = $vars['value'];
} 

$bdate = kt_retrieve_bdate_for_input($value);

$year_opt = array(
	'name' => 'bdate[y]',
	'value' => $bdate['y'],
	'options_values' => array('0' => elgg_echo("register_exteps:label:normal:year"))+kt_profile_get_years(),
	'class' => 'nmRig',
);
	
$month_opt = array(
	'name' => 'bdate[m]',
	'value' => $bdate['m'],
	'options_values' => array('0' => elgg_echo("register_exteps:label:month"))+kt_profile_get_months(),
);

$day_opt = array(
	'name' => 'bdate[d]',
	'value' => $bdate['d'],
	'options_values' => array('0' => elgg_echo("register_exteps:label:day"))+kt_profile_get_days(),
);

?>
<div class="ktBirthdateInput">
	<?php echo elgg_view('input/pulldown', $day_opt ) ?>
	<?php echo elgg_view('input/pulldown', $month_opt ) ?>
	<?php echo elgg_view('input/pulldown', $year_opt ) ?>
</div>


