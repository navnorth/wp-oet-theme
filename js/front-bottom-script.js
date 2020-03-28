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
    jQuery(".wpcf7-text,.wpcf7-textarea").each(function(e){
    	jQuery(this).parent().parent().find('label.hidden').removeClass("hidden").addClass("show");
        jQuery(this).css({"margin-bottom":"0"});
    });
    
    // Add Blur event to Contact Slider
    var slider = document.getElementById("contact-slider-content");
    slider.addEventListener("blur", custom_slider_blur, true);
    
    function custom_slider_blur(e) {
        var target = jQuery(e.target);
        if (target.is('input.wpcf7-form-control.wpcf7-submit')) {
            close_panel();
        }
    }
    
    jQuery(document).on('click','a.oet-video-link', function(e){
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      oet_togglemodal(1);
    })
    jQuery(document).on('click','#oet-video-overlay', function(e){
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      oet_togglemodal(0);
    })
    jQuery(document).on("keydown", function(e) {
     if (e.key == "Escape" || e.key == "Esc") { 
       // escape key maps to keycode `27`
       oet_togglemodal(0);
      }
    });
    window.setInterval(oet_checkFocus, 1000); 
});

function oet_togglemodal(bol){
  if(bol){ //show and play
    player.playVideo();
    jQuery('#oet-video-overlay').modal('show');
  }else{ //pause and hide
    player.pauseVideo();
    jQuery('#oet-video-overlay').modal('hide');
  }
}

/** Check if youtube iFrame has stolen the focus **/
function oet_checkFocus() {
    if(document.activeElement.tagName == "IFRAME") {
	if (document.getElementById("oet-video-overlay")) {
	    document.getElementById("oet-video-overlay").focus(); //return focus to overlay
	    document.body.focus();
	}
    }
}