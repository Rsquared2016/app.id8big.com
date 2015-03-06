<?php
/**
 * Generic information for tabs
 */
$tab = $vars['tab'];


$user_type = get_input('user_type', US_USER);

$page_owner = page_owner();
if (!empty($page_owner)) {
	$user_type = kt_get_user_subtype($page_owner);
}

$title = elgg_echo("register_exteps:tab_info:{$tab}:title:{$user_type}");
$description = elgg_echo("register_exteps:tab_info:{$tab}:description:{$user_type}");
?>
<div class="regUsrInfo">
	<h3><?php echo $title; ?></h3>
	<div class="txt">
		<p><?php echo $description; ?></p>
	</div>
</div>