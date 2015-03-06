<?php

/*
 * Widget: firts_steps
 */
if (SHOW_USER_PROGRESS_WIDGET == FALSE) {
    return;
}

if (!elgg_in_context('register_ex') && !elgg_in_context('activity')) {
	return TRUE;
}


$profile_complete = new ProfileComplete;
if (!($profile_complete instanceof ProfileComplete)) {
	return false;
}

$load_image = $profile_complete->loadedImage();
$load_basic_data =$profile_complete->loadedBasicData();
$has_dni = $profile_complete->loadedDni();
$added_obra = $profile_complete->loadedObra();

// Si completo todos los pasos, no se muestra el widget
if ($load_image &&
	$load_basic_data &&
	$added_obra
	) {
	return true;
}

$user = elgg_get_logged_in_user_entity();

?>
<div class="sidebarBox registerExtepsBox">
	<h3><?php echo elgg_echo('welcome_site:widgets:first_steps:title'); ?></h3>
	<div class="search_listing_first_steps">
			<?php
			// Obtengo el porcentaje de completado
			$percentage = $profile_complete->getPercentageCompleted();
		?>
		<div class="progressbar">
			<div class="progressInner porc<?php echo $percentage; ?>"></div>
		</div>
		<script type="text/javascript">
			$(document).ready(
				function() {
					$('.progressInner').animate({'width': '<?php echo $percentage; ?>%'}, 2000);
				}
			);
		</script>
		<ul class="listFirstSteps">
			<li class="stepComplete">
				<a href="#">
					<?php echo elgg_echo('welcome_site:widgets:first:steps:register'); ?>
				</a>
			</li>
			<li class="<?php if ($load_image) { echo "stepComplete"; } ?>">
				<a href="<?php if ($load_image) { echo '#'; } else { echo $vars['url'].'avatar/edit/'.$user->username; } ?>">
					<?php echo elgg_echo('welcome_site:widgets:first:steps:edit:icon'); ?>
				</a>
			</li>
			<li class="<?php if ($load_basic_data) { echo "stepComplete"; } ?>">
				<a href="<?php if ($load_basic_data) { echo '#'; } else { echo $vars['url'].'profile/'.$user->username.'/edit/'; } ?>">
					<?php echo elgg_echo('welcome_site:widgets:first:steps:basic:data'); ?>
				</a>
			</li>
			<li class="<?php if ($has_dni) { echo "stepComplete"; } ?>">
				<a href="<?php if ($has_dni) { echo '#'; } else { echo $vars['url'].'settings/'; } ?>">
					<?php echo elgg_echo('welcome_site:widgets:first:steps:dni'); ?>
				</a>
			</li>
			<li class="<?php if ($added_obra) { echo "stepComplete"; } ?>">
				<a href="<?php if ($added_obra) { echo '#'; } else { echo $vars['url'].'obras/add/'; } ?>">
					<?php echo elgg_echo('welcome_site:widgets:first:steps:add:obra'); ?>
				</a>
			</li>
		</ul>
		<div class="clearfloat"></div>
	</div>
</div>