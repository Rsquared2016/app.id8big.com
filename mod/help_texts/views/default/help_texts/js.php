
elgg.provide('elgg.help_texts');

elgg.help_texts.init = function() {
	// append the title to the url
	var title = document.title;
	var e = $('a.elgg-help_text-page');
	var link = e.attr('href') + '&title=' + encodeURIComponent(title);
	e.attr('href', link);
};

elgg.register_hook_handler('init', 'system', elgg.help_texts.init);
