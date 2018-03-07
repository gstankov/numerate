/* global $ */

$('document').ready(function() {
    
    // Plugin
    $('.img-wrapper').imagesLoaded().always( function( instance ) {
        
                console.log('all images loaded');
                
            }).done( function( instance ) {

                $('.loading').fadeOut(300);
                $('.img-wrapper').fadeIn(300);
                
                var width = $('.img-wrapper img').width();
                var height = $('.img-wrapper img').height();
                
                $('.img-top').css({'width': width});
                $('.img-left').css({'height': height});
                $('.img-wrapper-background').css({'width': width});
                $('.img-wrapper-background').css({'height': height});

                $('.qr-code').draggable({
                    revert: true,
                    stack: '.qr-code',
                    revertDuration: 50
                });

                $(".img-wrapper-background").droppable({
                    accept: ".qr-code", 
                    classes: {
                        "ui-droppable-active": "ui-state-active",
                        "ui-droppable-hover": "ui-state-hover"
                    },
                    drop: function (event, ui) {

                        var droppable = $(this);
                        var draggable = ui.draggable;
                        var clone = draggable.clone();

                        if($(draggable).parent().is(":not(.img-wrapper-background)")) {
                        
                            console.log("Dropped");
                            
                            $(this).addClass("ui-state-highlight");

                            // Move draggable into droppable
                            $(droppable).append(clone);
                            
                            clone.draggable({
                                containment: $(this)
                            }).addClass('ui-selected');
                            
                            var leftPosition  = ui.offset.left - $(this).offset().left;
                            var topPosition   = ui.offset.top - $(this).offset().top;

                            clone.css({
                                position:'absolute',
                                top: topPosition,
                                left: leftPosition,
                            });
                            
                            clone.animate({
                                'width' : '100px',
                                'height' : '100px',
                                'top'   : topPosition-25,
                                'left'  : leftPosition-25
                            });
                            
                            clone.mousedown(function() {
                                $('.ui-selected').removeClass('ui-selected');
                                $(this).addClass('ui-selected');
                            }).mouseup(function() {
                                $(this).addClass('ui-selected');
                            });
                            
                            var offset = clone.position();
                            var xPos = offset.top;
                            var yPos = offset.left;
                            
                            console.log(xPos+','+yPos);
        
                        } else {

                            var offset = draggable.position();
                            var xPos = offset.top;
                            var yPos = offset.left;
                            
                            console.log(xPos+','+yPos);

                        }

                    }
                    
                }).selectable().resizable();
                
            }).fail( function() {
                
                console.log('all images loaded, at least one is broken');
                
            }).progress( function( instance, image ) {
                
                var result = image.isLoaded ? 'loaded' : 'broken';
                
                console.log( 'image is ' + result + ' for ' + image.img.src );
            
            }
        );

    }
    
);

