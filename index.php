<?php

session_start();
set_time_limit(300);

use Slim\App;
use Slim\Views\PhpRenderer;
use Setasign\FPDI;

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require __DIR__ . '/vendor/autoload.php';

// Slim config
$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new Slim\App($config);

/* ================================================================================= */

/**
 * Step 2.1:
 * 
 * PHP view renderer
 * 
 * 
 */
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    return new PhpRenderer('app/templates/');
};

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
$app->get('/', function ($request, $response) {
    
    // Unset upload errors
    session_unset($_SESSION['error']);
    
    // Return view
    return $this->view->render($response, 'welcome.php');
    
});
 
$app->get('/sample', function ($request, $response) {
    
    // Unset upload errors
    session_unset($_SESSION['error']);
    
    // Convert CSV to PDF
    require 'app/lib/csv_to_pdf.php';
    // Convert CSV to array
    require 'app/lib/csv_to_array.php';
    
    // CSV
    $handle = file_get_contents('app/assets/samples/Sample_CSV.csv');
    
    $csv = csv_to_array($handle);
    
    $pdf = csv_to_pdf('app/assets/samples/Sample_PDF.pdf', $csv);
    
    $response = $response->withHeader('Content-type', 'application/pdf');
	
	return $response->write();
    
});

$app->post('/editor', function ($request, $response) {

    // App\Lib
    
    // Upload CSV and PDF
    require 'app/lib/csv_pdf_upload.php';
    // Convert PDF to jpg
    require 'app/lib/pdf_to_jpg.php';
    
    // Upload files
    $files = csv_pdf_upload();
    
    // If error uploading
    if (isset($files['error'])) {
        
        // Set session error
        $_SESSION['error'] = $files['error'];
        
        // Redirect to welcome
        return $response->withRedirect('/');
    
    } else { // No errors
    
        // PDF jpg preview create
        $files = pdf_to_jpg($files);
        
        // Set session error
        $_SESSION['success'] = true;
        
        // Do not cache this response
        $response = $response->withHeader("Cache-control", "no-store, no-cache, must-revalidate");
        
        // View data
        $data['files'] = $files;
        
        // Return view
        return $this->view->render($response, 'editor.php', $data);
    
    }
    
});


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();