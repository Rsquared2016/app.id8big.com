<?php
//Get the categories.
$categories = JobsSettings::getCategoriesRaw();
?>
<div>
	<label>
		<span class='flLef'>
			<?php echo elgg_echo('jobs:simpletypes:types:options') ?>:
		</span> 
		<span class='flRig'>
			<textarea cols='50' rows='20' name="jobs_categories"><?php echo $categories ?></textarea>
			<small><?php echo elgg_echo('jobs:simpletypes:types:options:tip') ?></small>
		</span>	
	</label>
</div>
<div class='cThis'></div>
<div class="elgg-foot">
<?php 
//Submit
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('save')));
?>
</div>
