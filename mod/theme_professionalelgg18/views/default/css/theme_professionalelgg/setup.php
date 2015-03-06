<?php

/*
 * Common values to various elements
 *
 */

    /* basic / general configuration */
    $vars['css']['base-font-size'] = "12px";                    // Font size
    $vars['css']['base-color'] = "#404548";                     // Font color
    $vars['css']['base-line-height'] = "16px";                  // Line height
    $vars['css']['base-link-color'] = "#53A8F4";                // Link color
    $vars['css']['base-border-color'] = "#E7ECEF";             	// Border color
    $vars['css']['base-light-text-color'] = "#7b858a";          // Light text color (date, timestamp, etc.)
    $vars['css']['body-background'] = "#dfe6ea"; 				// Body background (delete/add an image if necessary)

    if(THEME_FULL_WIDTH_SUPPORT) {
		$vars['css']['cont-max-width'] = 'none';				// Main containers max-width
	    $vars['css']['cont-padding'] = '5px';					// Padding for full width theme (so it doesn't overlaps with screen's borders)
    }
	else {
		$vars['css']['cont-max-width'] = '990px';				// Main containers max-width
		$vars['css']['cont-padding'] = '0';
	}
	if(!THEME_FULL_WIDTH_SUPPORT && !THEME_RESPONSIVE_SUPPORT) {
		$vars['css']['cont-width'] = '990px';					// Main containers width (completely static width)
	}
	else {
		$vars['css']['cont-width'] = 'auto';					// Dynamic widths
	}

    /* header */
    $vars['css']['header-height'] = '59px';						// Header height
    $vars['css']['header-height-responsive'] = '45px';			// Header height responsive
    $vars['css']['header-background-color'] = '#404548';		// Header background color

    /* footer */
    $vars['css']['footer-height'] = 'auto';						// Footer height
    $vars['css']['footer-background-color'] = '#dfe6ea';		// Footer background color

    /* inputs / textarea configuration */
    $vars['css']['input-background-color'] = "#fbfbfb";         // Background color
    $vars['css']['input-background-color-focus'] = "#ffffff";   // Focus background color
    $vars['css']['input-font-color'] = "#808080";               // Font color
    $vars['css']['input-font-color-focus'] = "#666";            // Focus font color
    $vars['css']['input-border'] = "#dedede";                   // Border
    $vars['css']['input-border-focus'] = "#ccc";                // Focus border
    $vars['css']['input-shadow-focus'] = "0 0 8px rgba(82, 168, 236, 0.6)";  				// Focus "glow" or shadow
    $vars['css']['input-inner-shadow-focus'] = "0 1px 1px rgba(0, 0, 0, 0.075)";			// Focus inner "glow" or shadow
    $vars['css']['input-border-radius'] = "1px";               // Border radius

	/* site menu configuration */
	$vars['css']['site-mn-base-color'] = "#F1F6F9";      		// Full menu background color
	$vars['css']['site-mn-radius'] = "4px";      				// Border radius
    $vars['css']['site-mn-background-color-hover'] = "#fff"; 	// Item hover background color
    $vars['css']['site-mn-font-color'] = "#7B858A";             // Font color
    $vars['css']['site-mn-font-color-hover'] = "#53A8F4";       // Hover font color

    /* drop down menus configuration */
    $vars['css']['mn-background-color'] = "#fff";               // Background color
    $vars['css']['mn-background-color-hover'] = "#72B2EB";      // Hover background color
    $vars['css']['mn-background-color-sel'] = "#6199ca";       	// Selected background color
    $vars['css']['mn-font-color'] = "#404548";                  // Font color
    $vars['css']['mn-font-color-hover'] = "#fff";               // Hover font color
    $vars['css']['mn-font-size'] = "11px";                      // Font size
    $vars['css']['mn-line-height'] = "13px";                    // Line height
    $vars['css']['mn-item-height'] = "7px 8px 8px 10px";        // Menu item height (determined through padding, better than using line-height or height)
    $vars['css']['mn-border-radius'] = "5px";               	// Border radius
    $vars['css']['mn-shadow'] = "0 0 4px rgba(0, 0, 0, 0.3)";	// Shadow

    /* page menu configuration (menu on left bar) */
    $vars['css']['page-mn-background-color'] = "none";          // Background color
    $vars['css']['page-mn-background-color-hover'] = "#f1f6f9"; // Hover background color
    $vars['css']['page-mn-font-color-hover'] = "#72b2eb";       // Hover font color
    $vars['css']['page-mn-sel-background-color'] = "#72b2eb";   // Selected background color
    $vars['css']['page-mn-sel-font-color'] = "#fff";            // Selected font color
    $vars['css']['page-mn-sel-item-height'] = "5px 8px 4px";    // Menu item height (determined through padding, better than using line-height or height)

    /* modules / block shaped widgets (.elgg-module) */
    $vars['css']['module-title-background-color'] = "#000";   					// Title's background color
    $vars['css']['module-title-font-color'] = $vars['css']['base-color'];       // Title's font color
    $vars['css']['module-title-font-size'] = "12px";        					// Title's font size
    $vars['css']['module-title-padding'] = "0 6px 0 10px";	    				// Title's padding
    $vars['css']['module-title-margin'] = "0 0 15px 0";           				// Title's block margin
    $vars['css']['module-title-top-border'] = "none";            						// Border
    $vars['css']['module-title-bottom-border'] = "none"; 								// Border
    $vars['css']['module-title-left-border'] = "none";            					// Border
    $vars['css']['module-title-right-border'] = "none";            					// Border
	$vars['css']['module-top-border'] = "none";            						// Border
    $vars['css']['module-bottom-border'] = "none"; 								// Border
    $vars['css']['module-left-border'] = "none";            					// Border
    $vars['css']['module-right-border'] = "none";            					// Border
    $vars['css']['module-padding'] = "0 0 10px";            					// Padding
    $vars['css']['module-margin'] = "0 0 10px"; 	           					// Margin

    /* profile widgets */
    $vars['css']['widget-title-background-color'] = "#F1F6F9";  // Title's background color
    $vars['css']['widget-title-font-color'] = "#7B858A";        // Title's font color
    $vars['css']['widget-title-height'] = "8px 45px 6px 20px";  // Title's height (determined through padding, better than using line-height or height)
    $vars['css']['widget-title-margin'] = "0";  		        // Title's margin
    $vars['css']['widget-background'] = "#ffffff";  		    // Background color
    $vars['css']['widget-top-border'] = "1px solid " . $vars['css']['base-border-color'];   	// Border
    $vars['css']['widget-bottom-border'] = "1px solid " . $vars['css']['base-border-color'];    // Border
    $vars['css']['widget-left-border'] = "1px solid " . $vars['css']['base-border-color'];      // Border
    $vars['css']['widget-right-border'] = "1px solid " . $vars['css']['base-border-color'];     // Border
    $vars['css']['widget-padding'] = '0';						// Padding (general)
    $vars['css']['widget-margin'] = '0 0 15px';					// Margin
    $vars['css']['widget-content-padding'] = '10px';			// Padding (content)
    $vars['css']['widget-foot-font-size'] = '11px';				// Foot font size
    $vars['css']['widget-foot-padding'] = '0 1px';				// Foot padding
    $vars['css']['widget-list-font-size'] = '11px';				// Widget lists' font size
    $vars['css']['widget-list-title-font-size'] = '12px';		// Widget lists' item title font size

    /* info modules */
    $vars['css']['block-title-background-color'] = "#F1F6F9";   // Background color
    $vars['css']['block-title-font-color'] = "#7B858A";         // Font color
    $vars['css']['block-title-height'] = "9px 12px 8px";        // Block height (determined through padding, better than using line-height or height)
    $vars['css']['block-title-margin'] = "0 0 15px";            // Block margin

    /* button's configuration */
    /* base button // .elgg-button */
    $vars['css']['btn-background-color'] = "#fafafa"; 		  					// Background color
    $vars['css']['btn-background-color-start'] = "#fafafa";   					// Background color start
    $vars['css']['btn-background-color-end'] = "#e5e6e5";   					// Background color end
    $vars['css']['btn-background-color-hover'] = "#e5e6e5";   					// Background color hover
    $vars['css']['btn-background-color-active'] = "#e6e6e6";   					// Background color active
    $vars['css']['btn-background-color-active-2'] = "#d9d9d9";  				// Background color active 2 (IE?)
    $vars['css']['btn-font-color'] = "#666666";            						// Font color
    $vars['css']['btn-font-color-hover'] = "#000000";      						// Font color hover
    $vars['css']['btn-border-color'] = '#dcdcdc';       						// Block height (determined through padding, better than using line-height or height)
    $vars['css']['btn-font-size'] = "13px";            							// Font size
    $vars['css']['btn-border-radius'] = "3px";         							// Border radius
    /* hover / active / disabled states */
    $vars['css']['btn-had-background-color'] = "#e5e6e5";	 			  		// Background color (should be the same as 'btn-background-color-end')
    $vars['css']['btn-had-background-color-2'] = "#e5e6e5";	 			  		// Background color (IE?)
    $vars['css']['btn-disabled-background-color'] = "#e6e6e6";			  		// Background color disabled

    /* colored buttons*/
    $vars['css']['btn-colored-font-color'] = "#ffffff";            			    // Font color for coloured buttons (red, green, black, etc.)

    /* primary button // .elgg-button-submit */
    $vars['css']['btn-primary-background-color'] = "#52a7f3"; 		  					// Background color
    $vars['css']['btn-primary-background-color-start'] = "#52a7f3";   					// Background color start
    $vars['css']['btn-primary-background-color-end'] = "#377bb7";   					// Background color end
    /* hover / active / disabled states */
    $vars['css']['btn-primary-had-background-color'] = "#377bb7";	 			  		// Background color
    $vars['css']['btn-primary-had-background-color-2'] = "#377bb7";	 			  		// Background color (IE?)

    /* warning button // .btn-warning (Bootstrap only) */
    $vars['css']['btn-warning-background-color'] = "#faa732"; 		  					// Background color
    $vars['css']['btn-warning-background-color-start'] = "#fbb450";   					// Background color start
    $vars['css']['btn-warning-background-color-end'] = "#f89406";   					// Background color end
    $vars['css']['btn-warning-background-hover'] = "#f89406"; 		  					// Background color hover
    $vars['css']['btn-warning-background-hover-2'] = "#c67605"; 	  					// Background color hover 2 (IE?)

    /* danger button // .elgg-button-delete */
    $vars['css']['btn-danger-background-color'] = "#da4f49"; 		  					// Background color
    $vars['css']['btn-danger-background-color-start'] = "#ee5f5b";   					// Background color start
    $vars['css']['btn-danger-background-color-end'] = "#bd362f";   						// Background color end
    /* hover / active / disabled states */
    $vars['css']['btn-danger-had-background-color'] = "#bd362f";	 			  		// Background color
    $vars['css']['btn-danger-had-background-color-2'] = "#942a25";	 			  		// Background color (IE?)

    /* success button // .elgg-button-action */
    $vars['css']['btn-success-background-color'] = "#52a7f3"; 		  					// Background color
    $vars['css']['btn-success-background-color-start'] = "#52a7f3";   					// Background color start
    $vars['css']['btn-success-background-color-end'] = "#377bb7";  						// Background color end
    /* hover / active / disabled states */
    $vars['css']['btn-success-had-background-color'] = "#377bb7";	 			  		// Background color
    $vars['css']['btn-success-had-background-color-2'] = "#377bb7";	 			  		// Background color (IE?)

    /* info button // .elgg-button-special */
    $vars['css']['btn-info-background-color'] = "#49afcd";	 		  					// Background color
    $vars['css']['btn-info-background-color-start'] = "#5bc0de";   						// Background color start
    $vars['css']['btn-info-background-color-end'] = "#2f96b4";  						// Background color end
    /* hover / active / disabled states */
    $vars['css']['btn-info-had-background-color'] = "#2f96b4";	 			  			// Background color
    $vars['css']['btn-info-had-background-color-2'] = "#24748c";	 			  		// Background color (IE?)

    /* inverse button // .elgg-button-cancel */
    $vars['css']['btn-inverse-background-color'] = "#393939";	 		  				// Background color
    $vars['css']['btn-inverse-background-color-start'] = "#454545";   					// Background color start
    $vars['css']['btn-inverse-background-color-end'] = "#262626";  						// Background color end
    /* hover / active / disabled states */
    $vars['css']['btn-inverse-had-background-color'] = "#262626";	 			  		// Background color
    $vars['css']['btn-inverse-had-background-color-2'] = "#0c0c0c";	 			  		// Background color (IE?)

    /* tabs */
    $vars['css']['tab-background-color-hover'] = '#eeeeee';								// Background color hover
    $vars['css']['tab-font-color-hover'] = $vars['css']['base-link-color'];				// Font color hover

    /* misc configuration */
    $vars['css']['misc-bg-color'] = "#f3f8fb";	 			  							// Dashboard Comments / Activity Share background
    $vars['css']['notif-bg-color'] = "#BD0707";	 			  							// Notifications' number circle background color


    /* font families */
    $vars['css']['base-font-family'] = '
        "Lucida Sans Unicode",
        "Lucida Sans",
        "Lucida Grande",
        Arial,
        Tahoma,
        Verdana,
        Helvetica,
        Geneva,
        "Trebuchet MS",
        sans-serif';                                            // Base font family
    $vars['css']['monospace-font-family'] = '
        Menlo,
        Monaco,
        Consolas,
        "Courier New",
        Courier,
        monospace';                                             // Monospace fonts



	//Save this configuration, as default ? //With run function once ?
	$theme_default_style = elgg_get_plugin_setting('theme_default_style', THEME_NAME);

	if(!$theme_default_style) {
		$theme_default_style = serialize($vars['css']);
		elgg_set_plugin_setting('theme_default_style', $theme_default_style,THEME_NAME);
	}


	//Get custom style and update it.
	$theme_custom_style = elgg_get_plugin_setting('theme_custom_style', THEME_NAME);

	if($theme_custom_style) {
		$theme_custom_style = unserialize($theme_custom_style);

		if(is_array($theme_custom_style)) {
			//Override style property.
			foreach ($theme_custom_style as $sKey => $sVal) {
				if($sVal) {
					$vars['css'][$sKey] = $sVal;
				}
			}
		}
	}
