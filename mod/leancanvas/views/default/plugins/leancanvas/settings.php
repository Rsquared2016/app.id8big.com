<?php

$host = leancanvas_get_nodejs_url();

echo elgg_view('input/text', array('name' => 'params[host]', 'value' => $host));
