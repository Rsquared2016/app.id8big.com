<?php

/*
 * BigBlueButton Integration
 */

// Get meeting id
$meeting_id = elgg_extract('meeting_id', $vars, '');
if (!$meeting_id) {
    return false;
}

// Get user
$user_guid = elgg_extract('user_guid', $vars, '');
$user = get_entity($user_guid);
if (!elgg_instanceof($user, 'user')) {
    return false;
}

?>
<div class="meeting-request-talk-wrapper">
    <div class="img">
        <a href="<?php echo $user->getURL(); ?>">
            <img src="<?php echo $user->getIconURL('small') ?>" alt="" />
        </a>
    </div>
    <div class="txt">
        <p>
            <a href="<?php echo $user->getURL(); ?>"><?php echo $user->name; ?></a>
            <?php
                echo elgg_echo('meeting:talk:accept:1');
            ?>
        </p>
        <p>
            <?php
                echo elgg_echo('meeting:talk:accept:2');
            ?>
        </p>
    </div>
    <div class="btns">
        <?php
            // 'request_talk' is used to indicate that it is accepting a request
            // for talk
            echo elgg_view('output/url', array(
                'text' => elgg_echo('meeting:talk:accept'),
                'href' => $vars['url'] . 'meeting/talk/' . $user->getGUID(),
                'target' => '_blank',
                'class' => 'elgg-button elgg-button-submit talk-accept',
            ));
        ?>
    </div>
</div>
<div id="meeting-request-talk-sound"></div>
