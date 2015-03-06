elgg.provide('elgg.userprojectpicker');

/**
 * Userpicker initialization
 *
 * The userprojectpicker is an autocomplete library for selecting multiple users or
 * friends. It works in concert with the view input/userprojectpicker.
 *
 * @return void
 */
elgg.userprojectpicker.init = function() {
	
	// binding autocomplete.
	// doing this as an each so we can pass this to functions.
	$('.elgg-input-user-project-picker').each(function() {

		$(this).autocomplete({
			source: function(request, response) {

				var params = elgg.userprojectpicker.getSearchParams(this);
				
				elgg.get('projects/livesearch', {
					data: params,
					dataType: 'json',
					success: function(data) {
						response(data);
					}
				});
			},
			minLength: 2,
			html: "html",
			select: elgg.userprojectpicker.addUser
		})
	});

	$('.elgg-userprojectpicker-remove').live('click', elgg.userprojectpicker.removeUser);
};

/**
 * Adds a user to the select user list
 *
 * elgg.userprojectpicker.userList is defined in the input/userprojectpicker view
 *
 * @param {Object} event
 * @param {Object} ui    The object returned by the autocomplete endpoint
 * @return void
 */
elgg.userprojectpicker.addUser = function(event, ui) {
	var info = ui.item;

	// do not allow users to be added multiple times
	if (!(info.guid in elgg.userprojectpicker.userList)) {
		elgg.userprojectpicker.userList[info.guid] = true;
		var users = $(this).siblings('.elgg-user-picker-list');
		var li = '<input type="hidden" name="user_guid[]" value="' + info.guid + '" />';
		li += elgg.userprojectpicker.viewUser(info);
		$('<li>').html(li).appendTo(users);
	}

	$(this).val('');
	event.preventDefault();
};

/**
 * Remove a user from the selected user list
 *
 * @param {Object} event
 * @return void
 */
elgg.userprojectpicker.removeUser = function(event) {
	var item = $(this).closest('.elgg-user-picker-list > li');
	
	var guid = item.find('[name="user_guid[]"]').val();
	delete elgg.userprojectpicker.userList[guid];

	item.remove();
	event.preventDefault();
};

/**
 * Render the list item for insertion into the selected user list
 *
 * The html in this method has to remain synced with the input/userprojectpicker view
 *
 * @param {Object} info  The object returned by the autocomplete endpoint
 * @return string
 */
elgg.userprojectpicker.viewUser = function(info) {

	var deleteLink = "<a href='#' class='elgg-userprojectpicker-remove'>X</a>";

	var html = "<div class='elgg-image-block'>";
	html += "<div class='elgg-image'>" + info.icon + "</div>";
	html += "<div class='elgg-image-alt'>" + deleteLink + "</div>";
	html += "<div class='elgg-body'>" + info.name + "</div>";
	html += "</div>";
	
	return html;
};

/**
 * Get the parameters to use for autocomplete
 *
 * This grabs the value of the friends checkbox.
 *
 * @param {Object} obj  Object for the autocomplete callback
 * @return Object
 */
elgg.userprojectpicker.getSearchParams = function(obj) {
	var entity_guid = $(obj.element).data('entity-guid');
	return {'match_on[]': 'users', 'term' : obj.term, 'entity_guid': entity_guid};
	
};

elgg.register_hook_handler('init', 'system', elgg.userprojectpicker.init);