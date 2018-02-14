<?php require "partials/header.php"; ?>

<div class="wrapper">
    
    <div class="branding">
        <img src="app/assets/images/icon-case.png">
    </div>
    
    <?php if (isset($_SESSION['success'])) { ?>
    
    <?php
        //echo "<pre>";
        //print_r($data['files']);
        //echo "</pre>";
    ?>
    
        <div class="callout success">
            
            <?php

                $out = "";
                
                foreach ($data['files'] as $file) {
                   $out.= '<p><img class="success-icon" src="app/assets/images/success.png" /> ' . $file['file_dst_name'] . '</p>';
                }
                
                echo $out;
                
            ?>
            
            <p>Yay! All files uploaded successfully. They will be deleted after one hour.</p>
            
        </div>
        
        <div class="pdf-preview">
            
            <?php

                $out = "";
                
                foreach ($data['files'] as $file) {
                    if ($file['file_type'] == "application/pdf") {
                        $out.= '<p><img src="app/data/' . $file['file_jpg_preview'] . '" />';
                    }
                }
                
                echo $out;
                
            ?>
            
        </div>
        
        <div class="csv-data">
            
                
            
        </div>
        
        <a href="/" class="button">Upload again</a>
        
    <?php } ?>

</div>

<?php require "partials/footer.php"; ?>