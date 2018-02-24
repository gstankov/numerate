/*global $*/

$('document').ready(function() {

    var width = $('.img-wrapper img').width();
    var height = $('.img-wrapper img').height();

    $('.img-top').css({'width': width});
    $('.img-left').css({'height': height});
    $('.img-wrapper-background').css({'width': width});

});