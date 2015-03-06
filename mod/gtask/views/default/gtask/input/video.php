<?php

/*
 * This view put the video input.
 * 
 * */

//default configs.
$video_options = array(
	'generate_thumb' => TRUE,
);

if($vars['video_options'] && is_array($vars['video_options'])) {
	$video_options = array_merge($video_options, $vars['video_options']);
}

$_SESSION['videos']['input_video'] = $vars['internalname'];
$_SESSION['videos']['video_options'] = $video_options;

echo elgg_view('input/text', $vars);
