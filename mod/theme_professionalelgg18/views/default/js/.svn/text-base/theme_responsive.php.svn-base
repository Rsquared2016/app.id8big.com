<?php
/*
 * Responsive JS
 */
?>
//<script>
	/**
	 * Responsive main js
	 */
	elgg.provide('elgg.responsive');

	elgg.responsive.init = function() {
		elgg.responsive.section_menu();
	};

	elgg.responsive.section_menu = function() {
        
        // Destroy datepickers
        $('.elgg-input-date').datepicker('destroy');
        
		var sidebar = $('.sideBarsContainer');
        
		if (typeof(sidebar) === 'undefined' || sidebar.length === 0) {
			sidebar = $('.elgg-admin-sidebar-menu');
			
			if (typeof(sidebar) === 'undefined' || sidebar.length === 0) {
				return false;
			}
			
			var the_html = sidebar.html();
		} else {
			var the_html = sidebar.find('.elgg-sidebar').html();
		}

		if (the_html && the_html.length) {

			var section_menu = $('.subMnCont .h2titleShowSidebar').length;
			var wrapper = $('.mainContentsTitle').find('.elgg-sidebar');

			wrapper.html(the_html);
            
            // Change ids to datepickers
            var datepickers = $(wrapper).find('.elgg-input-date');
            if (datepickers.length) {
                var i = 1;
                $.each(datepickers, function(index, value) {
                    var id = $(value).attr('id');
                    id = id + '_' + i;
                    $(value).attr('id', id);
                    i++;
                });
            }
		}
        
        // Init datepickers
        elgg.ui.initDatePicker();

	};

	elgg.register_hook_handler('init', 'system', elgg.responsive.init);
