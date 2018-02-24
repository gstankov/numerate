<?php

namespace Numerate\lib;

class CleanData
{

    // Delete processed files
    public function __construct($user_files) { 
    
        foreach ($user_files as $user_file) {
        	unlink($user_file["file_dst_pathname"]);
        }
        
        return 0;
    
    }

}

?>