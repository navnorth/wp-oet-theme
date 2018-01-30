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
	
	jQuery('.main-menu ul li a').on('focus', function(){
	    if (jQuery(this).parent().has('.sub-menu').length>0) {
		jQuery(this).parent().find('.sub-menu').toggle();
	    } else {
		jQuery(this).parent().prev().find('.sub-menu').toggle();
	    }
	});
	
	if (jQuery(window).width()<=600) {
	    jQuery('.form-group.gray_bg').before('<a href="javascript:void(0)" class="mobile-search-btn"><span class="fa-stack"><i class="fa fa-search" aria-hidden="true"></i></span></a>');
	    jQuery('.mobile-search-btn').on('click', function(){
			if (jQuery('.form-group.gray_bg').is(":visible")) {
			    jQuery('.form-group.gray_bg').hide();
			    jQuery('.top_strp').css({"margin-top":"0"});
			    jQuery('.navi_icn').css({"margin-top":"-48px"})
			    jQuery('#content').css({"margin-top":"0"});
			} else {
			    jQuery('.form-group.gray_bg').show();
			    jQuery('.top_strp').css({"margin-top":"50px"});
			    jQuery('.navi_icn').css({"margin-top":"-93px"})
			    jQuery('#content').css({"margin-top":"45px"});
			}
	    });
	}
	
	//Wrap youtube video with video container
	jQuery("iframe[src*='youtube.com']").wrap("<div class='video-container'></div>");
	
	jQuery('.slideshow_description').addClass("dot-ellipsis dot-resize-update dot-load-update");
	
	//Update top level menu styles dynamically
	jQuery('.main-menu ul li a').each(function(){
	    if(jQuery(this).attr('href')=='#') {
		jQuery(this).css( { 'cursor':'default' });
	    }
	});
	
    // Replace SVGs with PNG on unsupported browsers
	if (!Modernizr.svg) {
		jQuery('img.svg-replace[src*="svg"]').attr('src', function() {
			return jQuery(this).attr('src').replace('.svg', '.png');
		});
		//jQuery('*[class=".slideshow_container_style-light .slideshow_pagination ul li"]').css('background', 'url(../images/slider_pager.png) 0 0 no-repeat !important;');
		console.log('Replaced SVG images with PNG');
	}

    enable_tabbing(-1)
});

