<?php

/*
 * Returns the peak of memory allocated
 */
echo 'Peak of memory allocated by PHP:&nbsp;&nbsp;&nbsp;';
echo memory_get_peak_usage();
echo ' bytes';
echo "<br><br>";
echo "Real size of memory allocated from system:&nbsp;&nbsp;&nbsp;";
echo memory_get_peak_usage(true);
echo ' bytes';
?>
