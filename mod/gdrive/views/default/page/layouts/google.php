<?php

/**
 * Page Layout Google
 */

$class = 'elgg-layout elgg-layout-google clearfix';

if (isset($vars['class'])) {
    $class = "$class {$vars['class']}";
}

?>
<div class="<?php echo $class; ?> ">
    <div class="elgg-main elgg-body">
        <?php
            echo $vars['content'];
        ?>
    </div>
</div>