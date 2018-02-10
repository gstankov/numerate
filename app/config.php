<?php

// Slim config
$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

// Instantiate the App object
$app = new \Slim\App($config);

// PHP renderer

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('app/templates/');
};

?>