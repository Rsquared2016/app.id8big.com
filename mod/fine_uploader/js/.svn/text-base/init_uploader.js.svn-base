/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

elgg.provide('elgg.fine_uploader');

elgg.fine_uploader.init = function() {
    
    var action_uploader = elgg.config.wwwroot+'action/fine_uploader/images';
    action_uploader = elgg.security.addToken(action_uploader);
    
    var upload_guid = $('#fine_uploader_element').data('upload-guid');
    var data_associate_guid = $('#fine_uploader_element').data('associate-guid');
    
    var uploader = new qq.FileUploader({
	    element: document.getElementById('fine_uploader_element'),
	    action: action_uploader,
	    params: {guid_one: upload_guid, guid_two: data_associate_guid},
	    inputName: 'upload',
	    debug: true,
	    forceMultipart: true
	});
};

elgg.register_hook_handler('init', 'system', elgg.fine_uploader.init);