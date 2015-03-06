<?php

/*
 * BigBlueButton Integration
 */

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
                echo elgg_echo('meeting:talk:request:1');
            ?>
        </p>
        <p>
            <?php
                echo elgg_echo('meeting:talk:request:2');
            ?>
        </p>
    </div>
    <div class="btns">
        <?php
            // 'request_talk' is used to indicate that it is accepting a request
            // for talk
            echo elgg_view('output/url', array(
                'text' => elgg_echo('meeting:talk:request:accept'),
                'href' => $vars['url'] . 'meeting/talk/' . $user->getGUID(),
                'target' => '_blank',
                'class' => 'elgg-button elgg-button-submit talk-accept',
            ));
            $decline_url = $vars['url'] . 'action/meeting/talk/decline?user_guid=' . $user->getGUID();
            $decline_url = elgg_add_action_tokens_to_url($decline_url);
            echo elgg_view('output/url', array(
                'text' => elgg_echo('meeting:talk:request:decline'),
                'href' => $decline_url,
                'class' => 'elgg-button talk-decline',
            ));
        ?>
    </div>
</div>
<div id="meeting-request-talk-sound"></div>
