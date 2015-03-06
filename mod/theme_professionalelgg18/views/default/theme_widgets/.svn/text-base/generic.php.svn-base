<?php

/**
 * Widget Generic
 */

$plugin_to_check = $vars['module'];
$type = $vars['type'];
$subtype = $vars['subtype'];
$limit = $vars['num'];
$picture = $vars['picture'];
$view_type = $vars['view_type'];
$avoid_picture = $vars['avoid_picture'];
$max_cols = $vars['max_cols'];
$item_size = $vars['item_size'];
$max_length = $vars['max_length'];
$url_view_all = $vars['url_view_all'];

if (!$view_type) {
	$view_type = 'list';
}
if (!$limit) {
	$limit = 3;
}
if (!$max_cols) {
	$max_cols = 4;
}
if (!$item_size) {
	$item_size = 40;
}
if (!$picture) {
	$picture = 'object';
}
if (!$url_view_all) {
	$url_view_all = $vars['url'];
}
?>
<div class="sidebarBox <?php echo $plugin_to_check; ?>Box <?php echo $view_type; ?>Widget">
	<h3>
		<span class="txt"><?php echo elgg_echo('theme:widget:'.$plugin_to_check.':title'); ?></span>
		<a href="<?php echo $url_view_all; ?>" class="viewAll"><?php echo elgg_echo('theme:widget:view_all') ?></a>
		<span class="cThis"></span>
	</h3>
<?php
if ($plugin_to_check && $type) {
	if (elgg_is_active_plugin($plugin_to_check)) {
	    $offset = 0;
	    $options = array(
	    	'type' => $type,
	    	'subtype' => $subtype,
	    	'limit' => $limit,
	    	'offset' => $offset
	    );
	    $entities_count  = elgg_get_entities(array_merge($options, array('count' => TRUE)));
	    if ($entities_count > 0) {
?>
	    	<div class="sbbContents <?php echo $plugin_to_check; ?>BoxContents">
				<ul class="<?php echo ($view_type == 'list' ? 'blockItemsContainer' : ($view_type == 'gallery' ? 'ulGallery' : '')) ?> ">
		<?php
	    	$entities = elgg_get_entities($options);
    		$i_reset = 0;
            $i_row_count = 0;
            $i_max = $limit;
            $i_bottom_row = ceil($i_max / $max_cols);
            foreach ($entities as $entity) {
		    	$options_view = array();
		    	switch ($view_type) {
		    		case 'list':
				    	$options_view = array(
				    		'content' => $entity->description,
							'title' => $entity->name,
							'when' => elgg_view_friendly_time($entity->time_created),
							'owner' => $entity->getOwnerEntity(),
				    		'item_url' =>  $entity->getURL(),
				    		'max_length' => $max_length
				    	);
				    	if (!$avoid_picture) {
				    		switch ($picture) {
				    			case 'object':
						    		$icon = $entity->getIconURL();
				    				break;
				    			case 'owner':
				    				$icon = $entity->getOwnerEntity()->getIconURL();
				    				break;
				    		}
				    		if ($icon) {
				    			$options_view['picture'] = $icon;
				    		}
				    	}
		    			echo elgg_view('theme_widgets/item_list', $options_view);
		    			break;
		    		case 'gallery':
		    			$class = array();
		    			if ($i_reset == 0) {
		                    $i_row_count++;
		                }
		                $i_reset++;
		    			if ($i_reset == $max_cols) {
		    				$class[] = 'nmRig';
		    				$i_reset = 0;
		    			}
		    			if ($i_row_count == $i_bottom_row) {
		    				$class[] =  'nmBot';
		    			}
		    			if ($item_size) {
		    				$options_view['item_size'] = $item_size;
		    			}
		    			$options_view['class'] = implode(" ", $class);
		    			$defaul_elgg_size = 'small';
		    			if ($item_size > 40) {
		    				$defaul_elgg_size = 'normal';
		    			}
		    			if (is_callable(array($entity, 'getThumb'))) {
							$options_view['picture'] = $entity->getThumb(TRUE);
						} else {
							$options_view['picture'] = $entity->getIconURL($defaul_elgg_size);
						}
						
		    			$options_view['item_url'] = $entity->getURL();
		    			if ($entity instanceOf ElggObject) {
			    			$options_view['title'] = $entity->title;
		    			} else {
		    				$options_view['title'] = $entity->name;
		    			}
		    			$options_view['subtype'] = $vars['subtype'];
  						echo elgg_view('theme_widgets/item_gallery', $options_view);
		    			break;
		    	} //switch ($view_type) {
		    } //foreach ($entities as $entity) {
?>
				</ul>
			</div>
<?php
	    } else {
	    	echo "<div class=\"contentWrapper\"><p>" . elgg_echo('theme:widget:noitems') . "</p></div>";
	    }
	} else {
		echo "<div class=\"contentWrapper\"><p>" . sprintf(elgg_echo("theme:widget:notpluginactivated"), $plugin_to_check) . ".</p></div>";
	}
} else {
	echo "<div class=\"contentWrapper\"><p>" . elgg_echo('theme:widget:missingparams') . ".</p></div>";
}
?>
</div>