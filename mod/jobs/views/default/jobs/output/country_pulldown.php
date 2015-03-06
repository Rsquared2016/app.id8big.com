<?php

$vars['options_values'] = KtJobBaseMain::ktform_get_country_values(array('camelize_values' => TRUE));

echo elgg_view('output/pulldown', $vars);