<?php

/**
 * Help texts helper functions
 *
 * @package Help texts
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $help_text A help_text object.
 * @return array
 */
function help_texts_prepare_form_vars($help_text = null) {
    // input names => defaults
    $values = array(
        'title' => get_input('title', ''), // help_textlet support
//        'target_url' => get_input('target_url', ''),
        'description' => '',
        'descriptive_icon' => get_input('descriptive_icon', ''),
        'section' => get_input('section', ''),
        'access_id' => ACCESS_DEFAULT,
        'tags' => '',
        'shares' => array(),
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $help_text,
    );

    if ($help_text) {
        foreach (array_keys($values) as $field) {
            if (isset($help_text->$field)) {
                $values[$field] = $help_text->$field;
            }
        }
    }

    if (elgg_is_sticky_form('help_texts')) {
        $sticky_values = elgg_get_sticky_values('help_texts');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('help_texts');

    return $values;
}

function help_texts_icons_get_data() {
    
     $values = file_get_contents(elgg_get_plugins_path() . 'help_texts/data/icon_dropdown_source.json');
    //Agregarle clave (friendly)=> valor
    $values = json_decode($values, TRUE);

    $return = array();
    foreach ($values as $key_value => $value) {
        $index = str_replace('&#xe', '', $value);
        $index = str_replace(';', '', $index);
        $return[$index] = $key_value;
    }
    return $return;
    
}

function help_texts_sections_get_data() {
    
    $return = array(
        '' => elgg_echo('help_texts:section:option:choose'),
        elgg_echo('help_texts:section:activity') => array(
            'activity' => elgg_echo('help_texts:section:activity:dashboard'),
            'thewire' => elgg_echo('help_texts:section:activity:wire'),
        ),
        elgg_echo('help_texts:section:people') => array(
            'circles' => elgg_echo('help_texts:section:people:circles'),
            'members' => elgg_echo('help_texts:section:people:community'),
            'friends' => elgg_echo('help_texts:section:people:following'),
            'friendsof' => elgg_echo('help_texts:section:people:followers'),
        ),
        elgg_echo('help_texts:section:projects') => array(
            'projects/all' => elgg_echo('help_texts:section:projects:lists'),
        ),
        elgg_echo('help_texts:section:files') => array(
            'file/all' => elgg_echo('help_texts:section:files:lists'),
            'file/add' => elgg_echo('help_texts:section:files:upload'),
        ),
        elgg_echo('help_texts:section:schedule') => array(
            'events/calendar' => elgg_echo('help_texts:section:schedule:calendar'),
            'meeting/onlineusers' => elgg_echo('help_texts:section:schedule:video_conference'),
        ),
        elgg_echo('help_texts:section:social') => array(
            'news' => elgg_echo('help_texts:section:social:news'),
            'blog' => elgg_echo('help_texts:section:social:blog'),
            'groups' => elgg_echo('help_texts:section:social:groups'),
            'jobs' => elgg_echo('help_texts:section:social:jobs'),
            'bookmarks' => elgg_echo('help_texts:section:social:bookmarks'),
        ),
    );
    return $return;
    
}