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
                
                // Set source file
                $pdf->setSourceFile($file['dst_pathname']);
                
                // Import a page
                $templateId = $pdf->importPage(1);
                // Get the size of the imported page
                $size = $pdf->getTemplateSize($templateId);
                
                // String
                $file['info']['size'] = [
                        'w' => $size['w'],
                        'h' => $size['h']
                    ];

            }
            
            $this->info[] = $file;
            
        }

    }
    
    public function getInfo() {
        return $this->info;
    }
    
}