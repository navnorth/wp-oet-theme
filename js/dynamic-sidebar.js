/**
 * OET Dynamic Sidebar
 */
jQuery( document ).ready(function($) {
    var OET_Dynamic_Sidebar = {
        addSidebarSection: function(){
            $(document).on("click", '.oet-add-sidebar-section', function(e){
                e.preventDefault();
                var btn = $(this).closest('.button-row.form-group');
                        
                var total_sections = parseInt($('.oet-sidebar-section-wrapper').length, 10);
                var id = total_sections + 1;
                $.post(oet_ajax_object.ajaxurl,
                {
                 action:'oet_add_sidebar_section_callback',
                 row_id: id
                }).done(function (response) {
                    btn.before(response);
                    var textAreaId = 'oer-sidebar-section-' + id;
                    tinymce.execCommand( 'mceRemoveEditor', false, textAreaId );
                    tinymce.execCommand( 'mceAddEditor', false, textAreaId );
                    quicktags({ id: textAreaId });
                });
            });
        },
        
        /** Display Content Type Editor **/
        displayContentTypeEditor: function(){
             $(document).on("change", '.oet-sidebar-section-type', function(e){
                e.preventDefault();
                var content_section = $(this).closest('.oet-sidebar-section-wrapper').find('.oet-content-sections');
                content_section.html('').removeClass('subsection-visible');
                console.log(content_section);
                        
                var content_count = parseInt($('.oet-sidebar-section-type-wrapper').length, 10);
                var id = content_count + 1;
                var type = $(this).children("option:selected").val();
                $.post(oet_ajax_object.ajaxurl,
                {
                    action:'oet_sidebar_content_type_callback',
                    row_id: id,
                    type: type
                }).done(function (response) {
                    if (type!=="related")
                        content_section.append(response).addClass('subsection-visible');
                    var textAreaId = 'oer-sidebar-section-type-' + id;
                    tinymce.execCommand( 'mceRemoveEditor', false, textAreaId );
                    tinymce.execCommand( 'mceAddEditor', false, textAreaId );
                    quicktags({ id: textAreaId });
                });
            });
        },
        
        /** Select Image for Image Content Type **/
        selectSidebarSectionImage: function(){
            var frame, metabox, btn, input, imageholder;
            $(document).on('click', 'button.oet_sidebar_section_image_button',function(e) {
                metabox = $(this).closest(".oet-sidebar-section-type-wrapper");
                btn = $(this);
                input = metabox.find('.oet_sidebar_section_image_url');
                imageholder = metabox.find('.oet_section_image_thumbnail_holder');
                
                e.preventDefault();
        
                if (frame) {
                    frame.open();
                    return;
                }
        
                frame = wp.media({
                    title: 'Select or upload thumbnail image',
                    button: {
                        text: "Use this image"
                    },
                    multiple:false
                });
        
                frame.on("select", function(){
                    imageholder.find(".oet-section-image-thumbnail,.oet-remove-section-image").remove();
                    var attachment = frame.state().get("selection").first().toJSON();
                    
                    input.val(attachment.url);
                    imageholder.append('<img src="' + attachment.url + '" class="oet-section-image-thumbnail" width="200"><span class="btn btn-danger btn-sm oet-remove-section-image" title="Remove Image"><i class="fa fa-minus-circle"></i></span>');
                    btn.text("Change Image");
                });
                
                frame.open();
            });
        },
        
    };
    
    OET_Dynamic_Sidebar.addSidebarSection();
    OET_Dynamic_Sidebar.displayContentTypeEditor();
    OET_Dynamic_Sidebar.selectSidebarSectionImage();
});