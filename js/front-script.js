jQuery( document ).ready(function() {
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	});

	jQuery(".fa-bars").click(function(){
		jQuery(".menu-primary-menu-container").css("display", "block");
		jQuery(".responsiv-menu_ul").css("display", "block");
   		jQuery(".responsiv-menu").slideToggle("slow");
 	});
	jQuery(".fa-print").click(function(){
		window.print();
	});

	var heght = jQuery("#lnk_btn_cntnr_center").height()
	jQuery(".link_dwnlds").height(heght);

	var a_hght = jQuery(".link_dwnlds").children("div").children("a").height();
	a_hght = parseInt(a_hght) + parseInt(30);
	var a_margin = parseInt(heght) - parseInt(a_hght);
	a_margin = a_margin/2;
	jQuery(".link_dwnlds").children("div").children("a").css("margin-top", a_margin+"px");

	/** Keyboard Navigation using Keydown event **/
	jQuery('.menu-item > a').on('keydown',function(e){
	    if (e.which==40) { /* Down Arrow Key */
		/* Check if current menu item has a child menu */
		if (jQuery(this).parent().has('.sub-menu').length > 0) {
		    subMenu = jQuery(this).parent().find('.sub-menu');
		    subMenu.show();
		    subMenu.focus();
		} else {
		    jQuery(this).parent().next().find('a').focus();
		}
	       return false;
	    }
	    if (e.which==38) { /* Up Arrow Key */
		/* Check if sub menu is visible, then hide*/
		 if (jQuery(this).parent().has('.sub-menu').is(':visible')) {
		    jQuery(this).parent().find('.sub-menu').hide();
		    jQuery(this).parent().find('.sub-menu').removeAttr('style');
		}
		return false;
	    }
	});
	jQuery('.menu-item > a').on('mouseenter' , function(){
	     if (jQuery(this).parent().has('.sub-menu')) {
		jQuery('.sub-menu').removeAttr('style');
	     }
	});
	jQuery('.menu-item > a').on('focus' , function(){
	     if (jQuery(this).parent().has('.sub-menu').length>0) {
		jQuery('.sub-menu').removeAttr('style');
	     }
	});


    // Elements to inject
    var mySVGsToInject = document.querySelectorAll('img.svg-replace');

    // Options
    var injectorOptions = {
        evalScripts: 'once',
        each: function (svg) {
        // Callback after each SVG is injected
        console.log('SVG injected: ' + svg.getAttribute('id'));
        }
    };

    // Replace SVGs with PNG on unsupported browsers
	if (!Modernizr.svg) {
		jQuery('img.svg-replace[src*="svg"]').attr('src', function() {
			return jQuery(this).attr('src').replace('.svg', '.png');
		});
		//jQuery('*[class=".slideshow_container_style-light .slideshow_pagination ul li"]').css('background', 'url(../images/slider_pager.png) 0 0 no-repeat !important;');
		console.log('Replaced SVG images with PNG');
	}

});
