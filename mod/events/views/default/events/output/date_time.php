<?php

$datetimes = events_get_hours_options();

echo $datetimes[$vars['value']];

//echo elgg_view('output/dropdown', $vars);