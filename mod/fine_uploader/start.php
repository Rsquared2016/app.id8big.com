<?php

/**
 * Fine uploader plugin
 *
 * @package FineUploader
 */
elgg_register_event_handler('init', 'system', 'fine_uploader_init');

/**
 * Fine Uploader plugin initialization functions.
 */
function fine_uploader_init() {
    elgg_register_js('fine_uploader', 'mod/fine_uploader/vendors/fine_uploader/client/fileuploader.js');
    elgg_register_css('fine_uploader', 'mod/fine_uploader/vendors/fine_uploader/client/fileuploader.css');

    elgg_register_js('fine_uploader_init', 'mod/fine_uploader/js/init_uploader.js');
    elgg_register_js('file_fine_uploader', 'mod/fine_uploader/js/file_fine_uploader.js');

    elgg_register_action('fine_uploader/images', dirname(__FILE__) . '/actions/uploader/images.php');

    elgg_register_ajax_view('fine_uploader/upload_action');

    elgg_register_plugin_hook_handler('action', 'file/upload', 'fine_uploader_hack_files_action');

    elgg_register_plugin_hook_handler('register', 'menu:longtext', 'fine_uploader_embed_longtext_menu');


    elgg_extend_view('css/elgg', 'fine_uploader/css');

    elgg_register_plugin_hook_handler('register', 'menu:longtext', 'fine_uploader_longtext_menu');
    elgg_register_plugin_hook_handler('register', 'menu:fine_uploader', 'fine_uploader_select_tab', 1000);

    // Page handler for the modal media fine_uploader
    elgg_register_page_handler('fine_uploader', 'fine_uploader_page_handler');

    elgg_extend_view('js/elgg', 'js/fine_uploader/fine_uploader');

    elgg_load_js('jquery.form');
    elgg_load_js('fine_uploader');
    elgg_load_css('fine_uploader');
    elgg_load_js('file_fine_uploader');
    
//    elgg_load_js('fine_uploader_init');
}

/**
 * Returns an overall file type from the mimetype
 *
 * @param string $mimetype The MIME type
 * @return string The overall type
 */
function fine_file_get_simple_type($mimetype) {

    switch ($mimetype) {
        case "application/msword":
        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            return "document";
            break;
        case "application/pdf":
            return "document";
            break;
        case "application/ogg":
            return "audio";
            break;
    }

    if (substr_count($mimetype, 'text/')) {
        return "document";
    }

    if (substr_count($mimetype, 'audio/')) {
        return "audio";
    }

    if (substr_count($mimetype, 'image/')) {
        return "image";
    }

    if (substr_count($mimetype, 'video/')) {
        return "video";
    }

    if (substr_count($mimetype, 'opendocument')) {
        return "document";
    }

    return "general";
}

function fine_uploader_hack_files_action($hook, $type, $return, $params) {
    $file_result = get_input('file_result');
    if (empty($file_result)) {
        return $return;
    }

    $file_names = explode(',', $file_result);
    $filename = $file_names[0];
    $realname = $file_names[1];

    $tmp_folder = elgg_get_data_path() . 'file_tmp/';

    $filename = $tmp_folder . $filename;
    if (FALSE == file_exists($filename)) {
        return $return;
    }

    $_FILES['upload'] = array(
        'error' => 0,
        'name' => $realname,
        'size' => filesize($filename),
        'tmp_name' => $filename,
        'type' => mime_content_type($filename),
    );

    if (array_key_exists('file', $_FILES)) {
        unset($_FILES['file']);
    }
}

function fine_uploader_embed_longtext_menu() {
    elgg_load_js('fine_uploader');
    elgg_load_css('fine_uploader');
    elgg_load_js('file_fine_uploader');
}

/**
 * Add the fine_uploader menu item to the long text menu
 *
 * @param string $hook
 * @param string $type
 * @param array $items
 * @param array $vars
 * @return array
 */
function fine_uploader_longtext_menu($hook, $type, $items, $vars) {


    if (elgg_get_context() == 'fine_uploader') {
        return $items;
    }

    //disable the comments on lean canvas lightbox
    if (elgg_is_xhr() && elgg_in_context('leancanvas')) {
        return $items;
    }
    
    $url = 'fine_uploader';
    if (elgg_get_page_owner_guid()) {
        $url = 'fine_uploader?container_guid=' . elgg_get_page_owner_guid();
    }

    $items[] = ElggMenuItem::factory(array(
                'name' => 'fine_uploader',
                'href' => $url,
                'text' => elgg_echo('fine_uploader:media'),
                'rel' => "fine_uploader-lightbox-{$vars['id']}",
                'link_class' => "elgg-longtext-control elgg-lightbox fine_uploader-control fine_uploader-control-{$vars['id']}",
                'priority' => 10,
    ));

    elgg_load_js('lightbox');
    elgg_load_css('lightbox');
    elgg_load_js('jquery.form');

    return $items;
}

/**
 * Serves the content for the fine_uploader lightbox
 *
 * @param array $page URL segments
 */
function fine_uploader_page_handler($page) {

    $container_guid = (int) get_input('container_guid');
    if ($container_guid) {
        elgg_set_page_owner_guid($container_guid);
    }

    echo elgg_view('fine_uploader/layout');

    // exit because this is in a modal display.
    exit;
}
