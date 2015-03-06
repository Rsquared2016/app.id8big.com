<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$options_values = kt_generate_province_dropdown();

$vars['options_values'] = $options_values;

echo elgg_view('input/dropdown', $vars);
?>
<script type="text/javascript">	
jQuery(document).ready(function($) {
	var country_dropdown_change = function() {
		var element = $(this);
		var value = $(element).val();
		
		var state = $('.ktClassState');
		var city = $('.ktClassCity');
		
		if (value == "1") {
			if (state.length > 0) {
				$(state).show();
			}
			if (city.length > 0) {
				$(city).show();
			}
		}
		else {
			if (state.length > 0) {
				$(state).find('select[name=state] option:selected').removeAttr('selected');
				$(state).hide();
				$('select[name=state]').change();
			}
			if (city.length > 0) {
				$(city).find('select[name=city] option:selected').removeAttr('selected');
				$(city).hide();
			}
		}
		
	}
	
	$('select[name=country]').live('change', country_dropdown_change);
	
	$('select[name=country]').change();
});
</script>