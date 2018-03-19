function hideMessage() {
    var output = jQuery('.wpcf7-response-output');
    output.removeClass('wpcf7-mail-sent-ok');
    output.hide();
}

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
        var soffset = 35;
        if (sbtop<0) {
            sbtop=sbtop+50;
        }
        if (stop<0) {
            stop=stop+50;
        }
        slider_button.css('top',sbtop + 'px' );
        slider.css('top',stop-soffset + 'px');
        
        //Update Mobile view
        if (jQuery(window).width()<600) {
            var width = jQuery(window).width();
            var height = jQuery(window).height();
            var slideWidth = 0;
            var sLeft =  0;
            var scWidth = 0;
            var sbWidth = 28;
            var sRight = 0;
            if (width<500) {
                slideWidth = width*.95;
            } else {
                slideWidth = 500;
            }
            scWidth = slideWidth - 72;
            sRight = -(scWidth + 45);
            sLeft = (slideWidth + sRight) - sbWidth;
            slider.css({'width':slideWidth  + 'px','right':sRight + 'px'});
            slider_button.css('left',sLeft + 'px');
            slider_content.css('width',scWidth + 'px');
        } else {
            sRight = -342;
            slider.css('right',sRight + 'px');
        }
        
        jQuery('#contact-slider-sidebar').on('keypress',function(e){
            var key = e.which;
            if (key==13) {
                open_panel();
                return false;
            }
        });
        jQuery('#contact-slider-sidebar1, .contact-slider-close').on('keypress',function(e){
            var key = e.which;
            if (key==13) {
                close_panel();
                return false;
            }
        });
        enable_tabbing(-1);
    }
    document.addEventListener( 'wpcf7invalid', function( event ) {
        alert(event.detail.apiResponse['message']);
        jQuery('.wpcf7-response-output').addClass('wpcf7-force-hidden');
        return false;
    }, false );
    document.addEventListener( 'wpcf7spam', function( event ) {
        alert(event.detail.apiResponse['message'])
        jQuery('.wpcf7-response-output').addClass('wpcf7-force-hidden');
        return false;
    }, false );
    jQuery(".collapse").on("shown.bs.collapse", function(e){
    	jQuery(this).parent().find('a[data-target="#'+ jQuery(this).attr("id") +'"]').attr("aria-expanded","true");
    });
    jQuery(".collapse").on("hidden.bs.collapse", function(e){
    	jQuery(this).parent().find('a[data-target="#'+ jQuery(this).attr("id") +'"]').attr("aria-expanded","false");
    });
    jQuery(".wpcf7-text,.wpcf7-textarea").on("focus", function(e){
    	jQuery(this).parent().parent().find('label.hidden').removeClass("hidden").addClass("show");
        jQuery(this).css({"margin-bottom":"0"});
    });
});