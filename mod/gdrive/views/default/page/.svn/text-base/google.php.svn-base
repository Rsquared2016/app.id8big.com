<?php

/**
 * Page Google
 */

$body = elgg_view('page/elements/body', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));

// Set the content type
header("Content-type: text/html; charset=UTF-8");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php echo elgg_view('page/elements/head', $vars); ?>
	</head>
    <body>
        <div class="elgg-page">
            <div class="elgg-page-messages">
				<?php echo $messages; ?>
			</div>
            <div class="elgg-page-body">
				<?php echo $body; ?>
			</div>
        </div>
        <?php echo elgg_view('page/elements/foot'); ?>
    </body>
</html>