<?php

$status = $vars['value'];
$options_values = $vars['options_values'];

$status_txt = '';
if (isset($options_values[$status])) {
	$status_txt = $options_values[$status];	
}


if ($status_txt) {
?>


<div class="listingStatus">
	<div class="statusIcon <?php echo gtask_camelize_string($status, FALSE) ?>"></div>
	<div class="statusText"> <?php echo $status_txt?> </div>
</div>

<?php } ?>