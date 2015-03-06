<?php
$entity = elgg_extract('entity', $vars, FALSE);
if (empty($entity)) {
	$entity = elgg_get_page_owner_entity();
}

$context = elgg_get_context();

$user_timezone = elgg_timezone_get_timezone_user($entity);
$user_timezone_group = elgg_timezone_get_timezone_user_group($entity);

if ($context == 'register' && isset($_SESSION['sticky_forms']['register'])) {
    $user_timezone_group = elgg_extract('user_timezone_group', $_SESSION['sticky_forms']['register'], $user_timezone_group);
}

if ($user_timezone_group == 'united_states') {
    $user_timezone_options = elgg_timezone_get_timezones(TRUE, TRUE);
}
else {
    $user_timezone_options = elgg_timezone_get_timezones(TRUE);
}

if (empty($user_timezone) && $context == 'register' && isset($_SESSION['sticky_forms']['register'])) {
    $user_timezone = elgg_extract('user_timezone', $_SESSION['sticky_forms']['register'], '');
}

$input_user_timezone_group = elgg_view('input/dropdown', array(
    'name' => 'user_timezone_group',
    'id' => 'user_timezone_group',
    'options_values' => elgg_timezone_get_timezones_group(),
    'value' => $user_timezone_group,
));
$input_user_timezone = elgg_view('input/dropdown', array(
    'name' => 'user_timezone',
    'id' => 'user_timezone',
    'options_values' => $user_timezone_options,
    'value' => $user_timezone,
));

//user_timezone
$input_united_states = elgg_view('input/dropdown', array(
    'id' => 'united_states',
    'options_values' => elgg_timezone_get_timezones(TRUE, TRUE),
//    'value' => $value,
    'class' => 'hidden',
));
$input_all_the_world = elgg_view('input/dropdown', array(
    'id' => 'all_the_world',
    'options_values' => elgg_timezone_get_timezones(TRUE),
//    'value' => $value,
    'class' => 'hidden',
));

if ($context == 'register') {
	?>
	<div class="rFrm timezoneSelectable clearfix mandatory">
		<label for=""><?php echo elgg_echo('events:register:timezone:label') ?>*</label>
		<?php
            echo $input_user_timezone_group;
            echo $input_user_timezone;
            echo $input_united_states;
            echo $input_all_the_world;
        ?>
	</div>
<?php } else { ?>
	<div class="elgg-module elgg-module-info mandatory">
		<div class="elgg-head">
			<h3><?php echo elgg_echo('events:register:timezone:label') ?></h3>
		</div>
		<div class="elgg-body rFrmSet">
			<label class="flLef"><?php echo elgg_echo('events:timezone:pulldown:help:label').': '; ?></label>
            <?php
                echo $input_user_timezone_group;
                echo $input_user_timezone;
                echo $input_united_states;
                echo $input_all_the_world;
            ?>
            <div class="clearfloat"></div>
		</div>
	</div>
<?php } ?>
