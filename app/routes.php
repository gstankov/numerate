<?php

// Welcome, landing, home, root ...
$app->get('/', function ($request, $response, $args) {

    // Return view
    return $this->view->render($response, 'welcome.php');

});

// Upload files
$app->post('/editor', function ($request, $response, $args) {
    
    // Try to upload files
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
        
        // Unset upload errors
        session_unset($_SESSION['error']);
        
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