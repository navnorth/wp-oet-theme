var origPosition;
/*
------------------------------------------------------------
Function to activate form button to open the slider.
------------------------------------------------------------
*/
function open_panel() {
    origPosition = parseInt(document.getElementById("contact-slider").style.right);
    slideIt();
    var a = document.getElementById("contact-slider-sidebar");
    a.setAttribute("id", "contact-slider-sidebar1");
    a.setAttribute("onclick", "close_panel()");
    // set box-shadow
    document.getElementById("contact-slider-content").style.boxShadow ='0 0 8px gray';
    enable_tabbing(0);
}

/*
------------------------------------------------------------
Function to slide the sidebar form (open form)
------------------------------------------------------------
*/
function slideIt() {
    var slidingDiv = document.getElementById("contact-slider");
    var stopPosition = 0;
    if (parseInt(slidingDiv.style.right) < stopPosition) {
        slidingDiv.style.right = parseInt(slidingDiv.style.right) + 2 + "px";
        setTimeout(slideIt, 1);
    }
}

/*
------------------------------------------------------------
Function to activate form button to close the slider.
------------------------------------------------------------
*/
function close_panel() {
    slideIn();
    a = document.getElementById("contact-slider-sidebar1");
    a.setAttribute("id", "contact-slider-sidebar");
    a.setAttribute("onclick", "open_panel()");
    show_cf_form();
    // set box-shadow
    document.getElementById("contact-slider-content").style.boxShadow ='0 0 0';
    enable_tabbing(-1);
}

/*
------------------------------------------------------------
Function to slide the sidebar form (slide in form)
------------------------------------------------------------
*/
function slideIn() {
    var slidingDiv = document.getElementById("contact-slider");
    var stopPosition = origPosition;
    if (parseInt(slidingDiv.style.right) > stopPosition) {
        slidingDiv.style.right = parseInt(slidingDiv.style.right) - 2 + "px";
        setTimeout(slideIn, 1);
    }
}

/*
------------------------------------------------------------
Function to show the form back after hitting submit button
------------------------------------------------------------
*/
function show_cf_form() {
    var cf_form = document.getElementById("cf-form");
    if (cf_form.style.display=="none") {
        cf_form.style.display = 'block';
    }
    hideMessage();
}

function enable_tabbing(tabindex) {
    jQuery('#contact-slider-content').find('.contact-slider-close').attr('tabindex',tabindex);
    jQuery('#contact-slider-content').find('#cf-form input,#cf-form textarea').attr('tabindex',tabindex);
    jQuery('#contact-slider-content').find('.wpcf7-recaptcha').attr('tabindex',tabindex);
    jQuery('#contact-slider-content').find('.wpcf7-recaptcha').attr('data-tabindex',tabindex);
    jQuery('#contact-slider-content').find('.wpcf7-recaptcha iframe').attr('tabindex',tabindex);
    if (tabindex===0) {
        jQuery('#contact-slider-content').find('.wpcf7-recaptcha').css({"visibility":"visible"});
    } else {
        jQuery('#contact-slider-content').find('.wpcf7-recaptcha').css({"visibility":"hidden"});
    }
}