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
        }
    };
    
    OET_Dynamic_Sidebar.addSidebarSection();
});