<?php

namespace Numerate\lib;

class CsvPdfUpload
{
    
    private $files;
    
    // Returns uploaded files array || error array
    public function __construct() {
        
    	// Class upload prepare checklater
    	$user_files = [];
        
    	foreach ($_FILES['user_files'] as $k => $l) {
    
    		foreach ($l as $i => $v) {
    
    		if (!array_key_exists($i, $user_files))
    			$user_files[$i] = array();
    			$user_files[$i][$k] = $v;
    		}
    
    	}
        
        // Each file	
    	foreach ($user_files as $file) {
    	    
    	    if ($file['error'] == 0) {
    	        
        		// Upload start	
        		$handle = new \upload($file);
                
                // Processing
        		$handle->mime_check = true;
        		$handle->allowed = array('application/pdf', 'application/vnd.ms-excel', 'text/csv', 'text/plain');
        		$handle->no_script = false;
                
                // Uploaded? 
        		if ($handle->uploaded) {
                    
                    // Process
        			$handle->process('app/data/');
        			
        		    // Processed
        			if ($handle->processed) {
        
        				// Uploaded data
        				$this->files[] = [
        					'dst_name' => $handle->file_dst_name,
        					'dst_name_body' => $handle->file_dst_name_body,
        					'dst_pathname' => str_replace("\\", "", $handle->file_dst_pathname),
        					'full_path' => realpath($handle->file_dst_pathname),
        					'src_size' => \ByteUnits\bytes($handle->file_src_size)->format(),
        					'type' => $handle->file_src_mime,
        				];
    
        			} // /processed
        
        		} // /uploaded
    	        
    	    } // /if no error

    	} // /each file
    
    }
    
    // Return files array
    public function getFiles() {
        return $this->files;
    }

}

?>