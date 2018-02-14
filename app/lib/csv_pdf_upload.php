<?php

/* Upload */

// Returns uploaded files array || error array
function csv_pdf_upload() {
    
    if (isset($_FILES['files'])) {
        
    	// Class upload prepare
    	$files = array();

    	foreach ($_FILES['files'] as $k => $l) {
    
    		foreach ($l as $i => $v) {
    
    		if (!array_key_exists($i, $files))
    			$files[$i] = array();
    			$files[$i][$k] = $v;
    		}
    
    	}
    	
        // Upload each
    	$user_files = [];
    	
    	foreach ($files as $file) {
    	    
    	    if ($file['error'] == 0) {
    	        
        		// Upload start	
        		$handle = new upload($file);
                
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
        				$user_file = [
        					//'handle' => $handle,
        					'file_dst_name' => $handle->file_dst_name,
        					'file_dst_name_body' => $handle->file_dst_name_body,
        					'file_dst_pathname' => str_replace("\\", "", $handle->file_dst_pathname),
        					'file_full_path' => realpath($handle->file_dst_pathname),
        					'file_src_size' => ByteUnits\bytes($handle->file_src_size)->format(),
        					'file_type' => $handle->file_src_mime,
        				];
        				
        				$user_files[] = $user_file;
    
        			} else { // Not processed
        
        				return array('error' => $handle->error);
        
        			} // /processed
        
        		} // /uploaded
    	        
    	    } else {
    	        
                return array('error' => '"You must upload both, the PDF and CSV files."');
    	        
    	    }

    	} // /each file
    	
		return $user_files;
    
    } else { // /$_FILES['files'] set
        
        return array('error' => 'No files in request.');
        
    }

}

?>