<?php

// Delete processed files
function clean_data($user_files) { 

    foreach ($user_files as $user_file) {
    	unlink($user_file["file_dst_pathname"]);
    }

}

?>