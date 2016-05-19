jQuery( document ).ready(function() {
    //Reposition Contact Slider button depending on Contact Slider content
    if (jQuery('#contact-slider').is(':visible')) {
        var slider = jQuery('#contact-slider');
        var slider_content = jQuery('#contact-slider-content');
        var slider_button = jQuery('#contact-slider-sidebar, contact-slider-sidebar1');
        var dHeight = jQuery(window).height();
        var scHeight = slider_content.outerHeight(true);
        var sbHeight = slider_button.outerHeight(true);
        var sbtop = (scHeight/2-sbHeight/2);
        var stop = (dHeight/2 - scHeight/2);
        if (sbtop<0) {
            sbtop=sbtop+50;
        }
        if (stop<0) {
            stop=stop+50;
        }
        slider_button.css('top',sbtop + 'px' );
        slider.css('top',stop + 'px');
        
        //Update Mobile view
        if (jQuery(window).width()<600) {
            var width = jQuery(window).width();
            var height = jQuery(window).height();
            var slideWidth = 0;
            var sLeft =  0;
            var scWidth = 0;
            var sbWidth = 46;
            var sRight = 0;
            if (width<500) {
                slideWidth = width*.95;
            } else {
                slideWidth = 500;
            }
            scWidth = slideWidth - 86;
            sRight = -(scWidth + 40);
            sLeft = (slideWidth + sRight) - sbWidth;
            slider.css({'width':slideWidth  + 'px','right':sRight + 'px'});
            slider_button.css('left',sLeft + 'px');
            slider_content.css('width',scWidth + 'px');
        } else {
            sRight = -342;
            slider.css('right',sRight + 'px');
        }
    }
});