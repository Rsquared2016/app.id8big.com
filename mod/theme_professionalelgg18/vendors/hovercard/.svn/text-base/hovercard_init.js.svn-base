jQuery(document).ready(function($) {
	// Code using $ as usual goes here.
	
	var hovercards = $('.userHoverCard');
	if (hovercards.length > 0) {
		hovercards.each(function() {
			
			var element = $(this);
			var user_id = element.attr('data-hover-id');
			
			var hovercard_info = $('.hovercardInfo[data-hover-info='+user_id+']');
			if (hovercard_info.length > 0) {
				
				var hovercard_html = hovercard_info.html();
				
				$(element).qtip({
					
					content: hovercard_html,
					
					style: {
						classes: 'ui-tooltip-light ui-tooltip-shadow userHoverQtip', // Optional shadow...
						widget: false, // Removes the jQuery UI widget classes from the tooltip elements, preventing Themeroller styling
						def: false // Remove the default styling (not usually necessary)
					},
					
					hide: {
						target: $(document.body).children().not( $(self) ), //Hide if click out of the qtip
						event: 'mousedown'
					},
					
					show: {
						delay: 300
					}
					
					
				});
				
			}
			
		});
	}
	
});