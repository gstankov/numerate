<?php

namespace Numerate\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Numerate\lib;

class SampleController
{
    
    private $view;
    
    public function __construct($view) {
        $this->view = $view;
    }
    
    public function index (Request $request, Response $response, array $args)
    {
        
        // Unset upload errors
        session_unset($_SESSION['error']);
        
        // CSV
        $handle = file_get_contents('app/assets/samples/Sample_CSV.csv');
        
        $csv = new lib\CsvToArray($handle);
        
        // PDF output
        $pdf = new lib\CsvToPdf('app/assets/samples/Sample_PDF.pdf', $csv);
        
        // Headers
        $response = $response->withHeader('Content-type', 'application/pdf');
    	
    	return $response->write();
    	
    }

}

?>