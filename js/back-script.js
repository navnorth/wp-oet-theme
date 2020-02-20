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
		console.log(title_text);
		if (label.val().length>0) {
		    title_text = ": " + label.val();
		}
		title.html(title_text);
	    }, 1);
	}
    });
    
    jQuery("input[type=radio][name=mpubdisplay]").on("change",function(){
	if (jQuery(this).value=="selective"){
	    jQuery(".meta_main_wrp input[type=checkbox]").prop("checked",true);
	} else {
	    jQuery(".meta_main_wrp input[type=checkbox]").prop("checked",false);
	}
    });
    
    jQuery("#debug_medium").on("click", function(e){
	e.preventDefault();
	data = {
	    action: 'debug_medium_connection',
	}
	
	//* Process the AJAX POST request
	jQuery.post(
	    ajaxurl,
	    data
	    ).done( function(response) {
            verbose = jQuery("#oer_verbose_block");
            verbose.html("");
            verbose.html(response);
        });

	return false;
    });
    
    jQuery("#page_template").on("change", function(){
        jQuery('#story_metabox').toggle(jQuery(this).val()=='page-templates/story-template.php');
        var sidebar_templates = ['page-templates/publication-template.php', 'default'];
        var publication_templates = ['page-templates/publication-subsection-template.php','page-templates/publication-template.php'];
        if (sidebar_templates.indexOf(jQuery(this).val())==-1)
            jQuery('#oet-sidebar-metabox').toggle(false);
        else
            jQuery('#oet-sidebar-metabox').toggle(true);
        
        if (publication_templates.indexOf(jQuery(this).val())==-1)
            jQuery('#publication_metabox').toggle(false);
        else
            jQuery('#publication_metabox').toggle(true);
        
    }).change();
});