jQuery( document ).ready(function() {
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	});
	
	jQuery( ".oet_accordion" ).accordion({
		collapsible: true,
		active: false,
		heightStyle: "content"
	 });
});