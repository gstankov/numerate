<?php require "partials/header.php"; ?>

<div class="wrapper wrapper-welcome">
    
    <div class="branding">
        <img src="app/assets/images/icon-case.png">
    </div>

    <?php if (isset($_SESSION['error'])) { ?>
    
        <div class="callout alert">
            
            <h5>Error uploading files, here's the error message:</h5>
            
            <p><em><?php echo $_SESSION['error']; ?></em></p>

        </div>
    
    <?php } else { ?>
    
        <div class="callout secondary">
            <h5>Welcome!</h5>
            <p>Stamp a Barcode, QR code or text over PDF document based on CSV data.</p>
            Step 1: Upload files...
        </div>
    
    <?php } ?>

    <form action="editor" method="post" enctype="multipart/form-data">
        
        <label>
            <h5>Select PDF file</h5>
            <input class="button" type="file" name="files[]" />
        </label>
        
        <label>
            <h5>Select CSV file</h5>
            <input class="button" type="file" name="files[]" />
        </label>
        
        <label>
            <input class="button" type="submit" name="submit" value="Upload" />
        </label>
        
    </form>
    
    <div class="info">
        <p>gstankov 2018 | <a href="https://github.com/gstankov/numerate">GitHub</a></p>
    </div>

</div>

<?php require "partials/footer.php"; ?>