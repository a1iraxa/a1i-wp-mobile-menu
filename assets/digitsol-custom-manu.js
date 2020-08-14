if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

/* Global jQuery, $*/
"use strict";

jQuery(document).ready(function($) {
    $('.header').on('click', '.main-nav-toggle', function(event) {
        $('.main-nav').toggleClass('active');
    });

    $('.header').on('click', '.main-nav__caret', function(event) {
        event.preventDefault();
        $(this).toggleClass('opened');
        $(this).siblings('.main-nav__sub-menu').eq(0).toggleClass('open');

    });

});