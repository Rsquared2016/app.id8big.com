<?php

$guid = get_input('job_guid');
$entity = get_entity($guid);
$check_entity = ($entity instanceof KtJob);

if ($check_entity == FALSE) {
    register_error(elgg_echo('job:error:entity'));
}

$form = new SubmitJobForm();
$success = $form->validate();

if ($success && $check_entity) {

    $entity_success = FALSE;

    try {
        $entity_success = $entity->submitJob();
    } catch (Exception $exc) {
        register_error($exc->getMessage());
    }

    if ($entity_success) {
        try {

            $site = elgg_get_site_entity();

            $attachment_success = $form->save();
            $download_link = '';
            $user_submitted = get_loggedin_user();
            $attachment_success = get_entity($attachment_success);
            if ($attachment_success instanceof SubmitJob) {

                $entity->addRelationship($attachment_success->getGUID(), SUBMIT_JOB_ATTACH_RELATIONSHIP);
//                $attachment_type = $attachment_success->attachment_type;
                $attachment_type = 1;
                
                switch ($attachment_type) {
                    case '2':
                        //$download_link = '#download_cv';
                        if (is_callable('curriculum_get_user_download_cv_link')) {
                            $download_link = curriculum_get_user_download_cv_link($user_submitted);
                        }

                        break;

                    default:
                        $download_link = elgg_view('jobs/output/kt_file_only_url', array('name' => 'attachment_file', 'entity' => $attachment_success, 'ignore_access' => TRUE));
                        break;
                }
            }
            $subject = elgg_echo('job:notification:submit_job:subject');
            $subject = sprintf($subject, $entity->title);

            $message = elgg_echo('job:notification:submit_job:message');

            $msg_description = '';
            if ($attachment_success->description) {
                $msg_description = elgg_echo('competition:notification:submit_job:message:description');
                $msg_description = sprintf($msg_description, $attachment_success->description);
            }
            $message = sprintf($message, $entity->getOwnerEntity()->name, $user_submitted->name, $entity->getURL(), $msg_description);


            if (!empty($download_link)) {
                $message .= ' <br/>' . sprintf(elgg_echo('job:notification:submit_job:download_link'), $download_link);
            }

            
            //$notified = notify_user($entity->getOwner(), $user_submitted->getGUID(), $subject, $message);
            $notified = elgg_send_email($site->email, $entity->email, $subject, $message);
//			$notified = messages_send($subject, $message, $entity->getOwner(), $user_submitted->getGUID(), 0, TRUE, FALSE);
        } catch (Exception $exc) {
            register_error($exc->getMessage());
        }


        system_message(elgg_echo('job:message:success:submit_job'));
    }

    forward($entity->getURL());
} else {
    $errors = $form->getErrors();
    if (count($errors) > 0) {
        register_error(implode(PHP_EOL, $errors));
    }
}

forward(REFERER);