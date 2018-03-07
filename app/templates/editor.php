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
            
                $out.= '<a href="/"><img src="app/assets/images/icon-case-upload.png" width="60px" /></br>Try again</br></br></a>';
            
                $out.='<p>PDF file info:</p>';
                
                foreach ($data['files'] as $file) {

                    // If PDF document
                    if ($file['type'] == 'application/pdf') {
                        $out.= '<b>Name</b>:</br> <span title="' . $file['dst_name'] . '">' . $file['dst_name'] . '</span></br>';
                        $out.= '<b>Type</b>:</br>' . $file['type'] . '</br>';
                        $out.= '<b>Size</b>:</br>' . $file['src_size'] . '</br>';
                        $out.= '<b>Dimensions</b>:</br>' . round($file['info']['size']['w'], 2) . 'x' . round($file['info']['size']['h'], 2) . 'mm';
                    }
                    
                }

            $out.='</div>';
            
            $out.='<div class="menu-right float-right">';
            
                $out.='<a href="/generate"><img src="app/assets/images/icon-generate.png" width="60px" /></br>Generate</br></br></a>';
                
                $out.="<label>Place filenames</label>";
                $out.= '<div class="switch tiny">';
                    $out.= '<input class="switch-input" id="tinySwitch" type="checkbox" name="exampleSwitch" checked>';
                    $out.= '<label class="switch-paddle" for="tinySwitch">';
                        $out.= '<span class="show-for-sr">Tiny Sandwiches Enabled</span>';
                        $out.= '<span class="switch-active" aria-hidden="true">On</span>';
                        $out.= '<span class="switch-inactive" aria-hidden="true">Off</span>';
                    $out.= '</label>';
                $out.= '</div>';
                
                $out.="<label>Report page</label>";
                $out.= '<div class="switch tiny">';
                    $out.= '<input class="switch-input" id="tinySwitch2" type="checkbox" name="exampleSwitch2" checked>';
                    $out.= '<label class="switch-paddle" for="tinySwitch2">';
                        $out.= '<span class="show-for-sr">Tiny Sandwiches Enabled</span>';
                        $out.= '<span class="switch-active" aria-hidden="true">On</span>';
                        $out.= '<span class="switch-inactive" aria-hidden="true">Off</span>';
                    $out.= '</label>';
                $out.= '</div>';
                
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
                    
                    // PDF PREVIEW
                    $out.= '<div class="pdf-preview">';
                    
                        $out.= '<div class="img-wrapper">';
                        
                            $out.= '<div class="img-wrapper-background">';
                            
                                $out.='<div class="img-top"></div>';
                                $out.='<div class="img-left"></div>';
                                
                                $out.= '<img src="app/data/' . $file['jpg_preview'] . '" />';
                            
                            $out.= '</div>';
                        
                        $out.= '</div>';
                        
                        $out.= '<div class="loading">Loading PDF preview...</br><img src="app/assets/images/spinner.gif" /></div>';
                        
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
    
            $out.= '<div class="csv-data">';
                
                // Files as sheets
                foreach($sheets as $sheet) {
                    
                    $out.='<h4 align="left" style="clear: both;">File: ' . $sheet['dst_name'] . '</h4>';
                    
                    $out.= '<h6 align="left" class="subheader">Drag and drop column header options to PDF preview. <em>(if data looks garbled might be some problem with the CSV parser).</em></h6>';
                    
                    $out.='<table class="stack">';
                    
                        $i = 0;
                        
                        foreach ($sheet['rows'] as $row) {
                            
                            // If first row, it's header
                            if ($i == 0) {
                                
                                $out.='<thead>';
                                
                                    $out.='<tr>';
                                        foreach ($row as $column) {
                                            $qr = new lib\StringToQr($column);
                                            $out.= '<th align="center">' . $column . '</br><img src="app/data/' .$qr->getQr(). '" class="qr-code" width="50px;" /></th>';
                                        }
                                    $out.= '</tr>';
                                    
                                $out.='</thead>';
                                
                                // Table rows
                                $out.='<tbody>';
                                
                            } else {
                                
                                $out.='<tr>';
                                    foreach ($row as $column) {
                                        $out.= '<td align="center">' . $column . '</td>';
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