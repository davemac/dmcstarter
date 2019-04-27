
'use strict';
jQuery( document ).ready( function( $ ) {

    $( '#homepage-slider' ).slick({
        dots: true,
        arrows: true,
        autoplay: true,
        speed: 3600,
        autoplaySpeed: 4800,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 767,
            settings: {
                arrows: false
            }
            }, {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }]
    });

    $( '#hero-slider' ).slick({
        dots: true,
        arrows: true,
        autoplay: true,
        speed: 900,
        adaptiveHeight: true,
        responsive: [ {
            breakpoint: 767,
            settings: {
                arrows: true,
                fade: false
            }
        }, {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1,
                dots: false
            }
        } ]
    });

    // set readonly attribute on form fields with this class
    $( '.gform_wrapper .dmc-read-only input' ).attr( 'readonly', '' );

});
