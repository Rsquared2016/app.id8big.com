<?php

/*
 * Register info
 */

?>
<div class="registerInfo nm">
	<h3><?php echo elgg_echo('register_exteps:register:info:title'); ?></h3>
	<ul>
		<?php
			for ($i = 1; $i < 6; $i++) {
		?>
		<li><b><?php echo $i; ?>.</b> <?php echo elgg_echo('register_exteps:register:info:'.$i); ?></li>
		<?php
			}
		?>
	</ul>
</div>
