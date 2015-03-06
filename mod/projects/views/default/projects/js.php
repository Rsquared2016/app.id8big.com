<?php
/**
 * Javascript for Projects forms
 *
 * @package ElggProjects
 */
?>
// this adds a class to support IE8 and older
elgg.register_hook_handler('init', 'system', function() {
	// jQuery uses 0-based indexing
	$('#projects-tools').children('li:even').addClass('odd');
	
	$('.preview-welcome-message').click(function(event) {
		event.preventDefault();
		
		tinyMCE.triggerSave();
		
		var content = $('#welcome_message').val();
		var fancybox_content = '<div class="projectsWelcomeMessageContent">';
		fancybox_content += content;
		fancybox_content += '</div>';
		
		$.fancybox({
			content: fancybox_content
		});
	});
    
    $('a.js_projects_search').live('click touchend', function(event) {
        event.preventDefault();
        
        $('form.elgg-form-projects-find .elgg-input-search').focus();
    });
});
