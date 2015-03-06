<?php
/**
 * Elgg dropdown input
 * Displays a dropdown (select) input field
 *
 * @warning Default values of FALSE or NULL will match '' (empty string) but not 0.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value']          The current value, if any
 * @uses $vars['options']        An array of strings representing the options for the dropdown field
 * @uses $vars['options_values'] An associative array of "value" => "option"
 *                               where "value" is the name and "option" is
 * 								 the value displayed on the button. Replaces
 *                               $vars['options'] when defined.
 * @uses $vars['class']          Additional CSS class
 */

$class = "elgg-input-button-dropdown btn-group";
if (isset($vars['class'])) {
	$vars['class'] = "$class {$vars['class']}";
} else {
	$vars['class'] = $class;
}

$link_class = 'btn dropdown-toggle ';
if (isset($vars['link_class'])) {
	$link_class .= $vars['link_class'];
}
$defaults = array(
	'text' => 'Action', //Btn Name
	'value' => '',
	'options_values' => array(),
);

$vars = array_merge($defaults, $vars);

$options_values = $vars['options_values'];
unset($vars['options_values']);


$text = $vars['text'];
unset($vars['text']);

$value = $vars['value'];
unset($vars['value']);

?>
<div <?php echo elgg_format_attributes($vars); ?>>
  <a class="<?php echo $link_class; ?>" data-toggle="dropdown" href="#">
    <?php echo $text; ?>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
	<?php
	if ($options_values) {
		foreach ($options_values as $opt_value => $option) {
			$option_attrs = '';
			
			if(is_array($option)) {
				if($option['item_options']) {
					$option_attrs = elgg_format_attributes($option['item_options']);
				}
				if($option['link']) {
					$link = $option['link'];
				}
			} else {
				$link = $option;
			}

			echo "<li $option_attrs>$link</li>";
		}
	}
	?>	
  </ul>
</div>