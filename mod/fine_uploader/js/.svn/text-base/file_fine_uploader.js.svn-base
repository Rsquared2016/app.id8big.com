/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

elgg.provide('elgg.fine_uploader');

elgg.fine_uploader.init = function() {

	elgg.fine_uploader_generate_inputs();

};

elgg.fine_uploader_generate_inputs = function() {
	var action_uploader = elgg.config.wwwroot + 'ajax/view/fine_uploader/upload_action';
	action_uploader = elgg.security.addToken(action_uploader);

	var fine_uploaders = $('div[data-uploadtype=fine]');
	
	if (typeof(fine_uploaders) === 'undefined' || fine_uploaders.length === 0) {
		return false;
	}

	$(fine_uploaders).each(function() {
		var element = $(this);
		var raw_element = this;

		var uploader = new qq.FileUploader({
			element: document.getElementById(element.attr('id')),
			action: action_uploader,
			params: {},
			template: '<div class="qq-uploader">' +
					'<div class="qq-upload-drop-area"><span>' + elgg.echo("Drop the file here") + '</span></div>' +
					'<div class="fineUploaderBtn btn elgg-button" style="width: auto;">' + elgg.echo("Choose File") + '</div><span class="spUploadOpenTokButton"> ' + elgg.echo("Or drag the file here") + '</span>' +
					'<ul class="qq-upload-list" style="margin-top: 10px; text-align: center;"></ul>' +
					'</div>',
			classes: {
				button: 'fineUploaderBtn',
				drop: 'qq-upload-drop-area',
				dropActive: 'qq-upload-drop-area-active',
				dropDisabled: 'qq-upload-drop-area-disabled',
				list: 'qq-upload-list',
				progressBar: 'qq-progress-bar',
				file: 'qq-upload-file',
				spinner: 'qq-upload-spinner',
				finished: 'qq-upload-finished',
				size: 'qq-upload-size',
				cancel: 'qq-upload-cancel',
				failText: 'qq-upload-failed-text',
				success: 'alert alert-success',
				fail: 'alert alert-error',
				successIcon: null,
				failIcon: null
			},
			inputName: element.data('name'),
			debug: true,
			forceMultipart: true,
			multiple: false,
			uploadButtonText: 'Choose Image',
			onComplete: elgg.fine_uploader.onComplete
		})
	});

};

elgg.fine_uploader.onComplete = function(id, fileName, responseJSON) {
	
	var element = $(this._element);
	if (responseJSON.result) {

		var input_hidden = $('input[name=file_result]');
		if (input_hidden.length === 0) {
			input_hidden = $('<input/>');
			input_hidden.attr('type', 'hidden');
			input_hidden.attr('name', 'file_result');
		}

		input_hidden.val(responseJSON.result);

		element.after(input_hidden);
	}
};

elgg.register_hook_handler('init', 'system', elgg.fine_uploader.init);