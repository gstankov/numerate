<?php

use Numerate\lib;

// Header
require "partials/header.php";

// Uploaded
if (isset($_SESSION['success'])) {
    
    // Wrapper div
    $out = '<div class="wrapper">';
    
        // Uploaded message    
        $out.= '<div class="callout success">';
        
            $out.='<div class="float-left">';
                $out.='<a href="/"><img src="app/assets/images/icon-case.png" width="60px" /></br>Home</a>';
            $out.='</div>';
            
            $out.='<div class="float-right">';
                $out.='<a href="/generate"><img src="app/assets/images/icon-case.png" width="60px" /></br>Generate</a>';
            $out.='</div>';

            foreach ($data['files'] as $file) {
                $out.='<img class="success-icon" src="app/assets/images/success.png" /> ' . $file['dst_name'] . ", ";
            }
            
            $out.= "uploaded successfully.";
            
            $out.= '<h4>Step two: Place elements on uploaded PDF template.</h4>';
            
        $out.= '</div>';

        // CSV files as sheets
        $sheets = [];

        // EACH FILE
        foreach ($data['files'] as $file) {
        
            // If PDF document
            if ($file['type'] == 'application/pdf') {
                
                $out.= "<h4>PDF preview</h4></br>";
                
                // PDF PREVIEW
                $out.= '<div class="pdf-preview">';
                
                    $out.= '<div class="img-wrapper">';
                    
                        $out.= '<div class="img-wrapper-background">';
                        
                            $out.='<div class="img-top"></div>';
                            $out.='<div class="img-left"></div>';
                            
                            $out.= '<img src="app/data/' . $file['jpg_preview'] . '" />';
                        
                        $out.= '</div>';
                    
                    $out.= '</div>';
                    
                $out.= '</div>';
                
            } else { // If CSV file
            
                // CSV PREVIEW
                $handle = file_get_contents($file['dst_pathname']);
                
                $csv = new lib\CsvToArray($handle);
                
                $csv = $csv->getCsvArray();
                
                $sheets[] = [
                    'dst_name' => $file['dst_name'],
                    'rows' => $csv
                ];
                    
            } // each file as sheet
            
        } // foreach $data['files'] as $file
        
        $out.= '<h4>CSV data</h4>';

        $out.= '<div class="csv-data">';
            
            // Files as sheets
            foreach($sheets as $sheet) {
                
                $out.='<h5 align="left">File: ' . $sheet['dst_name'] . '</h5>';
                
                $out.='<table class="stack">';
                
                    $i = 0;
                    
                    foreach ($sheet['rows'] as $row) {
                        
                        // If first row, it's header
                        if ($i == 0) {
                                
                            $out.='<thead>';
                            
                                $out.='<tr>';
                                    foreach ($row as $column) {
                                        $out.= '<th>' . $column . '</th>';
                                    }
                                $out.= '</tr>';
                                
                            $out.='</thead>';
                            
                            // Table rows
                            $out.='<tbody>';
                            
                        } else {
                            
                            $out.='<tr>';
                                foreach ($row as $column) {
                                    $out.= '<td align="left">' . $column . '</td>';
                                }
                            $out.= '</tr>';
                                
                        }
                        
                        $i++;
                    
                    }
                    
                    $out.='</tbody>';
                    
                $out.= '</table>';
        
            } // each $sheets as $sheet

            $out.= '<a href="/" class="button">Upload again</a> | ';
            $out.= '<a href="/sample" class="button">Generate</a>';
        
        $out.= '</div>'; // /.csv-data
                
    $out.= '</div>'; // /.wrapper
    
    echo $out;
                
}

// Footer
require "partials/footer.php";