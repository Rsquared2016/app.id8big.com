<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$options_values = kt_generate_city_dropdown();

$vars['options_values'] = $options_values;

$value = $vars['value'];

echo elgg_view('input/dropdown', $vars);
?>
<script type="text/javascript">	
jQuery(document).ready(function($) {
	var state_dropdown_change = function() {
		<?php
			$get_cities_ajax_url = 'mod/register_exteps/endpoint/get_cities.php';
			$get_cities_ajax_url = elgg_http_add_url_query_elements($get_cities_ajax_url);
		?>
		
		var get_cities_ajax_url = '<?php echo $get_cities_ajax_url ?>';
		
		var element = $(this);
		var form = element.parents('form');
		
		var city_dropdown = $('select[name=city]');
		
		elgg.get(get_cities_ajax_url, {
			data: form.serialize(),
			success: function(data) {
				if (data) {
					city_dropdown.replaceWith(data);
					
					<?php if ($value) { ?>
						$('select[name=city] option[value=<?php echo $value; ?>]').attr('selected', 'selected');
					<?php } ?>
				}
			}
		});
	}
	
	$('select[name=state]').live('change', state_dropdown_change);
	
	$('select[name=state]').change();
});
</script>