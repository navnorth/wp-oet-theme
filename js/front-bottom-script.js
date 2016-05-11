jQuery( document ).ready(function() {
    //Reposition Contact Slider button depending on Contact Slider content
    if (jQuery('#contact-slider').is(':visible')) {
        var slider = jQuery('#contact-slider');
        var slider_content = jQuery('#contact-slider-content');
        var slider_button = jQuery('#contact-slider-sidebar, contact-slider-sidebar1');
        var dHeight = screen.height;
        var scHeight = slider_content.outerHeight(true);
        var sbHeight = slider_button.outerHeight(true);
        var sbtop = (scHeight/2-sbHeight/2)-50;
        var stop = (dHeight/2 - scHeight/2)-50;
        if (sbtop<0) {
            sbtop=sbtop+50;
        }
        if (stop<0) {
            stop=stop+50;
        }
        slider_button.css('top',sbtop + 'px' );
        slider.css('top',stop + 'px');
    }
});