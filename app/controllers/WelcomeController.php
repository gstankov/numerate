<?php

namespace Numerate\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Numerate\lib;

class WelcomeController
{
    
    private $view;
    
    public function __construct($view) {
        $this->view = $view;
    }
    
    public function index (Request $request, Response $response, array $args)
    {
        
        // Unset upload errors
        session_unset($_SESSION['error']);
        
        // Return view
        return $this->view->render($response, 'welcome.php');
    	
    }

}

?>