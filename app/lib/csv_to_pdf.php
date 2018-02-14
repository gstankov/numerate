<?php

// Converts CSV to PDF
function csv_to_pdf() {
    
    // File is CSV
    if ($user_file["file_type"] == "application/vnd.ms-excel" || "text/csv") {
    
    	// CSV parse
    	$csv = csv_to_array(file_get_contents($user_file["file_dst_pathname"]), ";", false);
    
    }
    
    // Initiate FPDI [orientation, unit, [x, y ] || A4 A5 etc
    $pdf = new FPDI("P", "mm", [100, 100]);
    
    // Get the page count
    $pageCount = $pdf->setSourceFile($user_file["file_dst_pathname"]);
    
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
    	$pdf->AddFont('Code39', '', 'fre3of9x.ttf', true);
    	$pdf->AddFont('DejaVu', '','DejaVuSansCondensed.ttf', true);
    	$pdf->SetFont('DejaVu', '', $font_size);
    
    	// Set write position
        $pdf->SetXY(0, 0);
    
    	$text = "Dimensions: " . round($size['w'], 2)."x" . round($size['h'], 2) . "mm, ";
    	$text.= "Filename: " . $user_file['file_src_name'] . ", ";
    	$text.= "File size: " . $user_file['file_src_size'] . ", ";
    
    	// MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
    	$pdf->MultiCell($size['w'], $font_size/2, $text, 0, "L", false);
    
    }
    
    // Write report page
    $pdf->AddPage();
    $pdf->MultiCell(100, 6, "Report", 0, "P", false);
    
    // Output pdf
    $pdf->Output($user_file["file_dst_pathname"], 'I');

}

?>