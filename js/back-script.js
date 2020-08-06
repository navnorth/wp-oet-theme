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
        /*var sidebar_templates = ['page-templates/publication-template.php', 'default'];
        if (sidebar_templates.indexOf(jQuery(this).val())==-1)
            jQuery('#oet-sidebar-metabox').toggle(false);
        else
            jQuery('#oet-sidebar-metabox').toggle(true);*/
        
        jQuery('#publication_metabox').toggle(jQuery(this).val()=='page-templates/publication-template.php');
        
    }).change();
    
    jQuery('.oet_sidebar_section_youtube_modal_trg').change(function() {
        if(this.checked) {
            jQuery(this).siblings('.oet_sidebar_section_youtube_modal_opt').val(1);
        }else{
            jQuery(this).siblings('.oet_sidebar_section_youtube_modal_opt').val(0);
        }      
    });
    
});



/* ******************** */
/* PERMALINK VALIDATION */
/* ******************** */
jQuery( document ).ready(function() {
  var posttype = getPostType();
  if(posttype != 'undefined' && (posttype == 'page' || posttype == 'post')){
    //Save Draft Button
    if(jQuery('#minor-publishing-actions #save-action #save-post').length){
      var btnText = jQuery('#minor-publishing-actions #save-action #save-post').attr('value');
      jQuery('#minor-publishing-actions #save-action #save-post').hide();
      jQuery('<input type="submit" name="save" id="secondary-save-post" value="'+btnText+'" class="button">').insertAfter(jQuery('#minor-publishing-actions #save-action #save-post'));
    }
    //Publish Button
    if(jQuery("#publish").length){
      var btnText = jQuery("#publish").attr('value');
      jQuery("#publish").hide();
      jQuery('#publishing-action').append('<input type="submit" name="publish" id="secondary-publish" class="button button-primary button-large" value="'+btnText+'">')
    }
  }
  //Save Draft Title Field Enter Key Event
  jQuery(document).on('keydown','input[name="post_title"]',function(e){
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if(keycode == '13'){
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
    }
  })
  //Secondary Update Button Click Event
  jQuery(document).on('click','#secondary-save-post',function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    if(!jQuery('body').hasClass('home')){
      jQuery('input[name="post_title"]').trigger('blur');    
      var checkExist = setInterval(function() {
         if (jQuery('span#editable-post-name').length) {
            clearInterval(checkExist);
            interceptPublish('dft');
         }
      }, 100); // check every 100ms
    }else{
      jQuery("#publish").click();
    } 
  })
  //Publish Button Click Event
  jQuery(document).on('click','#secondary-publish',function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    console.log(jQuery('body').hasClass('home'));
    if(!jQuery('body').hasClass('home')){
      jQuery('input[name="post_title"]').trigger('blur');    
      var checkExist = setInterval(function() {
         if (jQuery('span#editable-post-name').length) {
            clearInterval(checkExist);
            interceptPublish('pub');
         }
      }, 100); // check every 100ms    
    }else{
      jQuery("#publish").click();
    }   
  })
  // Preview Story
  if (jQuery('.acf-field-post-object[data-name="oet_sidebar_story_content_story"]').length) {
    jQuery('.acf-field-post-object[data-name="oet_sidebar_story_content_story"]').each(function(){
      let inputGrp = jQuery(this).find('.acf-input');
      inputGrp.find('.select2-container').css({"width":"95%"});
      inputGrp.append('<span class="preview-story"><a href="#" class="oet-sidebar-story-url" disabled="disabled" target="_blank"><i class="fa fa-2x fa-external-link" aria-hidden="true"></i></a></span>');
    });
    jQuery(document).on('change','.acf-field-post-object[data-name="oet_sidebar_story_content_story"] .select2-hidden-accessible', function(e){
      e.preventDefault();
      var target = jQuery(this).parent().find('.preview-story .oet-sidebar-story-url');
      if (jQuery(this).val())
        target.attr("disabled",false);
      jQuery.post(oet_ajax_object.ajaxurl,
      {
          action:'oet_sidebar_story_url_callback',
          id: jQuery(this).val()
      }).done(function (response) {
          target.attr('href',response);
      });
    });
  }
  // Preview Section
  if (jQuery('.acf-field-flexible-content .acf-input .acf-flexible-content .values .layout').length){
    jQuery('.acf-field-flexible-content .acf-input .acf-flexible-content .values .layout').each(function(){
      let layoutControls = jQuery(this).find('.acf-fc-layout-controls');
      layoutControls.prepend('<a class="oet-sidebar-preview-section acf-icon -preview small light acf-js-tolltip" href="#" data-toggle="modal" data-target="#oet-dynamic-sidebar-preview" data-name="section-preview" title="Preview"><i class="fa fa-eye" aria-hidden="true"></i></a>');
    });
    var target = jQuery('#oet-dynamic-sidebar-preview .modal-body .preview-body');
    var loader = target.find('.preview-loader');
    jQuery(document).on('click','.oet-sidebar-preview-section', function(e){
      e.preventDefault();
      var layout = jQuery(this).closest('.layout[data-layout="section"]');
      var fields = layout.find('.acf-fields');
      var data = [];
      var modalBody = jQuery('#oet-dynamic-sidebar-preview .modal-body');
      var page_id = jQuery('#oet-dynamic-sidebar-preview').attr('data-page-id');
      data['title'] = fields.find('.acf-field[data-name="oet_sidebar_section_title"] .acf-input input[type="text"]').val();
      data['icon'] = fields.find('.acf-field[data-name="oet_sidebar_section_icon"] .acf-input select').val();
      data['type'] = fields.find('.acf-field[data-name="oet_sidebar_section_type"] .acf-input select').val();
      jQuery.post(oet_ajax_object.ajaxurl,
      {
          action:'oet_display_sidebar_section_callback',
          id: page_id,
          type: data['type'],
          title: data['title'],
          icon: data['icon']
      }).done(function (response) {
          modalBody.append(loader);
          loader.hide();
          target.html(response);
      });
    });
    jQuery(document).on('click','#oet-dynamic-sidebar-preview button', function(e){
      e.preventDefault();
      jQuery(this).closest('#oet-dynamic-sidebar-preview').modal('hide');
      target.html(loader);
      loader.show();
    });
  }
  //Notice Dismiss
  jQuery(document).on('click','.oese-permalink-validation-notice-dismiss',function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    jQuery('.oese-prohibitedpermalinktext.notice').hide(100,function(){
      jQuery('.oese-prohibitedpermalinktext.notice').remove();
    });    
  })
  
})

var itvl;
function interceptPublish(typ){
    
    if(jQuery('input#new-post-slug').length){
        var slug = jQuery('input#new-post-slug').val(); 
    }else{
        var slug = jQuery('span#editable-post-name').text(); 
    }
    var prhbt = ["admin", "login", "user"];  
    var found = false;
    prhbt.forEach(function(item) {
        var idx = slug.indexOf(item);
        if(idx == 0){//found in the beginning
          found = true;
        }
    });
    if(found){
      var html = '<div class="oese-prohibitedpermalinktext notice notice-error is-dismissible" style="display:none;"><p>Please make sure the permalink doesn\'t begin with words such as <strong>admin, login, and user</strong> as they are known to cause issues</p><button type="button" class="oese-permalink-validation-notice-dismiss notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
      if (!jQuery('.oese-prohibitedpermalinktext').length){
        jQuery(html).insertAfter('hr.wp-header-end');
        jQuery('.oese-prohibitedpermalinktext').show(100);
      }
    }else{
      if(typ == 'pub'){
        jQuery("#publish").click();
      }else if(typ == 'dft'){
        jQuery("#save-post").click();
      }
    }

}

function getPostType(){
    var postType; var ret;
    var attrs = jQuery( 'body' ).attr( 'class' ).split( ' ' );
    jQuery( attrs ).each(function() {
      if (this.indexOf("post-type-") >= 0){
				postType = this.split( 'post-type-' );
        postType = postType[ postType.length - 1 ];	
				ret = postType;	
			}	
		});
  return ret;
}
