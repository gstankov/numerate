<?php

use Org_Heigl\Ghostscript\Ghostscript;

// Process
function pdf_to_jpg($user_files) {
	
	$files = [];
	
	// If PDF create preview
	foreach ($user_files as $user_file) {
		
		// File is pdf
		if ($user_file["file_type"] == "application/pdf") {
			
			// Create the Ghostscript-Wrapper
			$gs = new Ghostscript();
			
			// Set the output-device
			$gs->setDevice('jpeg')
			// Set the input file
			->setInputFile($user_file['file_full_path'])
			// Set the output file that will be created in the same directory as the input
			->setOutputFile($user_file['file_dst_name_body'])
			// Set the resolution to 96 pixel per inch
			->setResolution(72)
			// Set Text-antialiasing to the highest level
			->setTextAntiAliasing(Ghostscript::ANTIALIASING_HIGH)
			// Set the jpeg-quality to 100 (This is device-dependent!)
			->getDevice()->setQuality(100);
			
			// Convert the input file to an image
			if (true === $gs->render()) {
				$user_file['file_jpg_preview'] = $user_file['file_dst_name_body'] . '.jpeg';
			} else {
				$user_file['file_jpg_preview'] = 'Erorr creating jpeg preview.';
			}
			
		}
		
		// Return files
		$files[] = $user_file;

	} // /each user_file
	
	// Return array
	return $files;

}

?>