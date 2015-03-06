<?php

/*
 * //Add responsive functions
 */

function theme_professionalelgg_responsive_init() {
	
	//Change behaviour of site menu.
	elgg_register_plugin_hook_handler('prepare', 'menu:site', 'theme_professionalelgg_responsive_menu', 900);
	
	
}

/**
 * Gives posibility with one param to convert the more menu into a single menu.
 * @param type $hook
 * @param type $type
 * @param type $return
 * @param type $params
 * @return type
 */
function theme_professionalelgg_responsive_menu($hook, $type, $return, $params) {

	if($params['single_menu'] && $return['more']) {
		$return['default'] = array_merge($return['default'], $return['more']);
		unset($return['more']);
	}

	return $return;
}

elgg_register_event_handler('init', 'system', 'theme_professionalelgg_responsive_init');
