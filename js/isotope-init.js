
'use strict';
jQuery(document).ready(function($) {

// isotope

$(function ($) {

    var $container = $('.masonry-loop').isotope({
        filter: '*',
        itemSelector: '.masonry-entry',
        percentPosition: true,
        packery: {
            gutter: 10
        },
        animationEngine: 'jquery',
        animationOptions: {
            duration: 350,
            easing: 'linear',
            queue: true
        }
    });

    // layout Isotope after each image loads
    $container.imagesLoaded().progress( function() {
        $container.isotope('layout');
    });

    // Filter Variable
    var filters = {};

    // Clicking the text link
    $('#terms-filter a').click(function(){

        var $this = $(this);

        // Selector
        var selector = $this.attr('data-filter');

        // get group key
        var filterGroup = 'terms-filter';

        // set filter for group
        filters[ filterGroup ] = $this.attr('data-filter');

        // combine filters
        var filterValue = '';
        for ( var prop in filters ) {
            filterValue += filters[ prop ];
        }
        // set filter for Isotope
        $container.isotope({ filter: filterValue });

        // console.log( filterValue );

        return false;

    });

    // add selected class to current filter
    var $optionSets = $('#terms-filter'),
    $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){
        var $this = $(this);
        if ( $this.hasClass('selected') ) {
            return false;
        }
        var $optionSet = $this.parents('inline-list');
        $optionSets.find('.selected').removeClass('selected');
        $this.addClass('selected');
    });

 });


});