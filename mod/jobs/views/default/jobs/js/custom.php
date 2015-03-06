<?php
/*
 * CUSTOM JS
 */
?>
<script type="text/javascript">
	
	function freelance_remove_required_location(element) {

		if (element.val() == 'freelance') {
			$('.locationWrapper span.required').hide();
		} else {
			$('.locationWrapper span.required').show();
		}
	}
	
	jQuery(document).ready(function($) {
		// Code using $ as usual goes here.
		if(typeof($.fancybox) =='function') {
			$('#apply_job_button').fancybox({

			});
		}
		
		$('.ktFormjobs input[name=job_type]').live('change', function() {
			freelance_remove_required_location($(this));
		});
		
		var freelance_input = $('.ktFormjobs input[name=job_type]:checked');
		
		if (typeof(freelance_input) != 'undefined' && freelance_input.length > 0) {
			
			freelance_remove_required_location(freelance_input);
		}
		
	});
</script>