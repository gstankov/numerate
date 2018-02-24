// CSS & JS copy
var gulp = require('gulp'); // Gulp
var merge = require('merge-stream'); // Merge

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
    
    return merge(jquery, zurbJs, zurbCss, imagesLoaded);
  
});