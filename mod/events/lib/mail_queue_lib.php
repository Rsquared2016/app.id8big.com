<?php

function mail_queue_init($event, $object_type, $object) {

    // Replace default email handler with custom implementation to queue emails
    register_notification_handler('email', 'queue_email_notify_handler');

    //requests made via cron don't have a user, so we need to override delete permission for 'mail_queue_message' objects
    elgg_register_plugin_hook_handler('permissions_check', 'object', 'mail_queue_permissions_check');

    //register cron handler to send emails every 1 minute
    elgg_register_plugin_hook_handler('cron', 'minute', 'mail_queue_send_messages');
}

/**
 * Create and store an ElggObject (subtype 'mail_queue_message') to queue an email.
 * 
 * @param int $to guid of the user the email is addressed to
 * @param string $subject Message subject
 * @param string $body Message body
 */
function mail_queue_create_message($to, $subject,$body) {
        $message = new ElggObject();
        $message->subtype = 'mail_queue_message';
        $message->access_id = ACCESS_PUBLIC;
        $message->title = $subject;
        $message->description = $body;
        $message->to = $to;
        if ($message->save()) {
            return $message;
        } else {
            return false;
        }
}

/**
 * Queue email notifications.
 *
 * @param ElggEntity $from The from user/site/object
 * @param ElggUser $to To which user?
 * @param string $subject The subject of the message.
 * @param string $message The message body
 * @param array $params Optional parameters (none taken in this instance)
 * @return bool
 */
function queue_email_notify_handler(ElggEntity $from, ElggUser $to, $subject, $message, array $params = NULL) {
//email_notify_handler
//
    $have_to_queue = get_input('email_queue_message', FALSE);

    if ($have_to_queue == FALSE) {
        //Return the main handler to make this work as before
        return email_notify_handler($from, $to, $subject, $message, $params);
    }

    $message_entity = mail_queue_create_message($to->getGUID(), $subject, $message);

    if (!$message_entity) {

        return false;
    }

        return true;
}


function mail_queue_permissions_check($hook_name, $entity_type, $return_value, $params) {

    $subtype = get_subtype_from_id($params['entity']->subtype);
    if ($subtype == 'mail_queue_message') {
        return true;
    }

    return null;
}

function mail_queue_send_messages($hook_name, $entity_type, $return_value, $params) {

       //error_log("mail_queue_send_messages start");

        global $CONFIG;
        $max_emails = 50;

        set_time_limit(240); //set timeout to 4 minutes

        $site = get_entity($CONFIG->site_guid);
        $messages = elgg_get_entities(array('types' => 'object', 
                                            'subtypes' => 'mail_queue_message', 
                                            'order_by' => 'e.time_created asc', //send older messages first
                                            'limit' => $max_emails));

        //Override the default behaviour and allow results to show hidden entities.
        //Needed to send email address verification mails, because users that haven't been validated will be disabled.
        $access_status = access_get_show_hidden_status();
        access_show_hidden_entities(true);

        if ($messages) {
            foreach ($messages as $message) {
                $to = get_entity($message->to);
                if ($to) {
					if (is_callable(ktsuggestion_send_email)) {
						ktsuggestion_send_email($site->email, $to->email, null, null,$message->title, $message->description);
					} else {
						email_notify_handler($site, $to, $message->title, $message->description);
					}
                }
                $res = $message->delete();
            }
        }

        //set the access status to its origial state
        access_show_hidden_entities($access_status);

        //error_log("mail_queue_send_messages end");
}

elgg_register_event_handler('init', 'system', 'mail_queue_init');