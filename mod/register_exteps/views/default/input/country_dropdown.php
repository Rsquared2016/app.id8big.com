<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$options_values = kt_generate_country_dropdown();

$vars['options_values'] = $options_values;

echo elgg_view('input/dropdown', $vars);