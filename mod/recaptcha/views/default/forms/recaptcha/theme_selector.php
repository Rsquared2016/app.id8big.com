<?php 

echo elgg_view('input/hidden', array('name' => 'theme', 'value' => recaptcha_get_custom_theme(), 'id' => 'theme_selector_input'));
echo elgg_view('input/submit');