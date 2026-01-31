/**
 * Custom Header Navigation Script
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        var $hamburger = $('#mobile-side-drawer');
        var $headerNav = $('.header-nav');
        var $navOverlay = $('.nav-overlay');
        var $closeBtn = $('.nav-close-btn');
        var $body = $('body');
        
        // Open menu
        $hamburger.on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $headerNav.addClass('show');
            $navOverlay.addClass('active');
            $body.css('overflow', 'hidden');
        });
        
        // Close menu - close button
        $closeBtn.on('click', function(e) {
            e.preventDefault();
            closeNav();
        });
        
        // Close menu - overlay click
        $navOverlay.on('click', function() {
            closeNav();
        });
        
        // Close menu - ESC key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27) {
                closeNav();
            }
        });
        
        // Close nav function
        function closeNav() {
            $headerNav.removeClass('show');
            $navOverlay.removeClass('active');
            $body.css('overflow', '');
        }
        
        // Close when clicking nav link
        $headerNav.find('a').on('click', function() {
            closeNav();
        });
    });
    
})(jQuery);
