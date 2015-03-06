<?php
	//var_dump($vars['body']);
	$admin_areas = $vars['admin_areas'];
	$current_area = $vars['current_area'];
	
?>
	<div class="contentWrapper">
<?php 
	if ($admin_areas) {
?>
	<div id="elgg_horizontal_tabbed_nav">
		<ul class="elgg-tabs elgg-htabs">
<?php 
			foreach($admin_areas as $area) {
				$url = "{$vars['url']}admin/administer_utilities/keetup_categories?tab=$area";
				$class = ($current_area == $area) ? 'class=" elgg-state-selected"' : '';  
?>		
				<li <?php echo $class; ?>>
					<a href="<?php echo $url ?>"><?php echo elgg_echo("keetup_categories:admin:$area"); ?></a>
				</li>
<?php 
			}
?>			
		</ul>
	</div>
<?php
	}
	//Content
	echo $vars['body'];
?>
	</div>