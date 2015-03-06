<?php

$form = new SubmitJobForm();
$content = elgg_view("jobs/forms/edit", array('form' => $form, 'class' => 'ktFormJobsSubmit'));
$title = 'Submit Job';




if (elgg_is_xhr()) {
	//$title = elgg_view_title($title);
    echo $content;
    die;
} else {
    $body = elgg_view_layout('content', array(
	 'filter' => '',
	 'content' => $content,
	 'title' => $title,
		  ));
    echo elgg_view_page('Submit Job', $body);

}