<?php
/**
 * Javascript used for the filter
 */
?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var element_id = '#filter_keetup_category';
		
		$(element_id).change(function(e) {
			var searched = document.location.search;
			var filter_query = '?filter_by='+$(this).val();
			var new_url = document.location.href.replace(searched, '')+filter_query;
			
			window.location.href = new_url;
		});
	});
</script>
