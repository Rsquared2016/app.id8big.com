elgg.provide('elgg.kt_polls');

elgg.kt_polls.init = function() {
	elgg.kt_polls.drawProgressBar();
};

elgg.kt_polls.drawProgressBar = function() {
	var $polls_results = $('.pollResults');
	
	if (typeof($polls_results) && $polls_results.length > 0) {
		$polls_results.each(
				function() {
					var p_res = $(this);
					var items_poll = p_res.find('.percentBar');
					var item_width = items_poll.width();
					var this_inner = null;
					var this_inner_perc = 0;
					var this_inner_perc_px = 0;
					var anim_time = 100;

					items_poll.each(
							function() {
								this_inner = $(this).find('.percentBarInner');
								this_inner_perc = parseFloat(this_inner.attr('title'));
								this_inner_perc_px = this_inner_perc * item_width / 100;

								if (this_inner_perc_px > 0) {
									this_inner.animate({'width': this_inner_perc_px}, anim_time);
								}

							}
					);
				}
		);
	}
}





/**
 * jQuery(document).ready(function($) {
 //$('.pollVoteWidget form').live('submit', function(e) {
 $(document).delegate('.pollVoteWidget form', 'submit', function(e) {
 var form = $(this);
 var url = $(this).attr('action');
 var data = $(this).serialize();
 
 var parentWrapper = $(this).parents('.pollWidgetWrapper');
 var errorMsgWrapper = $('.pollWidgetWrapperMsg', $(parentWrapper));
 //Display loading.
 elgg.ui.setLoadingStatus(1, form);
 
 $.post(
 url,
 data,
 function(response) {
 if(response.status == 0) {
 //Replace content with html.
 if(response.output) {
 $(parentWrapper).html(response.output);
 }
 } else {
 if (elgg.isEmpty(response.system_messages.errors) == false) {
 elgg.register_error_to_element(response.system_messages.errors, 5000, errorMsgWrapper);
 }
 }
 
 //Hide loading.
 elgg.ui.setLoadingStatus(0, form);
 }
 );
 
 e.preventDefault();
 });
 
 $('.txtCustomRadio').click(
 function() {
 if ($.browser.msie && $.browser.version == "7.0") {
 $(this).prev('.spanRadio').find('input').click();
 }
 }
 );
 
 });
 */



elgg.register_hook_handler('init', 'system', elgg.kt_polls.init);
