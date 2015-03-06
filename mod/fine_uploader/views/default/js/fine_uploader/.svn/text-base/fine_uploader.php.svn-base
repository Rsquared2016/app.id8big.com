<?php if (FALSE) { ?><script><?php } ?>

	elgg.provide('elgg.fine_uploader');

	elgg.fine_uploader.init = function() {

		// inserts the fine_uploader content into the textarea
		$(".fine_uploader-item").live('click', elgg.fine_uploader.insert);

		// caches the current textarea id
		$(".fine_uploader-control").live('click', function(event) {
            event.preventDefault();
            
			var classes = $(this).attr('class');
			var fine_uploaderClass = classes.split(/[, ]+/).pop();
			var textAreaId = fine_uploaderClass.substr(fine_uploaderClass.indexOf('fine_uploader-control-') + "fine_uploader-control-".length);
			elgg.fine_uploader.textAreaId = textAreaId;
            
		});

		// special pagination helper for lightbox
//	$('.fine_uploader-wrapper .elgg-pagination a').live('click', elgg.fine_uploader.forward);

//	$('.fine_uploader-section').live('click', elgg.fine_uploader.forward);

		$('.elgg-form-fine_uploader').live('submit', elgg.fine_uploader.submit);
	};

	elgg.fine_uploader.embedContent = function(content) {
		
	
		var textAreaId = elgg.fine_uploader.textAreaId;
		var textArea = $('#' + textAreaId);
		
		if (content.indexOf('thumbnail.php') != -1) {
			content = content.replace('size=small', 'size=medium');
		}

		textArea.val(textArea.val() + content);
		textArea.focus();

	<?php
// See the TinyMCE plugin for an example of this view
	echo elgg_view('tinymce/embed_custom_insert_js');
	?>

		$.fancybox.close();

		event.preventDefault();
	};

	/**
	 * Inserts data attached to an fine_uploader list item in textarea
	 *
	 * @todo generalize lightbox closing
	 *
	 * @param {Object} event
	 * @return void
	 */
	elgg.fine_uploader.insert = function(event) {
		

		// generalize this based on a css class attached to what should be inserted
		var content = ' ' + $(this).find(".fine_uploader-insert").parent().html() + ' ';

		// this is a temporary work-around for #3971
		elgg.fine_uploader.embedContent(content);
	};




	/**
	 * Submit an upload form through Ajax
	 *
	 * Requires the jQuery Form Plugin. Because files cannot be uploaded with
	 * XMLHttpRequest, the plugin uses an invisible iframe. This results in the
	 * the X-Requested-With header not being set. To work around this, we are
	 * sending the header as a POST variable and Elgg's code checks for it in
	 * elgg_is_xhr().
	 *
	 * @param {Object} event
	 * @return bool
	 */
	elgg.fine_uploader.submit = function(event) {
		$('.fine_uploader-wrapper .elgg-form-file-upload').hide();
		$('.fine_uploader-throbber').show();

		$(this).ajaxSubmit({
			dataType: 'json',
			data: {'X-Requested-With': 'XMLHttpRequest'},
			success: function(response) {

				if (response) {
					if (response.system_messages) {
						elgg.register_error(response.system_messages.error);
						elgg.system_message(response.system_messages.success);
					}
					if (response.status >= 0) {
//					var forward = $('input[name=fine_uploader_forward]').val();
//					var url = elgg.normalize_url('fine_uploader/tab/' + forward);
//					url = elgg.fine_uploader.addContainerGUID(url);
//					$('.fine_uploader-wrapper').parent().load(url);

						var output = ' ' + response.output + ' ';
						elgg.fine_uploader.embedContent(output);
					} else {
						// incorrect response, presumably an error has been displayed
						$('.fine_uploader-throbber').hide();
						$('.fine_uploader-wrapper .elgg-form-file-upload').show();
					}
				}
			},
			error: function(xhr, status) {
				// @todo nothing for now
			}
		});

		// this was bubbling up the DOM causing a submission
		event.preventDefault();
		event.stopPropagation();
	};

	/**
	 * Loads content within the lightbox
	 *
	 * @param {Object} event
	 * @return void
	 */
	elgg.fine_uploader.forward = function(event) {
		// make sure container guid is passed
		var url = $(this).attr('href');
		url = elgg.fine_uploader.addContainerGUID(url);

		$('.fine_uploader-wrapper').parent().load(url);
		event.preventDefault();
	};

	/**
	 * Adds the container guid to a URL
	 *
	 * @param {string} url
	 * @return string
	 */
	elgg.fine_uploader.addContainerGUID = function(url) {
		if (url.indexOf('container_guid=') == -1) {
			var guid = $('input[name=fine_uploader_container_guid]').val();
			return url + '?container_guid=' + guid;
		} else {
			return url;
		}
	};

	elgg.register_hook_handler('init', 'system', elgg.fine_uploader.init);
