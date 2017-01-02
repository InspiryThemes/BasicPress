(function ($) {
    "use strict";

    var $ = jQuery,
        $window = $(window),
        $body = $('body'),
        isRtl = $body.hasClass('rtl');

    
    /*-----------------------------------------------------------------------------------*/
    /* Scroll to Top
     /*-----------------------------------------------------------------------------------*/
    $(function () {
        var scrollAnchor = $('#scroll-top');
        $window.scroll(function () {
            if ($window.width() > 980) {
                if ($(this).scrollTop() > 250) {
                    scrollAnchor.fadeIn('fast');
                    return;
                }
            }
            scrollAnchor.fadeOut('fast');
        });

        scrollAnchor.on('click', function (event) {
            event.preventDefault();
            $('html, body').animate({scrollTop: 0}, 'slow');
        });
    })

})(jQuery);