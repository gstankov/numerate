// CSS & JS copy
var gulp        = require('gulp');          // Gulp
var merge       = require('merge-stream');  // Merge
var rename      = require('gulp-rename');   // Rename
var replace     = require('gulp-replace');  // Replace

// Default task
gulp.task('default', function() {
    
    var jquery = gulp.src('vendor/components/jquery/*')
        .pipe(gulp.dest('app/assets/js/jquery'));
        
    var zurbJs = gulp.src('vendor/zurb/foundation/dist/js/*')
        .pipe(gulp.dest('app/assets/js/zurb'));
    
    var zurbCss = gulp.src('vendor/zurb/foundation/dist/css/*')
        .pipe(gulp.dest('app/assets/css/zurb'));
        
    var imagesLoaded = gulp.src('node_modules/imagesloaded/imagesloaded.pkgd.min.js')
        .pipe(gulp.dest('app/assets/js/imagesLoaded'));
        
    var pdfFontCopy = gulp.src('app/assets/fonts/*')
        .pipe(gulp.dest('vendor/rev42/tfpdf/src/font/unifont'));
    
    var extend_tFPDF = gulp.src('vendor/setasign/fpdi/fpdi_bridge.php', { base: './' })
        .pipe(replace(/class fpdi_bridge extends FPDF/g, 'class fpdi_bridge extends tFPDF'))
        .pipe(gulp.dest('./'));
    
    return merge(
        jquery,
        zurbJs,
        zurbCss,
        imagesLoaded,
        pdfFontCopy,
        extend_tFPDF
    );

});