<?php

$app->get('/', function ($request, $response, $args) {

    // Return view
    return $this->view->render($response, 'welcome.php');

});

$app->get('/numerate/{session}', function ($request, $response, $args) {

    // Return view
    return $this->view->render($response, 'welcome.php', $args);

});