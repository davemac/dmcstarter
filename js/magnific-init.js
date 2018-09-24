'use strict';
jQuery(document).ready(function($) {
    
    /*
    Modify the Flickr API supplied URL to load the image inside a Flickr wrapper instead
    For example:
    from: https://farm8.static.flickr.com/7362/27750611472_ed814764fd_b.jpg
    to: http://flickr.com/photo.gne?id=27750611472
    */
    function convertFlickrUrl(src) {
        return ('http://flickr.com/photo.gne?id=' + src.split("/")[4].split("_")[0]);
    };

    $('.masonry-loop').magnificPopup({
        type: 'image',
        mainClass: 'mfp-zoom-in',
        tLoading: '',
        removalDelay: 500, //delay removal by X to allow out-animation
        callbacks: {

            imageLoadComplete: function() {
                var self = this;
                setTimeout(function() {
                    self.wrap.addClass('mfp-image-loaded');
                }, 16);
            },
            close: function() {
                this.wrap.removeClass('mfp-image-loaded');
            },
        },

        closeBtnInside: false,
        closeOnContentClick: true,

        image: {
            verticalFit: true,
            titleSrc: function(item) {
                return item.el.attr('title') + ' &middot; <a class="image-source-link" href="' + convertFlickrUrl(item.src) + '" target="_blank">Open image in Flickr to share and print</a>';
            }
        },

        delegate: 'a', // child items selector, by clicking on it popup will open
        gallery: {
            enabled: true,
            preload: [0, 2],
            navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

            tPrev: 'Previous (Left arrow key)', // title for left button
            tNext: 'Next (Right arrow key)', // title for right button
            tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
        }
    });

});