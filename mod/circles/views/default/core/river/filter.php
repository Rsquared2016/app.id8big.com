<?php
/**
 * Content filter for river
 *
 * @uses $vars[]
 */

$user_loggedin = elgg_get_logged_in_user_entity();
if (!$user_loggedin) {
	return false;
}

// Get circles
$options_circles = array(
	elgg_echo('circles:riverdashboard:circles:options:all') => 'all',
	elgg_echo('circles:riverdashboard:circles:options:mine') => 'mine',
	elgg_echo('circles:riverdashboard:circles:options:friends') => 'friends',
);
$circles = get_user_access_collections($user_loggedin->getGUID());
if ($circles) {
	foreach ($circles as $c) {
		$options_circles[$c->name] = $c->id;
	}
}

// Get types
$options_types = array(
	elgg_echo('all') => 'all',
);
if (!empty($vars['config']->registered_entities)) {
	foreach ($vars['config']->registered_entities as $type => $ar) {
		if (empty($vars['config']->registered_entities[$type])) {
			$keyname = 'item:' . $type;
			$keyname = elgg_echo($keyname);
			$options_types[$keyname] = "{$type}";
		}
		else {
			foreach ($vars['config']->registered_entities[$type] as $object) {
				if (!empty($object)) {
                    if ($object != 'gcalendar') {
                        $keyname = 'item:' . $type . ':' . $object;
                    }
				} else {
					$keyname = 'item:' . $type;
				}
				$keyname = elgg_echo($keyname);
				$options_types[$keyname] = "{$type}-{$object}";
			}
		}
	}
}
ksort($options_types);

// Get circles selected
$page_type = get_input('page_type', 'all');
if ($page_type == 'circles') {
	$value_circle = get_input('circle_id', 0);
}
else {
	$value_circle = $page_type;
}
// Get type selected
$type = get_input('type', 'all');
$subtype = get_input('subtype', '');
$value_type = $type;
if ($subtype) {
	$value_type .= '-'.$subtype;
}
?>
<div class="riverdashboardFilter">
	<div class="circlesAjaxLoader"></div>
	<div class="rdfTitle"><?php echo elgg_echo('circles:riverdashboard:filter'); ?></div>
	<div class="rdfMn">
		<div class="rdfMnInner">
			<?php
				if (!empty($options_circles)) {
			?>
			<div class="filterInnerGroup figBB">
				<h4><?php echo elgg_echo('circles:riverdashboard:circles:title'); ?></h4>
				<?php
						echo elgg_view('input/radio_2', array(
														'name' => 'filter_circles',
														'options' => $options_circles,
														'value' => $value_circle));
					}
					
					if (!empty($options_types)) {
				?>
				<div class="clearfloat"></div>
			</div>
			<div class="filterInnerGroup">
				<h4><?php echo elgg_echo('circles:riverdashboard:type:title'); ?></h4>
				<?php
						echo elgg_view('input/radio_2', array(
														'name' => 'filter_types',
														'options' => $options_types,
														'value' => $value_type));
					}
				?>
				<div class="clearfloat"></div>
			</div>
		</div>
	</div>
	<div class="rdfLine"></div>
</div>
<script type="text/javascript">
	$(document).ready(
		function() {
			/* for css */
			
		}
	);
</script>
<?php
?>