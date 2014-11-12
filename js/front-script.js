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
}); 