<?php

namespace Numerate\lib;

use Org_Heigl\Ghostscript\Ghostscript;

class PdfToJpeg
{
	
	private $files;
	
	// Process
	public function __construct($files) {

		// If PDF create preview
		foreach ($files as $file) {
			
			// File is PDF
			if ($file["type"] == "application/pdf") {
				
				// Create the Ghostscript-Wrapper
				$gs = new Ghostscript();
				
				// Set the output-device
				$gs->setDevice('jpeg')
				// Set the input file
				->setInputFile($file['full_path'])
				// Set the output file that will be created in the same directory as the input
				->setOutputFile($file['dst_name_body'])
				// Set the resolution to 96 pixel per inch
				->setResolution(72)
				// Set Text-antialiasing to the highest level
				->setTextAntiAliasing(Ghostscript::ANTIALIASING_HIGH)
				// Set the jpeg-quality to 100 (This is device-dependent!)
				->getDevice()->setQuality(100);
				
				// Convert the input file to an image
				if (true === $gs->render()) {
					$file['jpg_preview'] = $file['dst_name_body'] . '.jpeg';
				} else {
					$file['jpg_preview'] = 'Erorr creating jpeg preview.';
				}
				
			}
			
			// Return files
			$this->files[] = $file;
	
		} // /each user_file
	
	}
	
	public function getFiles() {
		
		return $this->files;
		
	}

}

?>