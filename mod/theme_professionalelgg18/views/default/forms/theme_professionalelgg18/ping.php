<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div  class='keetup_ping'>&nbsp;</div>
<div class="pingContent">
	<div class='ContentWrapper'>
		<p>
			<?php echo elgg_echo('admin:appearance:theme:tabs:ping:description'); ?>
		</p>

		<p><?php echo elgg_echo('admin:appearance:theme:tabs:ping:description2'); ?> <small>(<?php echo elgg_echo('admin:appearance:theme:tabs:ping:description3'); ?>)</small>.<br /></p>
		<label>
			E-mail:
			<input type="text" name='email_address' value='' />
		</label>
		<div class='clearfloat'></div>
	</div>
</div>

<div class="elgg-foot">
	<?php
	echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('admin:appearance:theme:tabs:ping:ping')));
	?>
</div>