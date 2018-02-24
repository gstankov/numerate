<?php

session_start();
set_time_limit(300);

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require __DIR__ . '/vendor/autoload.php';

use Slim\App;
use Slim\Views\PhpRenderer;
use Setasign\FPDI;
use Numerate\lib;

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
    
    // CSV
    $handle = file_get_contents('app/assets/samples/Sample_CSV.csv');
    
    $csv = new lib\CsvToArray($handle);
    
    // PDF output
    $pdf = new lib\CsvToPdf('app/assets/samples/Sample_PDF.pdf', $csv);
    
    // Headers
    $response = $response->withHeader('Content-type', 'application/pdf');
	
	return $response->write();
    
});

$app->post('/editor', function ($request, $response) {

    // App\Lib
    
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
    
});


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();