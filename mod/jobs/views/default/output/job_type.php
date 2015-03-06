<?php

$value = $vars['value'];

$vars['value'] = KtJob::getJobTypes($value);

echo elgg_view('output/radio', $vars);

