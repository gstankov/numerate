<?php

/**
 * Gets some PDF info
 * 
 */

namespace Numerate\lib;

class PdfInfo
{
    private $info;

    public function __construct($files) {
        
        foreach ($files as $file) {
            
            if ($file['type'] == 'application/pdf') {
                
                        
                // Initiate FPDI [orientation, unit, [x, y ] || A4 A5 etc
                $pdf = new \FPDI("P", "mm", [100, 100]);
                
                // Import a page
                $templateId = $pdf->importPage(0);
                // Get the size of the imported page
                $size = $pdf->getTemplateSize($templateId);
            
                // Create a page (landscape or portrait depending on the imported page size)
                if ($size['w'] > $size['h']) {
                    $file['orientation'] == "L";
                } else {
                    $file->AddPage('P', array($size['w'], $size['h']));
                    $file['orientation'] == "L";
                }
                
                $this->info[] = $file;
                
            }
            
        }

        
    }
    
    public function getInfo() {
        return $this->info;
    }
    
}