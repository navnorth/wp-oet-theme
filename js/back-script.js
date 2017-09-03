jQuery( document ).ready(function() {
    //enable/disable during load
    if (jQuery("#enablecontactslider").is(':checked')) {
	jQuery('#contactsliderpage').prop('disabled',false);
    } else {
	jQuery('#contactsliderpage').prop('disabled',true);
    }
    
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	});
    
    //enable/disable contact slider dropbox on ticking enable slider checkbox
    jQuery('#enablecontactslider').on('change', function() {
	if (jQuery(this).is(':checked')) {
	    jQuery('#contactsliderpage').prop('disabled',false);
	} else {
	    jQuery('#contactsliderpage').prop('disabled',true);
	}
    });
    
    jQuery(".widget[id*='featuredcontentwidgetdetails'").each(function(i, obj){
	if (jQuery(this).find('.widget-title span.in-widget-title').length) {
	    var title = jQuery(this).find('.widget-title span.in-widget-title');
	    var label = jQuery(this).find(".widget-inside input.widefat[id*='label']");
	    setTimeout(function() {
		var title_text = title.text();
		if (label) {
		    title_text = ": " + label.val();
		}
		title.html(title_text);
	    }, 1);
	}
    });
});