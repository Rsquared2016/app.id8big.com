<?php

/**
 * Content Comment
 */

$entity = elgg_extract('entity', $vars, false);
$comment_type = elgg_extract('comment_type', $vars, false);

if(!$entity || !elgg_instanceof($entity, 'object', 'lean_objective')) {
	return false;
}

$entity_guid = $entity->guid;
$container_guid = $entity->container_guid;

$site_url = elgg_get_site_url();
$link = $site_url . "compass/{$comment_type}/$container_guid/$entity_guid";

$extra_class = $comment_type;
$content_comment_id = "content_comments_{$comment_type}_{$entity_guid}";

$comments = Compass::getComments($entity, $comment_type);

?>
<div id="<?php echo $content_comment_id; ?>" class="content-comments">
    <div class="badge comments <?php echo $extra_class; ?>">
    <?php 
        $comment_img = "<div class='commnetImg'></div>";
        echo elgg_view('output/url', array('href' => FALSE, 'text' => $comment_img));
    ?>
    </div>
    <div class="title-comments">
    <?php
        echo elgg_echo('compass:content:comments:'.$comment_type);
    ?>
    </div>
    <div class="add-delete-comments">
    <?php
        $show_link = FALSE;
        if ($entity->canEdit()) {
            $text = elgg_echo('compass:content:comments:add:delete');
            $show_link = TRUE;
        }
        else {
            $text = elgg_echo('compass:content:comments:view');
            if (!empty($comments)) {
                $show_link = TRUE;
            }
        }
        if ($show_link) {
            echo elgg_view('output/url', array('href' => $link, 'text' => $text, 'class' => 'compass_comments flRig'));
        }
    ?>
    </div>
    <div class="cThis"></div>
    <div class="list-comments">
        <?php
            $class_extra_empty = 'hidden';
            if (empty($comments)) {
                $class_extra_empty = '';
            }
        ?>
        <p class="list-comments-empty <?php echo $class_extra_empty; ?>"><?php echo elgg_echo('compass:content:comments:empty:'.$comment_type); ?></p>
    <?php
        foreach($comments as $comment) {
            echo elgg_view('compass/content_comment_item', array(
                'item' => $comment,
            ));
        }
    ?>
    </div>
</div>