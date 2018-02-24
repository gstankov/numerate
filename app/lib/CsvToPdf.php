<?php

namespace Numerate\lib;

class CsvToPdf
{

    // Converts CSV to PDF
    public function __construct($pdfPath, $csvArray) {
        
        define('FPDF_FONTPATH', '/home/ubuntu/workspace/vendor/rev42/tfpdf/src/font');
    
        // Initiate FPDI [orientation, unit, [x, y ] || A4 A5 etc
        $pdf = new \FPDI("P", "mm", [100, 100]);
        
        // Get the page count
        $pageCount = $pdf->setSourceFile($pdfPath);
        
        // Iterate through all pages
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        
            // Import a page
            $templateId = $pdf->importPage($pageNo);
            // Get the size of the imported page
            $size = $pdf->getTemplateSize($templateId);
        
            // Create a page (landscape or portrait depending on the imported page size)
            if ($size['w'] > $size['h']) {
                $pdf->AddPage('L', array($size['w'], $size['h']));
            } else {
                $pdf->AddPage('P', array($size['w'], $size['h']));
            }
        
            // Use the imported page
            $pdf->useTemplate($templateId);
        
            $font_size = $size['h']/15;
        
            // Add a Unicode font (uses UTF-8)
        	$pdf->AddFont('Code39', '', 'FRE3OF9X.TTF', true);
        	$pdf->AddFont('DejaVu', '','DejaVuSansCondensed.ttf', true);
    
        	$pdf->SetFont('DejaVu', '', $font_size);
        
        	// Set write position
            $pdf->SetXY(0, 0);
    
        	$text = "Dimensions: " . round($size['w'], 2)."x" . round($size['h'], 2) . "mm, ";
        	//$text.= "Filename: " . $user_file['file_src_name'] . ", ";
        	//$text.= "File size: " . $user_file['file_src_size'] . ", ";
        
        	// MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
        	$pdf->MultiCell($size['w'], $font_size/2, $text, 0, "L", false);
        	
        	$pdf->SetXY(0, 0);
        	
        	$pdf->SetFont('Code39', '', $font_size);
        	$pdf->MultiCell($size['w'], $font_size/2, $text, 0, "C", false);
        	
        	$pdf->SetXY(0, 2.5);
        	$pdf->SetFont('DejaVu', '', $font_size);
        	$pdf->MultiCell($size['w'], $font_size/2, $text, 0, "C", false);
        	
        	\PHPQRCode\QRcode::png("Test", "app/data/qr_tmp.png", QR_ECLEVEL_H, 20, 2);
            
            $pdf->Image('app/data/qr_tmp.png',$size['w']-60,$size['h']-60,-300);
        
        }
        
        // Write report page
        $pdf->AddPage();
        $pdf->MultiCell(100, 6, "REPORT", 0, "P", false);
        
        foreach ($csvArray as $row) {
            $pdf->MultiCell(100, 6, $row[0], 0, "P", false);
        }
        
        // Output pdf
        $pdf->Output('file.pdf', 'I');
        
    }

}

?>