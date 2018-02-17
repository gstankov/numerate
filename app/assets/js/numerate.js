/*global $*/
$('document').ready(function() {

    console.log('Loaded...');
    
    var width = $('.img-wrapper img').width();
    var height = $('.img-wrapper img').height();
    
    console.log(width);

    $('.img-top').css({'width': width});
    $('.img-left').css({'height': height});
    $('.img-wrapper-background').css({'width': width});
    

});