<?php require "partials/header.php"; ?>

<div class="wrapper">
    
<?php if (isset($_SESSION['success'])) { ?>

    <div class="callout success">

        <?php

            $out = "<p>";

                foreach ($data['files'] as $file) {
                    
                   $out.= '<img class="success-icon" src="app/assets/images/success.png" /> ' . $file['file_dst_name'] . ", ";
                   
                }
    
                $out.= "uploaded successfully.";
            
            $out.= "</p>";

            echo $out;
            
        ?>

    </div>
    
    <?php

        $out = "<h4>PDF preview</h4>";
        
        $csv = [];
        
        foreach ($data['files'] as $file) {
            
            if ($file['file_type'] == 'application/pdf') {
                
                $out.= "<div class='pdf-preview'>";
                    $out.= '<img src="app/data/' . $file['file_jpg_preview'] . '" />';
                $out.= '</div>';
                
            } else {
                
                $handle = file_get_contents($file['file_dst_pathname']);
                
                $csv[] = csv_to_array($handle);
            
            }
            
        }
        
        $out.= "<h4>CSV data</h4>";
        
        $out.= "<div class='csv-data'>";
    
            $out.="<table>";
        
                foreach ($csv as $sheet) {
                    
                    foreach ($sheet as $row) {
                        $out.="<tr>";
                            $out.= '<td>' . $row[0] . '</td>';
                        $out.= "</tr>";
                    }
                    
                    $out.= "</tr>";
    
                }
                
            $out.= "</table>";
        
        $out.= '</div>';
        
        echo $out;
        
    ?>

    <a href="/" class="button">Upload again</a>
    
<?php } ?>

</div>

<?php require "partials/footer.php"; ?>