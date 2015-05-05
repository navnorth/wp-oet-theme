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
<<<<<<< HEAD
	
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
}); 
=======

    jQuery("#front_feature_left").hover(function(){
        jQuery("#front_feature_left").attr("src", "/wp-content/themes/teched-twentytwelve-child/images/mission-rollover-on.png");
        jQuery("#front_callout_left").fadeIn("slow");
    },
    function() {
        jQuery("#front_feature_left").attr("src", "/wp-content/themes/teched-twentytwelve-child/images/mission-rollover-off.png");
        jQuery("#front_callout_left").fadeOut();
    });

    //jQuery("#front_feature_center").hover(function(){
    //    jQuery("#front_feature_center").attr("src", "/wp-content/uploads/2014/05/Featured-Arrow-Task-Force-on.png");
    //    jQuery("#front_callout_center").fadeIn("slow");
    //},
    //function() {
    //    jQuery("#front_feature_center").attr("src", "/wp-content/uploads/2014/05/Featured-Arrow-Task-Force-off.png");
    //    jQuery("#front_callout_center").fadeOut();
    //});

    jQuery("#front_feature_right").hover(function(){
        jQuery("#front_feature_right").attr("src", "/wp-content/themes/teched-twentytwelve-child/images/grants-rollover-on.png");
        jQuery("#front_callout_right").fadeIn("slow");
    },
    function() {
        jQuery("#front_feature_right").attr("src", "/wp-content/themes/teched-twentytwelve-child/images/grants-rollover-off.png");
        jQuery("#front_callout_right").fadeOut();
    });

});
>>>>>>> dca3460f007c57db43c26b203a391a39728a3bc8
