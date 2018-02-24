<?php

use Numerate\lib;

// Header
require "partials/header.php";

// Uploaded
if (isset($_SESSION['success'])) {
    
    // Wrapper div
    $out = '<div class="wrapper">';
    
        // Uploaded message    
        $out.= '<div class="callout default">';
        
            $out.='<div class="menu-left float-left">';
            
                $out.= '<a href="/"><img src="app/assets/images/icon-case-upload.png" width="60px" /></br>Upload</br></br></a>';
                
                $out.= '<p>';
                    $out.= 'Select CSV file and column to place stuff:';
                $out.= '</p>';
                
                $out.="<label>CSV file:</label>";
                
                $out.= '<select>';
                    $out.= '<option>Value</option>';
                $out.= '</select>';
                
                $out.="<label>CSV column:</label>";
                
                $out.= '<select>';
                    $out.= '<option>Value</option>';
                $out.= '</select>';
                
                $out.= '<a href="/sample" class="button small">Place QR code</a></br>';
                $out.= '<a href="/sample" class="button small">Place Barcode</a></br>';
                $out.= '<a href="/sample" class="button small">Place Text</a></br>';
                
                $out.="<label>Add filename and info</label>";
                $out.= '<div class="switch tiny">';
                    $out.= '<input class="switch-input" id="tinySwitch" type="checkbox" name="exampleSwitch" checked>';
                    $out.= '<label class="switch-paddle" for="tinySwitch">';
                        $out.= '<span class="show-for-sr">Tiny Sandwiches Enabled</span>';
                    $out.= '</label>';
                $out.= '</div>';
                
                $out.="<label>Add report page</label>";
                $out.= '<div class="switch tiny">';
                    $out.= '<input class="switch-input" id="tinySwitch2" type="checkbox" name="exampleSwitch2" checked>';
                    $out.= '<label class="switch-paddle" for="tinySwitch2">';
                        $out.= '<span class="show-for-sr">Tiny Sandwiches Enabled</span>';
                        $out.= '<span class="switch-active" aria-hidden="true">Yes</span>';
                        $out.= '<span class="switch-inactive" aria-hidden="true">No</span>';
                    $out.= '</label>';
                $out.= '</div>';
                
            $out.='</div>';
            
            $out.='<div class="menu-right float-right">';
            
                $out.='<a href="/generate"><img src="app/assets/images/icon-generate.png" width="60px" /></br>Generate</br></br></a>';
                $out.='<p>PDF file info</p>';
                
                foreach ($data['files'] as $file) {

                    // If PDF document
                    if ($file['type'] == 'application/pdf') {
                        $out.= '<b>Name</b>: <span title="' . $file['dst_name'] . '">' . $file['dst_name'] . '</span></br>';
                        $out.= '<b>Type</b>: ' . $file['type'] . '</br>';
                        $out.= '<b>Size</b>: ' . $file['src_size'] . '</br>';
                    }
                    
                }
                
            $out.='</div>';
            
            $out.='<div>';
                foreach ($data['files'] as $file) {
                    $out.='<img class="success-icon" src="app/assets/images/success.png" /> ' . $file['dst_name'] . ", ";
                }
            $out.=' uploaded successfully.</div>'; // !callout
            
            // CSV files as sheets
            $sheets = [];
    
            // EACH FILE
            foreach ($data['files'] as $file) {
            
                // If PDF document
                if ($file['type'] == 'application/pdf') {
                    
                    //$out.= "<h4>PDF preview</h4></br>";
                    
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
            
            //$out.= '<h4>CSV data</h4>';
    
            $out.= '<div class="csv-data">';
                
                // Files as sheets
                foreach($sheets as $sheet) {
                    
                    $out.='<h5 align="left" style="clear: both;">File: ' . $sheet['dst_name'] . '</h5>';
                    
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
            
            $out.= '</div>'; // /.csv-data
        
        $out.= '</div>'; // /.callout
                
    $out.= '</div>'; // /.wrapper
    
    echo $out;
                
}

// Footer
require "partials/footer.php";