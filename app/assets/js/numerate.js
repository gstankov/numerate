/*global $*/

$('document').ready(function() {
    
    $('.img-wrapper').imagesLoaded().always( function( instance ) {
        
                console.log('all images loaded');
                
            }).done( function( instance ) {
            
                $('.pdf-preview').fadeIn(300);
            
                var width = $('.img-wrapper img').width();
                var height = $('.img-wrapper img').height();
            
                $('.img-top').css({'width': width});
                $('.img-left').css({'height': height});
                $('.img-wrapper-background').css({'width': width});

            }).fail( function() {
                
                console.log('all images loaded, at least one is broken');
                
            }).progress( function( instance, image ) {
                
                var result = image.isLoaded ? 'loaded' : 'broken';
                
                console.log( 'image is ' + result + ' for ' + image.img.src );
            
            }
        );

    }
    
);