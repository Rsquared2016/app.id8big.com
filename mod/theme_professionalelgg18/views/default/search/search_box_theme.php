<?php
/**
 * Search box
 *
 * @uses $vars['value'] Current search query
 * @uses $vars['class'] Additional class
 */

if(!elgg_is_active_plugin('search')) {
	return true;
}

$input_expandable = true;	// enable / disable text input resizing

if (array_key_exists('value', $vars)) {
	$value = $vars['value'];
}
elseif ($value = get_input('q', get_input('tag', NULL))) {
	$value = $value;
}
else {
	$value = elgg_echo('search');
}

$class = "elgg-search";
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}
if($input_expandable) {
	$class .= " expandableSearch";
}

// @todo - why the strip slashes?
$value = stripslashes($value);

// @todo - create function for sanitization of strings for display in 1.8
// encode <, >, &, quotes and characters above 127
if (function_exists('mb_convert_encoding')) {
	$display_query = mb_convert_encoding($value, 'HTML-ENTITIES', 'UTF-8');
}
else {
	// if no mbstring extension, we just strip characters
	$display_query = preg_replace("/[^\x01-\x7F]/", "", $value);
}
$display_query = htmlspecialchars($display_query, ENT_QUOTES, 'UTF-8', false);

?>
<form class="<?php echo $class; ?> flLef" action="<?php echo elgg_get_site_url(); ?>search" method="get">
	<div class="icoSrchTop headerSubSectSH headerSubSectItemsSH"></div>
	<div class="srchItemsResponsive headerSubSectItem">
		<input type="text" class="search-input flLef" size="21" name="q" value="<?php echo $display_query; ?>" onblur="if (this.value == '') { this.value = '<?php echo elgg_echo('search'); ?>' }" onfocus="if (this.value == '<?php echo elgg_echo('search'); ?>') { this.value = '' };" />
		<input type="submit" value="<?php echo elgg_echo('search:go'); ?>" class="elgg-button-submit elgg-button flLef" />
		<input type="hidden" name="search_type" value="all" />
		<div class="clearfloat"></div>
	</div>
</form>
<?php
	if($input_expandable) {
?>
<script type="text/javascript">
	$(document).ready(
		function() {
		
			var search_text_input = $('.expandableSearch input[type="text"]');
		
			var max_input_w = 180;
			var min_input_w = search_text_input.width();
			var animation_time = 500;
			
			search_text_input.focus(
				function() {
					$(this).animate({ 'width' : max_input_w + 'px'}, animation_time);
				}
			);
			search_text_input.blur(
				function() {
					$(this).stop(true, true).animate({ 'width' : min_input_w + 'px'}, animation_time);
				}
			);
		}
	);
</script>
<?php
	}
?>