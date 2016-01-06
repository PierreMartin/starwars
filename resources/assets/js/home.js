$(document).ready(function() {

    //////////////////////////////// PARALLAX HEADER ////////////////////////////////
    $(window).scroll(function() {
        var curPos          = $(window).scrollTop();
        var element         = $('header.home');

        var valeurBg        = 0 - (curPos * 1.5);
        var valeurOpacity   = 1 - (curPos * 0.00235);

        ///// POSITION /////
        element.css('background-position', 'center' + " " + valeurBg + 'px');

        if ( valeurBg < -800 ) {
            element.css('background-position', 'center -800px');
        }

        ///// OPACITY /////
        var departOpacity = 50;
        element.css('opacity', valeurOpacity + (departOpacity * 0.004) );

        if ( valeurOpacity < 0 - (departOpacity * 0.004) ) {
            element.css('opacity', 0 );
        }
    });


    //////////////////////////////// ANIMATION PRODUCTS ////////////////////////////////
    var $window = $(window);

    //////////////// ANIMATION GAUCHE : ////////////////
    var $animation_elements_left = $("#container_products .product:even");
    $animation_elements_left.css({"opacity": "1", "right": "100%"});

    function check_if_in_view_left() {
        var window_height           = $window.height();
        var window_top_position     = $window.scrollTop();
        var window_bottom_position  = (window_top_position + window_height);

        $.each($animation_elements_left, function() {
            var $element                = $(this);
            var element_height          = $element.outerHeight();
            var element_top_position    = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
                $element.delay(800).animate({ "opacity": "1", "right": "0"}, 800, "easeOutQuart");
            }
        });
    }

    //////////////// ANIMATION DROITE : ////////////////
    var $animation_elements_right = $("#container_products .product:odd");
    $animation_elements_right.css({"opacity": "1", "left": "100%"});

    function check_if_in_view_right() {
        var window_height           = $window.height();
        var window_top_position     = $window.scrollTop();
        var window_bottom_position  = (window_top_position + window_height);

        $.each($animation_elements_right, function() {
            var $element                = $(this);
            var element_height          = $element.outerHeight();
            var element_top_position    = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
                $element.delay(800).animate({ "opacity": "1", "left": "0"}, 800, "easeOutQuart");
            }
        });
    }

    //////////////// APPEL DES FONCTIONS : ////////////////
    var windowWidth = $(window).width();

    if (windowWidth <= 780) {
        // FORMAT MOBILE
        console.log('absence d\'animation');
        $animation_elements_left.css({"opacity": "1", "left": "0"});
        $animation_elements_right.css({"opacity": "1", "left": "0"});
    } else {
        // FORMAT DESTOCK
        $window.on('scroll resize', check_if_in_view_left);
        $window.on('scroll resize', check_if_in_view_right);
        $window.trigger('scroll');
    }

});













