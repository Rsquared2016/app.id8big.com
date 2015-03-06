<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<p>
	<?php echo elgg_echo('register_exteps:settings:gatekeeper'); ?>
	<select name="params[open_registration]">
		<option value="yes" <?php if ($vars['entity']->open_registration == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->open_registration != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>
</p>

<p>
	<?php echo elgg_echo('register_exteps:settings:dev_mode'); ?>
	<select name="params[dev_mode]">
		<option value="yes" <?php if ($vars['entity']->dev_mode == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->dev_mode != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>
</p>
<p><?php echo elgg_echo('register_exteps:settings:dev_mode:info'); ?></p>