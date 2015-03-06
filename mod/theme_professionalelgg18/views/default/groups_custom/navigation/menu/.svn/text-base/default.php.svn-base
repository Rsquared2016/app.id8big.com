<?php
/**
 * Default menu
 *
 * @uses $vars['name']                 Name of the menu
 * @uses $vars['menu']                 Array of menu items
 * @uses $vars['class']                Additional CSS class for the menu
 * @uses $vars['item_class']           Additional CSS class for each menu item
 * @uses $vars['show_section_headers'] Do we show headers for each section?
 */

$entity = elgg_extract('entity', $vars);
if (!elgg_instanceof($entity, 'group')) {
	return false;
}

// we want css classes to use dashes
$vars['name'] = preg_replace('/[^a-z0-9\-]/i', '-', $vars['name']);
$headers = elgg_extract('show_section_headers', $vars, false);
$item_class = elgg_extract('item_class', $vars, '');

$class = "elgg-menu elgg-menu-{$vars['name']}";
if (isset($vars['class'])) {
	$class .= " {$vars['class']}";
}

$menu = array();
foreach ($vars['menu'] as $section => $menu_items) {
	foreach($menu_items as $item) {
		$menu[] = $item;
	}
}

// Si tengo mas de una opcion, muestro un dropdown
if (count($menu) > 1) {
	// Dropdown options
	$dropdown_options = array();
	
	foreach($menu as $item) {
		$name = $item->getName();
		$text = $item->getText();
		$href = $item->getHref();
		
		$button = elgg_view('output/url', array(
			'text' => $text,
			'href' => $href,
		));
		
		$dropdown_options[] = $button;
	}

	if (empty($dropdown_options)) {
		return false;
	}
	?>
	<?php
		// Dropdown options
	?>
	<div class="btn-group flRig btnTopCtrl">
	  <button data-toggle="dropdown" class="btn dropdown-toggle"><?php echo elgg_echo('theme:groups:button:action'); ?><span class="caret"></span></button>
	  <ul class="dropdown-menu">
		  <?php 
		  foreach($dropdown_options as $key => $val) {
		  ?>
			<li><?php echo $val; ?></li>
		  <?php
		  }
		  ?>
	  </ul>
	</div>
<?php
}
else {
	$section = 'default';
	echo elgg_view('navigation/menu/elements/section', array(
			'items' => $menu,
			'class' => "$class elgg-menu-{$vars['name']}-$section",
			'section' => $section,
			'name' => $vars['name'],
			'show_section_headers' => $headers,
			'item_class' => $item_class,
		));
}