<?php

namespace Numerate\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Numerate\lib;

class EditorController
{
    
    private $view;
    
    public function __construct($view) {
        $this->view = $view;
    }
    
    public function post (Request $request, Response $response, array $args) {

        // Upload files
        $files = new lib\CsvPdfUpload();
        
        $files = $files->getFiles();
        
        // No errors
        if (!isset($files['error'])) {
    
            // Set session error
            $_SESSION['success'] = true;
        
            // Create PDF jpeg preview
            $files = new lib\PdfToJpeg($files);
            
            $data['files'] = $files->getFiles();
            
            // Do not cache this response
            $response = $response->withHeader("Cache-control", "no-store, no-cache, must-revalidate");
            
            // Return view
            return $this->view->render($response, 'editor.php', $data);
        
        } else {
            
            // Set session error
            $_SESSION['error'] = $files['error'];
            
            // Redirect to welcome
            return $response->withRedirect('/');
        
        }

    }

}

?>