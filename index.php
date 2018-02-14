<?php

session_start();

// Script execution time
set_time_limit(300);

use Slim\Views\PhpRenderer;

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require 'vendor/autoload.php';

// Lib

// Clean data
require 'app/lib/clean_data.php';
// Upload CSV and PDF
require 'app/lib/csv_pdf_upload.php';
// Convert PDF to jpg
require 'app/lib/pdf_to_jpg.php';
// Convert CSV to array
//require 'app/lib/csv_to_array.php';
// Convert CSV to PDF
//require 'app/lib/csv_to_pdf.php';

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


/**
 * Step 2.1: PHP renderer
 * 
 * Needs to be her to use plain php in templates
 * 
 * 
 */
// PHP renderer

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    return new PhpRenderer('app/templates/');
};

/* ================================================================================= */

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
require 'app/routes.php';

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();