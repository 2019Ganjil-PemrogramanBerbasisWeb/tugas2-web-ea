<?php
// Old Name Of The file
$old_name = $_GET['i'];

// New Name For The File
$new_name = $_GET['o'];

// using rename() function to rename the file
rename( $old_name, $new_name) ;

?> 
